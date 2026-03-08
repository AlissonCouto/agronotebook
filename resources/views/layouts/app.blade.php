<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AgroNotebook') }}</title>

    <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100 font-sans antialiased">

    <div x-data="{ sidebarOpen: true }" class="flex h-screen">

        @include('layouts.sidebar')

        <div class="flex flex-col flex-1">

            @include('layouts.header')

            <main class="p-6 flex-1 overflow-y-auto">
                @yield('content')
            </main>

        </div>

    </div>

</body>

</html>