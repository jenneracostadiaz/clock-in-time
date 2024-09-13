<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="antialiased font-sans bg-gray-50 relative min-h-screen flex flex-col justify-between items-start">
<header class="w-full">
    @livewire('dashboard.navigation')
</header>

<main class="flex-1 w-11/12 max-w-screen-xl mx-auto my-6">
    @yield('content')
</main>
</body>
</html>

