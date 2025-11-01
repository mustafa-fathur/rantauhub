<?php

namespace App\Http\Controllers\User;

use App\Enums\FundingStatus;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        
        // Calculate statistics
        $totalUmkm = 0;
        $verifiedUmkmCount = 0;
        
        if ($user->umkmOwner) {
            $totalUmkm = $user->umkmOwner->businesses()->count();
            $verifiedUmkmCount = $user->umkmOwner->businesses()->where('verified', true)->count();
        }

        // Total Mentees (sessions as mentor)
        $totalMentees = 0;
        if ($user->mentor) {
            $totalMentees = $user->mentor->sessions()->count();
        }

        // Total Dana Diberikan (funding given as funder)
        $totalFundingGiven = 0;
        if ($user->funder) {
            $totalFundingGiven = $user->funder->fundings()
                ->where('status', FundingStatus::APPROVED)
                ->sum('amount');
        }

        // Total Posts
        $totalPosts = $user->posts()->count();

        return view('user.dashboard', [
            'title' => 'Dashboard User',
            'totalUmkm' => $totalUmkm,
            'verifiedUmkmCount' => $verifiedUmkmCount,
            'totalMentees' => $totalMentees,
            'totalFundingGiven' => $totalFundingGiven,
            'totalPosts' => $totalPosts,
        ]);
    }
}
