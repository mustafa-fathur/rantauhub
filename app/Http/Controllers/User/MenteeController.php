<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MentorSession;
use App\Models\MentorHoursLog;
use App\Enums\MentoringStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MenteeController extends Controller
{
    /**
     * Show pending requests and history for mentor
     */
    public function index(): View
    {
        $user = Auth::user();

        if (!$user->mentor) {
            return redirect()->route('dashboard')
                ->with('error', 'Untuk mengelola mentee, Anda harus terdaftar sebagai Mentor terlebih dahulu. Silakan daftar di halaman Dashboard.');
        }

        if (!$user->mentor->verified) {
            return redirect()->route('dashboard')
                ->with('error', 'Akun Mentor Anda belum terverifikasi. Silakan tunggu verifikasi dari admin.');
        }

        // Get pending requests
        $pendingRequests = MentorSession::with(['umkmOwner.user', 'umkmOwner.businesses'])
            ->where('mentor_id', $user->mentor->id)
            ->where('status', MentoringStatus::PENDING)
            ->latest()
            ->get();

        // Get all sessions (history)
        $allSessions = MentorSession::with(['umkmOwner.user', 'umkmOwner.businesses', 'hoursLog'])
            ->where('mentor_id', $user->mentor->id)
            ->latest()
            ->get();

        // Calculate statistics
        $totalSessions = $allSessions->count();
        $completedSessions = $allSessions->where('status', MentoringStatus::COMPLETED)->count();
        $totalHours = MentorHoursLog::where('mentor_id', $user->mentor->id)
            ->sum('hours_contributed');

        return view('user.mentee.requests', [
            'title' => 'Mentee & Mentoring',
            'user' => $user,
            'pendingRequests' => $pendingRequests,
            'allSessions' => $allSessions,
            'totalSessions' => $totalSessions,
            'completedSessions' => $completedSessions,
            'totalHours' => $totalHours,
        ]);
    }

    /**
     * Show details of a mentoring session
     */
    public function show($id): View
    {
        $user = Auth::user();

        if (!$user->mentor || !$user->mentor->verified) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda harus terdaftar dan terverifikasi sebagai Mentor terlebih dahulu');
        }

        $session = MentorSession::with(['umkmOwner.user', 'umkmOwner.businesses', 'hoursLog'])
            ->where('mentor_id', $user->mentor->id)
            ->findOrFail($id);

        return view('user.mentee.session-detail', [
            'title' => 'Detail Mentoring Session',
            'user' => $user,
            'session' => $session,
        ]);
    }

    /**
     * Approve a mentoring request
     */
    public function approve($id)
    {
        $user = Auth::user();

        if (!$user->mentor || !$user->mentor->verified) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda harus terdaftar dan terverifikasi sebagai Mentor terlebih dahulu');
        }

        $session = MentorSession::where('mentor_id', $user->mentor->id)
            ->where('status', MentoringStatus::PENDING)
            ->findOrFail($id);

        $session->update(['status' => MentoringStatus::CONFIRMED]);

        return redirect()->route('mentee.index')
            ->with('success', 'Request mentoring telah disetujui!');
    }

    /**
     * Reject a mentoring request
     */
    public function reject(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user->mentor || !$user->mentor->verified) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda harus terdaftar dan terverifikasi sebagai Mentor terlebih dahulu');
        }

        $session = MentorSession::where('mentor_id', $user->mentor->id)
            ->where('status', MentoringStatus::PENDING)
            ->findOrFail($id);

        $validated = $request->validate([
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $session->update([
            'status' => MentoringStatus::CANCELLED,
            'notes' => $validated['notes'] ?? 'Ditolak oleh mentor',
        ]);

        return redirect()->route('mentee.index')
            ->with('info', 'Request mentoring telah ditolak.');
    }

    /**
     * Mark session as completed and create hours log
     */
    public function complete(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user->mentor || !$user->mentor->verified) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda harus terdaftar dan terverifikasi sebagai Mentor terlebih dahulu');
        }

        $session = MentorSession::with('hoursLog')
            ->where('mentor_id', $user->mentor->id)
            ->where('status', MentoringStatus::CONFIRMED)
            ->findOrFail($id);

        // Check if already has hours log
        if ($session->hoursLog) {
            return redirect()->route('mentee.show', $id)
                ->with('error', 'Session ini sudah diselesaikan sebelumnya.');
        }

        $validated = $request->validate([
            'hours_contributed' => ['required', 'integer', 'min:1', 'max:8'], // Max 8 jam per session
            'earned_points' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($session, $validated) {
            // Mark session as completed
            $session->update(['status' => MentoringStatus::COMPLETED]);

            // Calculate hours from duration_minutes
            $hours = $session->duration_minutes / 60;

            // Create hours log
            MentorHoursLog::create([
                'mentor_id' => $session->mentor_id,
                'session_id' => $session->id,
                'hours_contributed' => $validated['hours_contributed'],
                'earned_points' => $validated['earned_points'],
                'star' => null, // Will be updated when UMKM Owner rates
            ]);
        });

        return redirect()->route('mentee.show', $id)
            ->with('success', 'Session telah ditandai sebagai selesai dan hours log telah dibuat!');
    }
}
