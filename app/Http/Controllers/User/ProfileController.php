<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view('user.my-profile', [
            'title' => 'Profile Saya',
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'phone' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'address' => ['nullable', 'string', 'max:255'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old profile photo if exists
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Store new profile photo
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $validated['profile_photo'] = $path;
        }

        // If email changed, reset email verification
        if ($user->email !== $validated['email']) {
            $validated['email_verified_at'] = null;
        }

        // Update user
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;
        $user->bio = $validated['bio'] ?? null;
        $user->address = $validated['address'] ?? null;
        if (isset($validated['profile_photo'])) {
            $user->profile_photo = $validated['profile_photo'];
        }
        if (isset($validated['email_verified_at'])) {
            $user->email_verified_at = $validated['email_verified_at'];
        }
        $user->save();

        return redirect()->route('my-profile')->with('success', 'Profil berhasil diperbarui!');
    }
}
