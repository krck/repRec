<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full" data-theme="cupcake">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RepRec</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style></style>

    <!-- Scripts -->
    @vite(entrypoints: ['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-full">
    <!-- Main Navbar -->
    <div class="navbar bg-neutral text-neutral-content flex justify-between items-center">
        <h1 class="text-lg font-bold">RepRec</h1>
        <h2 class="text-lg font-bold">{{ $heading }}</h2>
        <label for="sidenav-drawer" class="btn btn-square btn-ghost drawer-button">☰</label>
    </div>
    <!-- SideNav (toggled) with Page Content -->
    <div class="drawer">
        <input id="sidenav-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Main Content - Display layout-view content here -->
            <!-- {{ $slot }} is equivalent to: php echo $slot -->
            <div>
                {{ $slot }}
            </div>
        </div>
        <div class="drawer-side">
            <!-- Side Nav Links -->
            <label for="sidenav-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
                <li><x-nav-link href="/">Home</x-nav-link></li>
                <div class="divider divider-neutral"></div>
                <li><x-nav-link href="/user-info">User Info</x-nav-link></li>
                <li><x-nav-link href="/user-settings">User Settings</x-nav-link></li>
                <li><x-nav-link href="/user-howto">User HowTo</x-nav-link></li>
                <div class="divider divider-neutral"></div>
                <li>
                    <details open>
                        <summary>Training</summary>
                        <ul>
                            <li><x-nav-link href="/training-week">Training Week</x-nav-link></li>
                            <li><x-nav-link href="/training-year">Training Year</x-nav-link></li>
                            <li><x-nav-link href="/training-progress">Training Progress</x-nav-link></li>
                        </ul>
                    </details>
                </li>
                <li>
                    <details closed>
                        <summary>Planning</summary>
                        <ul>
                            <li><x-nav-link href="/plan-workout">Plan Workouts</x-nav-link></li>
                            <li><x-nav-link href="/plan-share">Plan Sharing</x-nav-link></li>
                        </ul>
                    </details>
                </li>
                <li>
                    <details closed>
                        <summary>Administration</summary>
                        <ul>
                            <li><x-nav-link href="/admin-logs/2">Admin Logs</x-nav-link></li>
                            <li><x-nav-link href="/admin-options">Admin Options</x-nav-link></li>
                            <li><x-nav-link href="/admin-userroles">Admin User-Roles</x-nav-link></li>
                        </ul>
                    </details>
                </li>
                <div class="divider divider-neutral"></div>
                <div class="flex justify-center items-center">
                    <div>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-accent">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-accent">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-accent">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </ul>
        </div>
    </div>
</body>

</html>