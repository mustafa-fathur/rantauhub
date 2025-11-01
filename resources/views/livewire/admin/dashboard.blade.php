<?php

use function Livewire\Volt\layout;
use Livewire\Volt\Component;
use App\Models\User;
use App\Models\UmkmOwner;
use App\Models\UmkmBusiness;
use App\Models\Mentor;
use App\Models\Funder;
use App\Models\Funding;
use App\Models\Forum;
use App\Models\Post;
use App\Models\Comment;
use App\Models\PostLike;
use App\Models\MentorSession;

layout('components.layouts.app.sidebar');

new class extends Component {
    public function with(): array
    {
        return [
            'title' => __('Dashboard'),
            'stats' => [
                'total_users' => User::count(),
                'total_umkm_owners' => UmkmOwner::count(),
                'total_umkm_businesses' => UmkmBusiness::count(),
                'total_mentors' => Mentor::count(),
                'total_funders' => Funder::count(),
                'total_fundings' => Funding::count(),
                'total_forums' => Forum::count(),
                'total_posts' => Post::count(),
                'total_comments' => Comment::count(),
                'total_likes' => PostLike::count(),
                'total_mentor_sessions' => MentorSession::count(),
                'verified_umkm' => UmkmBusiness::where('verified', true)->count(),
                'verified_mentors' => Mentor::where('verified', true)->count(),
                'verified_funders' => Funder::where('verified', true)->count(),
                'pending_fundings' => Funding::where('status', 'pending')->count(),
                'approved_fundings' => Funding::where('status', 'approved')->count(),
                'total_funding_amount' => Funding::where('status', 'approved')->sum('amount'),
            ],
        ];
    }
}; ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h1 class="text-3xl font-bold text-primary">Admin Dashboard</h1>
        <p class="text-zinc-600 mt-1">Selamat datang kembali, {{ auth()->user()->name }}</p>
    </div>

    <!-- Main Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-primary/10 rounded-lg">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Users</h3>
            <p class="text-2xl font-bold text-zinc-900">{{ number_format($stats['total_users']) }}</p>
        </div>
        
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-secondary/10 rounded-lg">
                    <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Pelaku UMKM</h3>
            <p class="text-2xl font-bold text-zinc-900">{{ number_format($stats['total_umkm_owners']) }}</p>
            <p class="text-xs text-zinc-500 mt-1">{{ $stats['total_umkm_businesses'] }} bisnis terdaftar</p>
        </div>
        
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-accent/10 rounded-lg">
                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Mentors</h3>
            <p class="text-2xl font-bold text-zinc-900">{{ number_format($stats['total_mentors']) }}</p>
            <p class="text-xs text-zinc-500 mt-1">{{ $stats['verified_mentors'] }} terverifikasi</p>
        </div>
        
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-primary/10 rounded-lg">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-1-1.732l-4-2.309a2 2 0 00-1.732 0l-4 2.309A2 2 0 001 11.269V19a2 2 0 002 2h14a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Funders</h3>
            <p class="text-2xl font-bold text-zinc-900">{{ number_format($stats['total_funders']) }}</p>
            <p class="text-xs text-zinc-500 mt-1">{{ $stats['verified_funders'] }} terverifikasi</p>
        </div>
    </div>

    <!-- Secondary Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-secondary/10 rounded-lg">
                    <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Funding</h3>
            <p class="text-2xl font-bold text-zinc-900">{{ number_format($stats['total_fundings']) }}</p>
            <p class="text-xs text-zinc-500 mt-1">{{ $stats['approved_fundings'] }} disetujui</p>
        </div>

        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-primary/10 rounded-lg">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Forum Diskusi</h3>
            <p class="text-2xl font-bold text-zinc-900">{{ number_format($stats['total_forums']) }}</p>
            <p class="text-xs text-zinc-500 mt-1">{{ $stats['total_posts'] }} postingan</p>
        </div>

        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-accent/10 rounded-lg">
                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Komentar</h3>
            <p class="text-2xl font-bold text-zinc-900">{{ number_format($stats['total_comments']) }}</p>
            <p class="text-xs text-zinc-500 mt-1">{{ $stats['total_likes'] }} likes</p>
        </div>

        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-secondary/10 rounded-lg">
                    <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Sesi Mentoring</h3>
            <p class="text-2xl font-bold text-zinc-900">{{ number_format($stats['total_mentor_sessions']) }}</p>
        </div>
    </div>

    <!-- Funding Summary -->
    <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
        <h2 class="text-xl font-semibold text-primary mb-4">Ringkasan Pendanaan</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 bg-primary/5 rounded-lg border border-primary/20">
                <p class="text-sm font-medium text-zinc-600 mb-1">Total Dana Disetujui</p>
                <p class="text-2xl font-bold text-primary">Rp {{ number_format($stats['total_funding_amount'], 0, ',', '.') }}</p>
            </div>
            <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                <p class="text-sm font-medium text-zinc-600 mb-1">Menunggu Persetujuan</p>
                <p class="text-2xl font-bold text-yellow-700">{{ number_format($stats['pending_fundings']) }}</p>
            </div>
            <div class="p-4 bg-green-50 rounded-lg border border-green-200">
                <p class="text-sm font-medium text-zinc-600 mb-1">Telah Disetujui</p>
                <p class="text-2xl font-bold text-green-700">{{ number_format($stats['approved_fundings']) }}</p>
            </div>
        </div>
    </div>

    <!-- Verification Status -->
    <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
        <h2 class="text-xl font-semibold text-primary mb-4">Status Verifikasi</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 border border-zinc-200 rounded-lg">
                <p class="text-sm font-medium text-zinc-600 mb-1">UMKM Terverifikasi</p>
                <p class="text-2xl font-bold text-zinc-900">{{ number_format($stats['verified_umkm']) }} / {{ number_format($stats['total_umkm_businesses']) }}</p>
                <div class="mt-2 w-full bg-zinc-200 rounded-full h-2">
                    <div class="bg-secondary h-2 rounded-full" style="width: {{ $stats['total_umkm_businesses'] > 0 ? ($stats['verified_umkm'] / $stats['total_umkm_businesses'] * 100) : 0 }}%"></div>
                </div>
            </div>
            <div class="p-4 border border-zinc-200 rounded-lg">
                <p class="text-sm font-medium text-zinc-600 mb-1">Mentor Terverifikasi</p>
                <p class="text-2xl font-bold text-zinc-900">{{ number_format($stats['verified_mentors']) }} / {{ number_format($stats['total_mentors']) }}</p>
                <div class="mt-2 w-full bg-zinc-200 rounded-full h-2">
                    <div class="bg-accent h-2 rounded-full" style="width: {{ $stats['total_mentors'] > 0 ? ($stats['verified_mentors'] / $stats['total_mentors'] * 100) : 0 }}%"></div>
                </div>
            </div>
            <div class="p-4 border border-zinc-200 rounded-lg">
                <p class="text-sm font-medium text-zinc-600 mb-1">Funder Terverifikasi</p>
                <p class="text-2xl font-bold text-zinc-900">{{ number_format($stats['verified_funders']) }} / {{ number_format($stats['total_funders']) }}</p>
                <div class="mt-2 w-full bg-zinc-200 rounded-full h-2">
                    <div class="bg-primary h-2 rounded-full" style="width: {{ $stats['total_funders'] > 0 ? ($stats['verified_funders'] / $stats['total_funders'] * 100) : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
        <h2 class="text-xl font-semibold text-primary mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 p-4 rounded-lg border border-zinc-200 hover:border-primary hover:bg-primary/5 transition">
                <div class="p-2 bg-primary/10 rounded-lg">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-zinc-900">Settings</h3>
                    <p class="text-sm text-zinc-600">Manage your profile</p>
                </div>
            </a>
        </div>
    </div>
</div>
