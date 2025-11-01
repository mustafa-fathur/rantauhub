<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use App\Models\MentorSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MentorRegistrationController extends Controller
{
    /**
     * Show the mentor registration form
     */
    public function showForm(): View
    {
        $user = Auth::user();

        // Check if user already has Mentor profile
        if ($user->mentor) {
            return redirect()->route('dashboard')
                ->with('info', 'Anda sudah terdaftar sebagai Mentor');
        }

        return view('user.register-mentor', [
            'title' => 'Daftar sebagai Mentor',
            'user' => $user,
        ]);
    }

    /**
     * Store mentor registration
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if user already has Mentor profile
        if ($user->mentor) {
            return redirect()->route('dashboard')
                ->with('info', 'Anda sudah terdaftar sebagai Mentor');
        }

        $validated = $request->validate([
            'current_job' => ['required', 'string', 'max:255'],
            'experience' => ['required', 'string', 'max:2000'],
            'about' => ['nullable', 'string', 'max:1000'],
            'skills' => ['required', 'array', 'min:1', 'max:10'],
            'skills.*' => ['required', 'string', 'max:100'],
        ]);

        DB::transaction(function () use ($user, $validated) {
            // Create Mentor profile
            $mentor = Mentor::create([
                'user_id' => $user->id,
                'current_job' => $validated['current_job'],
                'experience' => $validated['experience'],
                'about' => $validated['about'] ?? null,
                'reputation_score' => 0,
                'verified' => false,
            ]);

            // Create Mentor Skills
            foreach ($validated['skills'] as $skill) {
                if (!empty(trim($skill))) {
                    MentorSkill::create([
                        'mentor_id' => $mentor->id,
                        'skill' => trim($skill),
                    ]);
                }
            }
        });

        return redirect()->route('dashboard')
            ->with('success', 'Registrasi sebagai Mentor berhasil! Silakan tunggu verifikasi dari admin.');
    }
}

