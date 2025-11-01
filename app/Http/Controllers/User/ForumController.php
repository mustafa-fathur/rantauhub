<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ForumController extends Controller
{
    public function index(): View
    {
        return view('user.my-forum', [
            'title' => 'Forum Saya',
        ]);
    }
}
