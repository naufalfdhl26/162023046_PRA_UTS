<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#f5f5f5] font-sans antialiased">
        <div class="flex min-h-screen items-center justify-center bg-gradient-to-br from-[#ee4d2d] via-[#ff7337] to-orange-100 px-4 py-10">
            <div class="w-full max-w-md animate-soft-pop rounded-3xl bg-white p-6 shadow-2xl shadow-orange-950/20 ring-1 ring-white/60 sm:p-8">
                <a href="{{ route('home') }}" class="mx-auto mb-6 flex w-max items-center gap-2 text-[#ee4d2d]">
                    <span class="grid h-11 w-11 place-items-center rounded-2xl bg-orange-50 shadow-sm">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 12 3l9 4.5-9 4.5L3 7.5Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="m3 12 9 4.5 9-4.5M3 16.5 12 21l9-4.5" />
                        </svg>
                    </span>
                    <span class="text-2xl font-extrabold">UTS Shop</span>
                </a>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
