<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full" data-theme="bumblebee">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RepRec</title>

    <!-- Fonts, Icons, Styles, etc. -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @vite(entrypoints: ['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full min-h-screen">
    <!-- Main Navbar -->
    <div class="navbar sticky top-0 z-40 bg-neutral text-neutral-content flex justify-between items-center"
        style="height: 50px !important; min-height: 40px !important;">
        <x-nav-link href="/">
            <div class="text-center">
                <h1 class="text-lg font-bold">RepRec</h1>
                <p class="text-xs text-gray-500" style="margin-top: -5px !important;">
                    vers. {{ config('app.version') }}
                </p>
            </div>
        </x-nav-link></li>
        <h2 class="text-lg font-bold">{{ $heading }}</h2>
        <label for="sidenav-drawer" class="btn btn-square btn-ghost drawer-button">☰</label>
    </div>
    <!-- SideNav (toggled) with Page Content -->
    <div class="drawer">
        <input id="sidenav-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- ----------------------------------------------- -->
            <!-- Main Content - Display layout-view content here -->
            <!-- ----------------------------------------------- -->
            <div class="slot-container relative">
                {{ $slot }}
            </div>
        </div>
        <div class="drawer-side z-50">
            <!-- Side Nav Links -->
            <label for="sidenav-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu text-base-content min-h-full bg-base-200 w-80 p-2">
                @auth
                    <p class="text-xs float text-center m-2">Hello {{ Auth::user()->name }}</p>
                @else
                    <p class="text-xs float text-center m-2">Hello Guest</p>
                @endauth
                <li><x-nav-link href="/">Home</x-nav-link></li>
                <div class="divider divider-neutral"></div>
                <li><x-nav-link href="/user-howto">User Guide</x-nav-link></li>
                @can('isUser')
                    <li><x-nav-link href="/profile">User Profile</x-nav-link></li>
                @endcan
                <!-- 
                        GATE AUTHORIZATION: Training, Planning and Admin sections are locked behind the user-role
                        (Must be authenticated and must have at least the user-role to work with the core systems)
                    -->
                @can('isUser')
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
                    <!-- GATE AUTHORIZATION: Planning section is additionally locked behind the planner-role -->
                    @can('isPlanner')
                        <li>
                            <details open>
                                <summary>Planning</summary>
                                <ul>
                                    <li><x-nav-link href="/plan-workout">Plan Workouts</x-nav-link></li>
                                    <li><x-nav-link href="/plan-share">Plan Sharing</x-nav-link></li>
                                </ul>
                            </details>
                        </li>
                    @endcan
                    <!-- GATE AUTHORIZATION: Admin section is additionally locked behind the admin-role -->
                    @can('isAdmin')
                        <li>
                            <details closed>
                                <summary>Administration</summary>
                                <ul>
                                    <li><x-nav-link href="/admin-logs/2">Admin Logs</x-nav-link></li>
                                    <li><x-nav-link href="/admin-userroles">Admin User-Roles</x-nav-link></li>
                                    <li><x-nav-link href="/admin-selections">Admin Selections</x-nav-link></li>
                                </ul>
                            </details>
                        </li>
                    @endcan
                @endcan
                <div class="divider divider-neutral"></div>
                <div class="flex justify-center items-center">
                    <div>
                        @auth
                            <!-- Logout Button -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="btn btn-accent" :href="route('logout')"
                                    onclick="event.preventDefault();  this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        @else
                            <!-- Login / Register Button -->
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

    <!-- --------------------------------------------------------------------------------
     --------------------------- GLOBAL JAVASCRIPT FUNCTIONS ----------------------------
     -------------------------------------------------------------------------------- -->
    <script>
        // Component: x-dlg-confirm-delete
        // Function: Call the modal delete dialog with a dynamic delete route
        function openDeleteModal(deleteRoute) {
            const deleteForm = document.getElementById('delete-modal-form');
            deleteForm.action = deleteRoute;

            // Show the modal
            const modal = document.getElementById('delete-modal');
            modal.showModal();
        }
    </script>
    <!-- --------------------------------------------------------------------------------
     ---------------------------- LOCAL JAVASCRIPT FUNCTIONS ----------------------------
     ------- JavaScript code from child-views added with push / pushOnce goes here ------
     -------------------------------------------------------------------------------- -->
    @stack('js_after')
</body>

</html>