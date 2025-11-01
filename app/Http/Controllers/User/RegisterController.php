<?php

namespace App\Http\Controllers\User;

use App\Enums\UmkmCategory;
use App\Http\Controllers\Controller;
use App\Models\UmkmOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Show the UMKM Owner registration form
     */
    public function showUmkmOwnerForm(): View
    {
        $user = Auth::user();

        // Check if user already has UmkmOwner profile
        if ($user->umkmOwner) {
            return redirect()->route('dashboard')->with('info', 'Anda sudah terdaftar sebagai UMKM Owner');
        }

        return view('user.register-umkm-owner', [
            'title' => 'Daftar sebagai UMKM Owner',
            'user' => $user,
        ]);
    }

    /**
     * Store UMKM Owner registration
     */
    public function storeUmkmOwner(Request $request)
    {
        $user = Auth::user();

        // Check if user already has UmkmOwner profile
        if ($user->umkmOwner) {
            return redirect()->route('dashboard')->with('info', 'Anda sudah terdaftar sebagai UMKM Owner');
        }

        // Validate that user has address
        if (!$user->address) {
            return redirect()->route('my-profile')
                ->with('error', 'Silakan lengkapi alamat Anda terlebih dahulu di halaman profil sebelum mendaftar sebagai UMKM Owner');
        }

        $validated = $request->validate([
            'nik' => ['required', 'string', 'max:20', 'unique:umkm_owners,nik'],
            'npwp' => ['nullable', 'string', 'max:20'],
        ]);

        // Create UmkmOwner profile
        UmkmOwner::create([
            'user_id' => $user->id,
            'nik' => $validated['nik'],
            'npwp' => $validated['npwp'] ?? null,
            'verified' => false,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Registrasi sebagai UMKM Owner berhasil! Silakan tunggu verifikasi dari admin.');
    }

    /**
     * Show the UMKM Business registration form
     */
    public function showUmkmBusinessForm(): View
    {
        $user = Auth::user();

        // Check if user is UmkmOwner
        if (!$user->umkmOwner) {
            return redirect()->route('register.umkm-owner')
                ->with('error', 'Silakan daftar sebagai UMKM Owner terlebih dahulu');
        }

        return view('user.register-umkm-business', [
            'title' => 'Daftar UMKM',
            'user' => $user,
        ]);
    }

    /**
     * Store UMKM Business registration
     */
    public function storeUmkmBusiness(Request $request)
    {
        $user = Auth::user();

        // Check if user is UmkmOwner
        if (!$user->umkmOwner) {
            return redirect()->route('register.umkm-owner')
                ->with('error', 'Silakan daftar sebagai UMKM Owner terlebih dahulu');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'in:kuliner,kerajinan,pertanian,fashion,lainnya'],
            'other_category' => ['nullable', 'string', 'max:255', 'required_if:category,lainnya'],
            'description' => ['required', 'string', 'max:1000'],
            'location' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Handle logo upload
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('umkm-logos', 'public');
        }

        // Create UmkmBusiness
        $user->umkmOwner->businesses()->create([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'other_category' => $validated['other_category'] ?? null,
            'description' => $validated['description'],
            'location' => $validated['location'],
            'logo' => $logoPath,
            'verified' => false,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Registrasi UMKM berhasil! Silakan tunggu verifikasi dari admin.');
    }
}
