<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\UmkmBusiness;
use App\Models\Funding;
use App\Enums\FundingStatus;
use App\Enums\UmkmCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UmkmController extends Controller
{
    /**
     * Show list of UMKM businesses available for funding
     */
    public function index(Request $request): View
    {
        $query = UmkmBusiness::with(['owner.user', 'fundings'])
            ->where('verified', true);

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Search by name or location
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sort
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'latest':
                $query->latest();
                break;
            case 'name':
                $query->orderBy('name');
                break;
            case 'most_funded':
                // Order by total funding amount
                $query->withSum(['fundings' => function ($q) {
                    $q->where('status', FundingStatus::APPROVED);
                }], 'amount')
                ->orderBy('fundings_sum_amount', 'desc');
                break;
        }

        $umkms = $query->paginate(12);

        // Calculate funding statistics for each UMKM
        $umkms->getCollection()->transform(function ($umkm) {
            // Get open funding request (if exists)
            $openFunding = $umkm->fundings()
                ->where('status', FundingStatus::OPEN)
                ->first();

            // Calculate total funded amount (from approved fundings)
            $totalFunded = $umkm->fundings()
                ->where('status', FundingStatus::APPROVED)
                ->sum('amount');

            // Target amount from open funding request or latest approved
            $targetAmount = $openFunding ? $openFunding->amount : 
                ($umkm->fundings()->where('status', FundingStatus::APPROVED)->latest()->first()?->amount ?? 50000000);

            // Count unique funders
            $investorsCount = $umkm->fundings()
                ->where('status', FundingStatus::APPROVED)
                ->distinct('funder_id')
                ->count('funder_id');

            // Calculate percentage
            $percentage = $targetAmount > 0 ? min(100, round(($totalFunded / $targetAmount) * 100)) : 0;

            $umkm->funding_stats = [
                'total_funded' => $totalFunded,
                'target_amount' => $targetAmount,
                'percentage' => $percentage,
                'investors_count' => $investorsCount,
                'has_open_request' => $openFunding !== null,
            ];

            return $umkm;
        });

        return view('umkm', [
            'umkms' => $umkms,
            'categories' => UmkmCategory::cases(),
            'selectedCategory' => $request->category,
            'search' => $request->search,
            'sort' => $sort,
        ]);
    }

    /**
     * Show detail of a specific UMKM business
     */
    public function show($id): View
    {
        $umkm = UmkmBusiness::with([
            'owner.user',
            'fundings.funder.user',
            'pictures'
        ])
        ->where('verified', true)
        ->findOrFail($id);

        // Get open funding request
        $openFunding = $umkm->fundings()
            ->where('status', FundingStatus::OPEN)
            ->whereNull('funder_id')
            ->first();

        // Calculate funding statistics
        $approvedFundings = $umkm->fundings()
            ->where('status', FundingStatus::APPROVED)
            ->get();

        $totalFunded = $approvedFundings->sum('amount');
        $targetAmount = $openFunding ? $openFunding->amount : 
            ($approvedFundings->latest()->first()?->amount ?? 50000000);
        $percentage = $targetAmount > 0 ? min(100, round(($totalFunded / $targetAmount) * 100)) : 0;
        $investorsCount = $approvedFundings->pluck('funder_id')->unique()->count();

        // Get all funders
        $funders = $approvedFundings->map(fn($f) => $f->funder)->filter()->unique('id');

        return view('umkm-detail', [
            'umkm' => $umkm,
            'openFunding' => $openFunding,
            'totalFunded' => $totalFunded,
            'targetAmount' => $targetAmount,
            'percentage' => $percentage,
            'investorsCount' => $investorsCount,
            'funders' => $funders,
        ]);
    }
}
