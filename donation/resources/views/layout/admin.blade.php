<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'My App' }}</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @livewireStyles
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow p-4">
        <a href="/" class="font-bold">Home</a>
    </nav>

    <!-- Main content -->
    <main class="p-6">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
