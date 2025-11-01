@extends('components.layouts.user.dashboard', ['title' => $title ?? 'Forum Saya'])

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex gap-6">
        <!-- Sidebar Card -->
        <x-user.sidebar :user="auth()->user()" />

        <!-- Main Content Area -->
        <main class="flex-1 min-w-0">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-primary mb-2">Forum Aktivitas Saya</h1>
                <p class="text-zinc-600">Kelola postingan dan aktivitas forum Anda</p>
            </div>

            <!-- Forum Content -->
            <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-6">
                <p class="text-zinc-600 text-center py-12">Konten forum akan ditampilkan di sini</p>
            </div>
        </main>
    </div>
</div>
@endsection