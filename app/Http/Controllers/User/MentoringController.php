<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use App\Models\MentorSession;
use App\Enums\MentoringStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MentoringController extends Controller
{
    /**
     * Show the list of mentoring sessions for UMKM Owner
     */
    public function index(): View
    {
        $user = Auth::user();

        if (!$user->umkmOwner) {
            return redirect()->route('dashboard')
                ->with('error', 'Untuk request mentoring, Anda harus terdaftar sebagai UMKM Owner terlebih dahulu. Silakan daftar di halaman Dashboard.');
        }

        // Get all mentoring sessions for this UMKM Owner
        $sessions = MentorSession::with(['mentor.user', 'mentor.skills'])
            ->where('umkm_owner', $user->umkmOwner->id)
            ->latest()
            ->get();

        return view('user.mentoring-requests', [
            'title' => 'Mentoring Saya',
            'user' => $user,
            'sessions' => $sessions,
        ]);
    }

    /**
     * Show the form to request mentoring
     */
    public function create(): View
    {
        $user = Auth::user();

        if (!$user->umkmOwner) {
            return redirect()->route('dashboard')
                ->with('error', 'Untuk request mentoring, Anda harus terdaftar sebagai UMKM Owner terlebih dahulu. Silakan daftar di halaman Dashboard.');
        }

        // Get verified mentors
        $mentors = Mentor::with(['user', 'skills'])
            ->where('verified', true)
            ->get();

        return view('user.mentoring-request-create', [
            'title' => 'Request Mentoring',
            'user' => $user,
            'mentors' => $mentors,
        ]);
    }

    /**
     * Store a new mentoring request
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user->umkmOwner) {
            return redirect()->route('dashboard')
                ->with('error', 'Untuk request mentoring, Anda harus terdaftar sebagai UMKM Owner terlebih dahulu. Silakan daftar di halaman Dashboard.');
        }

        $validated = $request->validate([
            'mentor_id' => ['required', 'exists:mentors,id', function ($attribute, $value, $fail) {
                $mentor = Mentor::find($value);
                if (!$mentor || !$mentor->verified) {
                    $fail('Mentor yang dipilih tidak valid atau belum terverifikasi.');
                }
            }],
            'topic' => ['required', 'string', 'max:255'],
            'scheduled_at' => ['required', 'date', 'after:now'],
            'duration_minutes' => ['required', 'integer', 'min:30', 'max:240'], // Min 30 menit, Max 4 jam
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        // Create mentoring session request
        MentorSession::create([
            'umkm_owner' => $user->umkmOwner->id,
            'mentor_id' => $validated['mentor_id'],
            'topic' => $validated['topic'],
            'scheduled_at' => $validated['scheduled_at'],
            'duration_minutes' => $validated['duration_minutes'],
            'status' => MentoringStatus::PENDING,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('mentoring.index')
            ->with('success', 'Request mentoring berhasil dibuat! Silakan tunggu konfirmasi dari mentor.');
    }

    /**
     * Show details of a mentoring session
     */
    public function show($id): View
    {
        $user = Auth::user();

        if (!$user->umkmOwner) {
            return redirect()->route('dashboard')
                ->with('error', 'Untuk request mentoring, Anda harus terdaftar sebagai UMKM Owner terlebih dahulu. Silakan daftar di halaman Dashboard.');
        }

        $session = MentorSession::with(['mentor.user', 'mentor.skills', 'hoursLog'])
            ->where('umkm_owner', $user->umkmOwner->id)
            ->findOrFail($id);

        return view('user.mentoring-request-detail', [
            'title' => 'Detail Mentoring',
            'user' => $user,
            'session' => $session,
        ]);
    }

    /**
     * Submit rating for completed session
     */
    public function rate(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user->umkmOwner) {
            return redirect()->route('dashboard')
                ->with('error', 'Untuk request mentoring, Anda harus terdaftar sebagai UMKM Owner terlebih dahulu. Silakan daftar di halaman Dashboard.');
        }

        $session = MentorSession::with('mentor')
            ->where('umkm_owner', $user->umkmOwner->id)
            ->where('status', MentoringStatus::COMPLETED)
            ->findOrFail($id);

        // Check if already rated
        if ($session->rating) {
            return redirect()->route('mentoring.show', $id)
                ->with('error', 'Session ini sudah diberi rating.');
        }

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'feedback' => ['nullable', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($session, $validated) {
            // Update session with rating
            $session->update([
                'rating' => $validated['rating'],
                'feedback' => $validated['feedback'] ?? null,
            ]);

            // Update mentor's reputation score
            $mentor = $session->mentor;
            $totalRatings = MentorSession::where('mentor_id', $mentor->id)
                ->whereNotNull('rating')
                ->count();
            $averageRating = MentorSession::where('mentor_id', $mentor->id)
                ->whereNotNull('rating')
                ->avg('rating');

            // Update reputation score (simple average)
            $mentor->update([
                'reputation_score' => round($averageRating, 1),
            ]);

            // Update hours log star if exists
            if ($session->hoursLog) {
                $session->hoursLog->update([
                    'star' => $validated['rating'],
                ]);
            }
        });

        return redirect()->route('mentoring.show', $id)
            ->with('success', 'Rating berhasil disubmit! Terima kasih atas feedback Anda.');
    }

    /**
     * Cancel a mentoring session
     */
    public function cancel($id)
    {
        $user = Auth::user();

        if (!$user->umkmOwner) {
            return redirect()->route('dashboard')
                ->with('error', 'Untuk request mentoring, Anda harus terdaftar sebagai UMKM Owner terlebih dahulu. Silakan daftar di halaman Dashboard.');
        }

        $session = MentorSession::where('umkm_owner', $user->umkmOwner->id)
            ->whereIn('status', [MentoringStatus::PENDING, MentoringStatus::CONFIRMED])
            ->findOrFail($id);

        $session->update(['status' => MentoringStatus::CANCELLED]);

        return redirect()->route('mentoring.index')
            ->with('success', 'Mentoring session berhasil dibatalkan.');
    }
}
