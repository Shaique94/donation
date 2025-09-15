<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Bazm-e-Haidri' }}</title>
    <!-- Google Poppins Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @livewireStyles
    <style>
        body, html {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">


<!-- Header/Navbar -->
<nav class="bg-white shadow-md p-4 fixed top-0 left-0 right-0 z-50 lg:pl-72">
    <div class="flex items-center justify-between">
        <!-- Mobile menu button -->
        <button id="mobile-menu-button" class="lg:hidden inline-flex items-center p-2 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
        </button>
        
        <!-- Home link -->
        <a href="/" class="font-bold text-gray-800 text-lg">Home</a>
        
        <!-- Right side content (optional) -->
        <div class="hidden sm:block">
            <!-- Add any right-side nav items here -->
        </div>
    </div>
</nav>

<!-- Overlay for mobile -->
<div id="sidebar-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-40 lg:hidden hidden"></div>

<!-- Sidebar -->
<aside id="sidebar" class="fixed top-0 left-0 z-50 w-64 h-screen pt-5 bg-[#fcf4e1] border-r border-gray-200 lg:translate-x-0 -translate-x-full transition-transform duration-300 ease-in-out">
    <div class="h-full px-4 overflow-y-auto">
        <!-- Close button for mobile -->
        <button id="sidebar-close" class="lg:hidden absolute top-4 right-4 text-gray-500 hover:text-gray-700">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
        
        <!-- Logo -->
        <div class="flex flex-col items-center mb-6">
            <img src="{{asset("images/logo.png")}}" alt="Bazm-e-Haidri" class="w-40 h-auto mb-2">
        </div>

        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{route('admin.dashboard')}}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>

           
            <li>
                <a href="{{route('admin.users')}}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 0 20 18">
                        <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Users</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.plan.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 0 18 20">
                        <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z"/>
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Plans</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.donations')}}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4C4 2.89543 4.89543 2 6 2H14C15.1046 2 16 2.89543 16 4V16C16 17.1046 15.1046 18 14 18H6C4.89543 18 4 17.1046 4 16V4Z"/>
                        <path d="M9 6H11V14H9V6Z"/>
                        <path d="M7 9H13V11H7V9Z"/>
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Donations</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.expenses')}}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 3C3.89543 3 3 3.89543 3 5V7C3 8.10457 3.89543 9 5 9H7C8.10457 9 9 8.10457 9 7V5C9 3.89543 8.10457 3 7 3H5Z"/>
                        <path d="M5 11C3.89543 11 3 11.8954 3 13V15C3 16.1046 3.89543 17 5 17H7C8.10457 17 9 16.1046 9 15V13C9 11.8954 8.10457 11 7 11H5Z"/>
                        <path d="M13 3C11.8954 3 11 3.89543 11 5V7C11 8.10457 11.8954 9 13 9H15C16.1046 9 17 8.10457 17 7V5C17 3.89543 16.1046 3 15 3H13Z"/>
                        <path d="M13 11C11.8954 11 11 11.8954 11 13V15C11 16.1046 11.8954 17 13 17H15C16.1046 17 17 16.1046 17 15V13C17 11.8954 16.1046 11 15 11H13Z"/>
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Expenses</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.reports')}}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 4C5 3.44772 5.44772 3 6 3H14C14.5523 3 15 3.44772 15 4V16C15 16.5523 14.5523 17 14 17H6C5.44772 17 5 16.5523 5 16V4Z"/>
                        <path d="M7 7H13V8H7V7Z"/>
                        <path d="M7 10H13V11H7V10Z"/>
                        <path d="M7 13H11V14H7V13Z"/>
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Reports</span>
                </a>
            </li>
           
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 w-full text-left">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z"/>
                            <path d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z"/>
                            <path d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z"/>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Logout</span>
                    </button>
                </form>
            </li>
        </ul>
        
        <!-- Powered by footer -->
        <div class="mt-auto pt-6 text-center text-xs text-gray-500 ">
            <p>Powered by</p>
            <p class="font-semibold">Comestro Techlabs</p>
        </div>
    </div>
</aside>

<!-- Main content -->
<main class="pt-16 lg:pl-64">
    {{ $slot }}
</main>
<script>
    // Mobile menu functionality
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const sidebarClose = document.getElementById('sidebar-close');

    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('translate-x-0');
        sidebarOverlay.classList.remove('hidden');
    }

    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        sidebar.classList.remove('translate-x-0');
        sidebarOverlay.classList.add('hidden');
    }

    // Open sidebar on mobile menu button click
    mobileMenuButton.addEventListener('click', openSidebar);

    // Close sidebar when clicking the close button
    sidebarClose.addEventListener('click', closeSidebar);

    // Close sidebar when clicking the overlay
    sidebarOverlay.addEventListener('click', closeSidebar);

    // Close sidebar when pressing escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSidebar();
        }
    });

    // Close sidebar on window resize if screen becomes large
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) { // lg breakpoint
            closeSidebar();
        }
    });
</script>

    @livewireScripts
</body>
</html>
