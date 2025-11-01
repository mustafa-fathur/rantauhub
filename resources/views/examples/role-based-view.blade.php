{{-- Example: Role-based view differentiation --}}

{{-- This is an example file showing how to differentiate views based on user role and type --}}

<div>
    {{-- Show admin-specific content --}}
    @if($isAdmin)
        <div class="admin-banner">
            <h2>Admin Dashboard</h2>
            <nav>
                <a href="{{ route('admin.users.index') }}">Manage Users</a>
                <a href="{{ route('admin.verifications.index') }}">Verifications</a>
            </nav>
        </div>
    @endif

    {{-- Show government-specific content --}}
    @if($isGovernment)
        <div class="government-banner">
            <h2>Government Dashboard</h2>
            <p>Government-specific features</p>
        </div>
    @endif

    {{-- Show content based on user type --}}
    @switch($userType)
        @case(\App\Enums\UserType::UMKM_OWNER)
            <div class="umkm-dashboard">
                <h2>UMKM Owner Dashboard</h2>
                <p>Manage your businesses and funding requests</p>
                <a href="{{ route('umkm.businesses.index') }}">My Businesses</a>
            </div>
            @break

        @case(\App\Enums\UserType::MENTOR)
            <div class="mentor-dashboard">
                <h2>Mentor Dashboard</h2>
                <p>Manage your mentoring sessions</p>
                <a href="{{ route('mentor.sessions.index') }}">My Sessions</a>
            </div>
            @break

        @case(\App\Enums\UserType::FUNDER)
            <div class="funder-dashboard">
                <h2>Funder Dashboard</h2>
                <p>Manage your investments</p>
                <a href="{{ route('funder.fundings.index') }}">My Fundings</a>
            </div>
            @break

        @default
            <div class="welcome-message">
                <h2>Welcome!</h2>
                <p>Please complete your profile to get started.</p>
            </div>
    @endswitch

    {{-- Show navigation based on role and type --}}
    <nav>
        @auth
            @if($isAdmin)
                <a href="/admin">Admin Panel</a>
            @endif

            @if($userType === \App\Enums\UserType::UMKM_OWNER)
                <a href="/umkm/dashboard">UMKM Dashboard</a>
            @endif

            @if($userType === \App\Enums\UserType::MENTOR)
                <a href="/mentor/dashboard">Mentor Dashboard</a>
            @endif

            @if($userType === \App\Enums\UserType::FUNDER)
                <a href="/funder/dashboard">Funder Dashboard</a>
            @endif
        @endauth
    </nav>
</div>

