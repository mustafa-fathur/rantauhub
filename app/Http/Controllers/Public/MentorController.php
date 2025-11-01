<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use App\Models\MentorSkill;
use App\Models\MentorSession;
use App\Enums\MentoringStatus;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MentorController extends Controller
{
    /**
     * Show list of verified mentors
     */
    public function index(Request $request): View
    {
        $query = Mentor::with(['user', 'skills'])
            ->where('verified', true);

        // Search by name, current_job, or skills
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->orWhere('current_job', 'like', "%{$search}%")
            ->orWhere('about', 'like', "%{$search}%")
            ->orWhereHas('skills', function ($q) use ($search) {
                $q->where('skill', 'like', "%{$search}%");
            });
        }

        // Filter by skill
        if ($request->has('skill') && $request->skill) {
            $query->whereHas('skills', function ($q) use ($request) {
                $q->where('skill', $request->skill);
            });
        }

        $mentors = $query->latest()->get();

        // Calculate statistics for each mentor
        $mentors->transform(function ($mentor) {
            // Count completed sessions
            $completedSessions = $mentor->sessions()
                ->where('status', MentoringStatus::COMPLETED)
                ->count();

            // Get unique skills
            $skills = $mentor->skills->pluck('skill')->toArray();

            $mentor->stats = [
                'completed_sessions' => $completedSessions,
                'reputation_score' => $mentor->reputation_score ?? 0,
                'skills' => $skills,
            ];

            return $mentor;
        });

        // Get top mentors (by reputation and completed sessions)
        $topMentors = $mentors->sortByDesc(function ($mentor) {
            return ($mentor->stats['reputation_score'] ?? 0) * 100 + ($mentor->stats['completed_sessions'] ?? 0);
        })->take(5)->values();

        // Get unique skills for filter
        $availableSkills = MentorSkill::distinct('skill')->pluck('skill')->toArray();

        return view('mentor', [
            'mentors' => $mentors,
            'topMentors' => $topMentors,
            'availableSkills' => $availableSkills,
            'search' => $request->search,
            'selectedSkill' => $request->skill,
        ]);
    }

    /**
     * Show detail of a specific mentor
     */
    public function show($id): View
    {
        $mentor = Mentor::with([
            'user',
            'skills',
            'sessions.umkmOwner.user',
        ])
        ->where('verified', true)
        ->findOrFail($id);

        // Get statistics
        $completedSessions = $mentor->sessions()
            ->where('status', MentoringStatus::COMPLETED)
            ->count();

        $totalHours = $mentor->hoursLogs()->sum('hours_contributed');

        // Get unique skills
        $skills = $mentor->skills->pluck('skill')->toArray();

        // Add stats to mentor object
        $mentor->stats = [
            'completed_sessions' => $completedSessions,
            'reputation_score' => $mentor->reputation_score ?? 0,
            'skills' => $skills,
        ];

        return view('mentor-detail', [
            'mentor' => $mentor,
            'completedSessions' => $completedSessions,
            'totalHours' => $totalHours,
        ]);
    }
}
