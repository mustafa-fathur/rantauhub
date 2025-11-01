<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Funding;
use App\Models\UmkmBusiness;
use App\Enums\FundingStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FunderFundingController extends Controller
{
    /**
     * Show available funding requests (open requests)
     */
    public function index(): View
    {
        $user = Auth::user();

        if (!$user->funder) {
            return redirect()->route('dashboard')
                ->with('error', 'Untuk memberikan pendanaan, Anda harus terdaftar sebagai Funder terlebih dahulu. Silakan daftar di halaman Dashboard.');
        }

        if (!$user->funder->verified) {
            return redirect()->route('dashboard')
                ->with('error', 'Akun Funder Anda belum terverifikasi. Silakan tunggu verifikasi dari admin.');
        }

        // Get open funding requests (already approved by admin, no funder assigned yet)
        $openRequests = Funding::with(['business.owner.user'])
            ->where('status', FundingStatus::OPEN) // Only show requests that admin has approved
            ->whereNull('funder_id')
            ->whereHas('business', function ($query) {
                $query->where('verified', true);
            })
            ->latest()
            ->get();

        // Get my accepted fundings
        $myFundings = Funding::with(['business.owner.user'])
            ->where('funder_id', $user->funder->id)
            ->latest()
            ->get();

        return view('user.funder.funding-requests', [
            'title' => 'Request Pendanaan Tersedia',
            'user' => $user,
            'openRequests' => $openRequests,
            'myFundings' => $myFundings,
        ]);
    }

    /**
     * Show details of an open funding request
     */
    public function show($id): View
    {
        $user = Auth::user();

        if (!$user->funder || !$user->funder->verified) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda harus terdaftar dan terverifikasi sebagai Funder terlebih dahulu');
        }

        $funding = Funding::with(['business.owner.user'])
            ->where('status', FundingStatus::OPEN)
            ->whereNull('funder_id')
            ->findOrFail($id);

        return view('user.funder.funding-request-detail', [
            'title' => 'Detail Request Pendanaan',
            'user' => $user,
            'funding' => $funding,
        ]);
    }

    /**
     * Accept and provide funding for an open request
     */
    public function accept(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user->funder || !$user->funder->verified) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda harus terdaftar dan terverifikasi sebagai Funder terlebih dahulu');
        }

        $funding = Funding::with(['business.owner.user'])
            ->where('status', FundingStatus::OPEN) // Only show requests that admin has approved
            ->whereNull('funder_id')
            ->findOrFail($id);

        // Validate amount (funder can provide different amount)
        $validated = $request->validate([
            'amount' => ['required', 'integer', 'min:1000000', 'max:1000000000'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        // Update funding with funder information - langsung approved tanpa perlu verifikasi admin
        $funding->update([
            'funder_id' => $user->funder->id,
            'amount' => $validated['amount'], // Funder can provide different amount
            'status' => FundingStatus::APPROVED, // Langsung approved, transaksi langsung terjadi
            'description' => $validated['description'] ?? $funding->description,
        ]);

        return redirect()->route('funder.funding-requests.index')
            ->with('success', 'Anda telah menerima dan menyetujui request pendanaan! Transaksi telah tercatat.');
    }
}

