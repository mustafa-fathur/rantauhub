<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Funder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FunderRegistrationController extends Controller
{
    /**
     * Show the funder registration form
     */
    public function showForm(): View
    {
        $user = Auth::user();

        // Check if user already has Funder profile
        if ($user->funder) {
            return redirect()->route('dashboard')
                ->with('info', 'Anda sudah terdaftar sebagai Funder');
        }

        return view('user.register-funder', [
            'title' => 'Daftar sebagai Funder',
            'user' => $user,
        ]);
    }

    /**
     * Store funder registration
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if user already has Funder profile
        if ($user->funder) {
            return redirect()->route('dashboard')
                ->with('info', 'Anda sudah terdaftar sebagai Funder');
        }

        $validated = $request->validate([
            'organization_name' => ['nullable', 'string', 'max:255'],
        ]);

        // Create Funder profile
        Funder::create([
            'user_id' => $user->id,
            'organization_name' => $validated['organization_name'] ?? null,
            'verified' => false,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Registrasi sebagai Funder berhasil! Silakan tunggu verifikasi dari admin.');
    }
}

