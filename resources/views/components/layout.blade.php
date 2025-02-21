<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style></style>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-full">

    <!-- Main Navbar -->
    <nav class="bg-blue-600 p-2 text-white flex justify-between items-center">
        <h1 class="text-lg font-bold">RepRec</h1>
        <h2 class="text-lg font-bold">{{ $heading }}</h2>
        <button id="btn-open-sidenav" class="text-white focus:outline-none text-2xl">
            ☰
        </button>
    </nav>
    <!-- SideNav (toggled) -->
    <div id="sidenav" class="fixed top-0 left-0 w-64 h-full bg-white shadow-lg transform -translate-x-full transition-transform duration-300 z-50">
        <div class="p-4 border-b flex justify-between items-center">
            <h2 class="text-lg font-semibold">Menu</h2>
            <button id="btn-close-sidenav" class="text-gray-600 text-2xl">&times;</button>
        </div>
        <!-- Nav items -->
        <ul class="p-4 space-y-4">
            <li><x-nav-link href="/" class="block text-gray-700 hover:text-blue-600">Home</x-nav-link></li>
            <li><x-nav-link href="/about" class="block text-gray-700 hover:text-blue-600">About</x-nav-link></li>
            <!-- Dropdown Item (Services with child options) -->
            <li>
                <button id="submenu-btn" class="w-full text-left flex justify-between items-center text-gray-700 hover:text-blue-600 focus:outline-none">
                    Services
                    <span id="submenu-icon">▼</span>
                </button>
                <ul id="submenu" class="ml-4 mt-2 hidden space-y-2">
                    <li><a href="#" class="block text-gray-600 hover:text-blue-600">Web Design</a></li>
                    <li><a href="#" class="block text-gray-600 hover:text-blue-600">SEO Optimization</a></li>
                    <li><a href="#" class="block text-gray-600 hover:text-blue-600">Marketing</a></li>
                </ul>
            </li>
            <!-- Divider -->
            <hr class="border-gray-300">
            <li><a href="#" class="block text-gray-700 hover:text-blue-600">Contact</a></li>
        </ul>
    </div>

    <!-- Main Content Overlay (as long as sideNav is open) -->
    <div id="overlay" class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 z-40"></div>

    <!-- Main Content - Display layout-view content here -->
    <!-- {{ $slot }} is equivalent to: php echo $slot -->
    <div>
        {{ $slot }}
    </div>

    <script>
        const sidenav = document.getElementById('sidenav');
        const overlay = document.getElementById('overlay');

        // Open SideNav (Main nav button)
        const btnOpenSideNav = document.getElementById('btn-open-sidenav');
        btnOpenSideNav.addEventListener('click', () => {
            sidenav.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });

        // Close Sidebar (done with "X" button or by clicking the Main-Content overlay)
        const btnCloseSideNav = document.getElementById('btn-close-sidenav');
        btnCloseSideNav.addEventListener('click', closeSidebar);
        overlay.addEventListener('click', closeSidebar);

        function closeSidebar() {
            sidenav.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        // Toggle Submenu
        const submenuBtn = document.getElementById('submenu-btn');
        const submenu = document.getElementById('submenu');
        const submenuIcon = document.getElementById('submenu-icon');
        submenuBtn.addEventListener('click', () => {
            submenu.classList.toggle('hidden');
            submenuIcon.textContent = submenu.classList.contains('hidden') ? '▼' : '▲';
        });
    </script>

</body>

</html>