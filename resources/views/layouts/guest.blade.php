<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'LaraGym') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Rajdhani:wght@500&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                background-color: #0d0d14; /* El fondo oscuro de tu gym */
                font-family: 'Rajdhani', sans-serif;
            }
            .neon-border {
                border: 1px solid rgba(57, 255, 20, 0.3);
                box-shadow: 0 0 20px rgba(57, 255, 20, 0.1);
            }
            .text-neon {
                color: #39ff14;
                text-shadow: 0 0 10px rgba(57, 255, 20, 0.5);
                font-family: 'Orbitron', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-8">
                <a href="/" class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-neon rounded flex items-center justify-center shadow-[0_0_20px_#39ff14]">
                         <svg class="w-10 h-10 text-black" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.57 14.86L22 13.43 20.57 12 17 15.57 8.43 7 12 3.43 10.57 2 9.14 3.43 7.71 2 5.57 4.14 4.14 2.71 2.71 4.14l1.43 1.43L2 7.71l1.43 1.43L2 10.57 3.43 12 7 8.43 15.57 17 12 20.57 13.43 22l1.43-1.43L16.29 22l2.14-2.14 1.43 1.43 1.43-1.43-1.43-1.43L22 16.29z" />
                        </svg>
                    </div>
                    <h1 class="text-neon text-2xl mt-4 tracking-tighter">LARA<span class="text-white">GYM</span></h1>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-2 px-8 py-10 bg-[#161625] neon-border overflow-hidden sm:rounded-2xl">
                <div class="text-gray-300">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>