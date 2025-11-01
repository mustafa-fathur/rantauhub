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
            $approvedFundings = $umkm->fundings()
                ->where('status', FundingStatus::APPROVED)
                ->get();
            
            $totalFunded = $approvedFundings->sum('amount');

            // Target amount from open funding request or latest approved
            if ($openFunding) {
                $targetAmount = $openFunding->amount;
            } else {
                $latestApproved = $approvedFundings->sortByDesc('created_at')->first();
                $targetAmount = $latestApproved?->amount ?? 50000000; // Default 50 juta
            }

            // Count unique funders
            $investorsCount = $approvedFundings
                ->pluck('funder_id')
                ->filter()
                ->unique()
                ->count();

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
        // Handle static data untuk MVP (ID 900+ adalah data statis)
        if ($id >= 900) {
            $staticUmkm = $this->getStaticUmkmData($id);
            if ($staticUmkm) {
                return view('umkm-detail', $staticUmkm);
            }
        }
        
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
        
        // Get target amount: from open funding, or latest approved, or default
        if ($openFunding) {
            $targetAmount = $openFunding->amount;
        } else {
            $latestApproved = $approvedFundings->sortByDesc('created_at')->first();
            $targetAmount = $latestApproved?->amount ?? 50000000; // Default 50 juta
        }
        
        $percentage = $targetAmount > 0 ? min(100, round(($totalFunded / $targetAmount) * 100)) : 0;
        $investorsCount = $approvedFundings->pluck('funder_id')->filter()->unique()->count();

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

    /**
     * Get static UMKM data for MVP
     */
    private function getStaticUmkmData($id): ?array
    {
        $staticUmkms = [
            999 => [
                'umkm' => (object)[
                    'id' => 999,
                    'name' => 'Keripik Balado Uni Kezi',
                    'location' => 'Padang, Sumatera Barat',
                    'description' => 'Keripik singkong dan ubi dengan balado khas Padang yang pedas dan gurih. Produk halal dan higienis. Dibuat dengan resep turun temurun dan bahan-bahan pilihan untuk menghasilkan cita rasa yang autentik.',
                    'logo' => null,
                    'category' => (object)['value' => 'makanan', 'label' => fn() => 'Makanan & Minuman'],
                    'owner' => (object)[
                        'user' => (object)[
                            'name' => 'Kezia Valerina',
                            'phone' => '+6281378514467',
                            'email' => 'kezia@keripikbalado.com',
                        ],
                    ],
                    'pictures' => collect(),
                ],
                'openFunding' => (object)['id' => 999, 'amount' => 25000000],
                'totalFunded' => 12000000,
                'targetAmount' => 25000000,
                'percentage' => 48,
                'investorsCount' => 18,
                'funders' => collect(),
            ],
            998 => [
                'umkm' => (object)[
                    'id' => 998,
                    'name' => 'Batagor Mang Ujang',
                    'location' => 'Bukittinggi, Sumatera Barat',
                    'description' => 'Batagor khas Bandung dengan cita rasa yang khas, dibuat dengan bahan-bahan pilihan berkualitas tinggi. Telah dikenal di Sumatera Barat sejak 15 tahun lalu.',
                    'logo' => null,
                    'category' => (object)['value' => 'makanan', 'label' => fn() => 'Makanan & Minuman'],
                    'owner' => (object)[
                        'user' => (object)[
                            'name' => 'Ujang Suryana',
                            'phone' => '+6281234567890',
                            'email' => 'ujang@batagor.com',
                        ],
                    ],
                    'pictures' => collect(),
                ],
                'openFunding' => (object)['id' => 998, 'amount' => 20000000],
                'totalFunded' => 8500000,
                'targetAmount' => 20000000,
                'percentage' => 42,
                'investorsCount' => 12,
                'funders' => collect(),
            ],
            997 => [
                'umkm' => (object)[
                    'id' => 997,
                    'name' => 'Rendang Minang Asli',
                    'location' => 'Payakumbuh, Sumatera Barat',
                    'description' => 'Rendang dengan resep turun temurun, dimasak dengan api kayu dan bumbu rempah pilihan. Proses memasak yang lama menghasilkan tekstur dan rasa yang sempurna.',
                    'logo' => null,
                    'category' => (object)['value' => 'makanan', 'label' => fn() => 'Makanan & Minuman'],
                    'owner' => (object)[
                        'user' => (object)[
                            'name' => 'Siti Aisyah',
                            'phone' => '+6289876543210',
                            'email' => 'siti@rendang.com',
                        ],
                    ],
                    'pictures' => collect(),
                ],
                'openFunding' => (object)['id' => 997, 'amount' => 30000000],
                'totalFunded' => 15000000,
                'targetAmount' => 30000000,
                'percentage' => 50,
                'investorsCount' => 25,
                'funders' => collect(),
            ],
        ];

        return $staticUmkms[$id] ?? null;
    }
}
