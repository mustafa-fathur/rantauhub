<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $totalUmkm = 0;
        
        if ($user->umkmOwner) {
            $totalUmkm = $user->umkmOwner->businesses()->count();
        }

        return view('user.dashboard', [
            'title' => 'Dashboard User',
            'totalUmkm' => $totalUmkm,
        ]);
    }
}
