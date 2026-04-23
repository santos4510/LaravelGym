<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'LaraGym') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('styles') 
    </head>
    <body class="font-sans antialiased bg-[#050509]"> {{-- Fondo Negro Profundo --}}
        <div class="min-h-screen bg-[#050509]">
            {{-- La Navbar Cyberpunk --}}
            @include('layouts.navigation')

            {{-- Encabezado de página (Opcional, con estilo glitch) --}}
            @isset($header)
                <header class="bg-[#0c0c16] border-b border-neon-fuchsia/10 shadow-[0_4px_15px_rgba(255,0,119,0.05)]">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- Contenido Principal (El Dashboard) --}}
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('scripts')
    </body>
</html>