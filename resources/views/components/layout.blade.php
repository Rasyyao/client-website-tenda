@props([
    'title' => null,
    'description' => config('site.tagline'),
])

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ? $title.' — '.config('site.legal_name') : config('site.legal_name').' — Sewa Tenda, Konser & Perlengkapan Event' }}</title>
        <meta name="description" content="{{ $description }}">
        <meta name="theme-color" content="#111214">
        <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 36 36'%3E%3Crect width='36' height='36' rx='8' fill='%23ff5a1f'/%3E%3Cpath d='M18 9 28 26H8z' fill='white'/%3E%3C/svg%3E">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen overflow-x-clip">
        <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-[100] focus:rounded-full focus:bg-ink focus:px-4 focus:py-2 focus:text-white">Lewati ke konten</a>

        <main id="main">
            {{ $slot }}
        </main>

        <x-site.footer />
    </body>
</html>
