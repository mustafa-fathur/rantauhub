<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Funding;
use App\Models\Funder;
use App\Models\UmkmBusiness;
use App\Enums\FundingStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FundingRequestController extends Controller
{
    /**
     * Show the list of funding requests for user's UMKM businesses
     */
    public function index(): View
    {
        $user = Auth::user();

        if (!$user->umkmOwner) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda harus terdaftar sebagai UMKM Owner terlebih dahulu');
        }

        // Get all funding requests for user's businesses
        $fundingRequests = Funding::with(['business', 'funder.user'])
            ->whereHas('business', function ($query) use ($user) {
                $query->where('owner_id', $user->umkmOwner->id);
            })
            ->latest()
            ->get();

        // Get user's businesses
        $businesses = $user->umkmOwner->businesses()->where('verified', true)->get();

        // Get verified funders
        $funders = Funder::with('user')
            ->where('verified', true)
            ->get();

        return view('user.funding-requests', [
            'title' => 'Request Pendanaan',
            'user' => $user,
            'fundingRequests' => $fundingRequests,
            'businesses' => $businesses,
            'funders' => $funders,
        ]);
    }

    /**
     * Show the form to create a new funding request
     */
    public function create(): View
    {
        $user = Auth::user();

        if (!$user->umkmOwner) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda harus terdaftar sebagai UMKM Owner terlebih dahulu');
        }

        // Get verified businesses
        $businesses = $user->umkmOwner->businesses()
            ->where('verified', true)
            ->get();

        if ($businesses->isEmpty()) {
            return redirect()->route('my-umkm.index')
                ->with('error', 'Anda harus memiliki setidaknya satu UMKM yang sudah terverifikasi untuk membuat request pendanaan');
        }

        // Get verified funders
        $funders = Funder::with('user')
            ->where('verified', true)
            ->get();

        return view('user.funding-request-create', [
            'title' => 'Buat Request Pendanaan',
            'user' => $user,
            'businesses' => $businesses,
            'funders' => $funders,
        ]);
    }

    /**
     * Store a new funding request
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user->umkmOwner) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda harus terdaftar sebagai UMKM Owner terlebih dahulu');
        }

        $validated = $request->validate([
            'business_id' => ['required', 'exists:umkm_business,id', function ($attribute, $value, $fail) use ($user) {
                $business = UmkmBusiness::find($value);
                if (!$business || $business->owner_id !== $user->umkmOwner->id) {
                    $fail('UMKM yang dipilih tidak valid atau bukan milik Anda.');
                }
                if (!$business->verified) {
                    $fail('UMKM yang dipilih harus sudah terverifikasi.');
                }
            }],
            'funder_id' => ['required', 'exists:funders,id', function ($attribute, $value, $fail) {
                $funder = Funder::find($value);
                if (!$funder || !$funder->verified) {
                    $fail('Funder yang dipilih tidak valid atau belum terverifikasi.');
                }
            }],
            'amount' => ['required', 'integer', 'min:1000000', 'max:1000000000'], // Min 1 juta, Max 1 milyar
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        // Create funding request
        Funding::create([
            'funder_id' => $validated['funder_id'],
            'business_id' => $validated['business_id'],
            'amount' => $validated['amount'],
            'status' => FundingStatus::PENDING,
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('funding-requests.index')
            ->with('success', 'Request pendanaan berhasil dibuat! Silakan tunggu persetujuan dari funder dan admin.');
    }

    /**
     * Show details of a funding request
     */
    public function show($id): View
    {
        $user = Auth::user();

        if (!$user->umkmOwner) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda harus terdaftar sebagai UMKM Owner terlebih dahulu');
        }

        $funding = Funding::with(['business', 'funder.user'])
            ->whereHas('business', function ($query) use ($user) {
                $query->where('owner_id', $user->umkmOwner->id);
            })
            ->findOrFail($id);

        return view('user.funding-request-detail', [
            'title' => 'Detail Request Pendanaan',
            'user' => $user,
            'funding' => $funding,
        ]);
    }

    /**
     * Cancel a funding request (only if pending)
     */
    public function cancel(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user->umkmOwner) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda harus terdaftar sebagai UMKM Owner terlebih dahulu');
        }

        $funding = Funding::with('business')
            ->whereHas('business', function ($query) use ($user) {
                $query->where('owner_id', $user->umkmOwner->id);
            })
            ->findOrFail($id);

        if ($funding->status !== FundingStatus::PENDING) {
            return redirect()->route('funding-requests.index')
                ->with('error', 'Hanya request yang masih pending yang dapat dibatalkan.');
        }

        $funding->update(['status' => FundingStatus::REJECTED]);

        return redirect()->route('funding-requests.index')
            ->with('success', 'Request pendanaan berhasil dibatalkan.');
    }
}

