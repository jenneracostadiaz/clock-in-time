<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans">
<div class="bg-gray-50">
    <div class="relative min-h-screen flex flex-col justify-between items-start">

        <header class="flex-1 w-full">
            @livewire('dashboard.navigation')
        </header>

        <main class="w-11/12 max-w-screen-xl mx-auto">
            @yield('content')
        </main>


    </div>
</div>
</body>
</html>

