<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UmkmBusiness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MyUmkmController extends Controller
{
    /**
     * Show the list of user's UMKM businesses
     */
    public function index(): View
    {
        $user = Auth::user();

        if (!$user->umkmOwner) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda harus terdaftar sebagai UMKM Owner terlebih dahulu. Silakan daftar di halaman Dashboard.');
        }

        $businesses = $user->umkmOwner->businesses()
            ->latest()
            ->get();

        return view('user.my-umkm', [
            'title' => 'UMKM Saya',
            'user' => $user,
            'businesses' => $businesses,
        ]);
    }

    /**
     * Show the edit form for a specific UMKM business
     */
    public function edit($id): View
    {
        $user = Auth::user();

        if (!$user->umkmOwner) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda harus terdaftar sebagai UMKM Owner terlebih dahulu. Silakan daftar di halaman Dashboard.');
        }

        $business = $user->umkmOwner->businesses()->findOrFail($id);

        return view('user.my-umkm-edit', [
            'title' => 'Edit UMKM',
            'user' => $user,
            'business' => $business,
        ]);
    }

    /**
     * Update a UMKM business
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user->umkmOwner) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda harus terdaftar sebagai UMKM Owner terlebih dahulu. Silakan daftar di halaman Dashboard.');
        }

        $business = $user->umkmOwner->businesses()->findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'in:kuliner,kerajinan,pertanian,fashion,lainnya'],
            'other_category' => ['nullable', 'string', 'max:255', 'required_if:category,lainnya'],
            'description' => ['required', 'string', 'max:1000'],
            'location' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($business->logo) {
                Storage::disk('public')->delete($business->logo);
            }

            // Store new logo
            $logoPath = $request->file('logo')->store('umkm-logos', 'public');
            $validated['logo'] = $logoPath;
        }

        $business->update($validated);

        return redirect()->route('my-umkm')
            ->with('success', 'UMKM berhasil diperbarui!');
    }

    /**
     * Delete a UMKM business
     */
    public function destroy($id)
    {
        $user = Auth::user();

        if (!$user->umkmOwner) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda harus terdaftar sebagai UMKM Owner terlebih dahulu. Silakan daftar di halaman Dashboard.');
        }

        $business = $user->umkmOwner->businesses()->findOrFail($id);

        // Delete logo if exists
        if ($business->logo) {
            Storage::disk('public')->delete($business->logo);
        }

        $business->delete();

        return redirect()->route('my-umkm')
            ->with('success', 'UMKM berhasil dihapus!');
    }
}

