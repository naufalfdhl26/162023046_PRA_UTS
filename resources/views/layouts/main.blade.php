<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#f5f5f5] font-sans text-slate-900 antialiased">
        <div class="flex min-h-screen flex-col">
            @include('partials.navbar')

            <main class="mx-auto w-full max-w-7xl flex-1 px-3 py-4 sm:px-4 lg:px-6">
                @if (session('success'))
                    <div class="mb-4 animate-soft-pop rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>

            @include('partials.footer')
        </div>
    </body>
</html>
