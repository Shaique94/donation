<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Bajm Haidri' }}</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @livewireStyles
</head>
<body class="bg-gray-100">


    <!-- Main content -->
    <main class="p-6">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
