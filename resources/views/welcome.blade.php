<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaraGym - IA Fitness System</title>
    
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        orbitron: ['Orbitron', 'monospace'],
                        rajdhani: ['Rajdhani', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="h-full">
    <div id="app" class="w-full h-full overflow-auto bg-black text-green-400 font-rajdhani grid-bg">
        
        <nav class="fixed top-0 left-0 w-full z-50 bg-black/90 border-b border-green-900/50 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 border-2 border-green-400 rotate-45 flex items-center justify-center">
                        <i data-lucide="zap" class="w-4 h-4 -rotate-45 text-green-400"></i>
                    </div>
                    <span class="font-orbitron font-bold text-lg tracking-widest text-green-400 flicker">LARAGYM</span>
                </div>

                <div class="hidden md:flex gap-8 font-orbitron text-xs tracking-wider">
                    <a href="#features" class="hover:text-green-300 transition-colors uppercase">Funcionalidades</a>
                    <a href="#pricing" class="hover:text-green-300 transition-colors uppercase">Planos</a>
                </div>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-orbitron text-xs border border-green-500 px-4 py-2 hover:bg-green-500 hover:text-black transition-all">
                                DASHBOARD_
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="font-orbitron text-xs text-green-400 hover:text-white transition-colors">
                                LOGIN
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="font-orbitron text-xs bg-green-500/10 border border-green-500 px-4 py-2 text-green-400 hover:bg-green-500 hover:text-black transition-all">
                                    REGISTER
                                </a>
                            @endif
                        @endauth
                    @endif
                    <button id="mobile-menu-btn" class="md:hidden text-green-400"><i data-lucide="menu" class="w-6 h-6"></i></button>
                </div>
            </div>
        </nav>

        <header class="relative min-h-[600px] flex items-center justify-center cyber-scanline overflow-hidden pt-16 hex-pattern" style="min-height: 90%;">
            <div class="absolute inset-0 pointer-events-none opacity-20">
                <div class="absolute top-1/4 left-0 w-full h-px bg-gradient-to-r from-transparent via-green-500 to-transparent"></div>
                <div class="absolute top-0 left-1/4 w-px h-full bg-gradient-to-b from-transparent via-green-500 to-transparent"></div>
            </div>

            <div class="relative z-10 text-center px-4 max-w-4xl">
                <div class="inline-block mb-6 px-4 py-1 border border-green-800 bg-green-950/30 font-orbitron text-xs tracking-[0.3em] text-green-500">
                    ▸ POWERED BY AI ▸ LARAGYM_OS v2.0
                </div>
                <h1 class="font-orbitron font-black text-5xl sm:text-7xl md:text-8xl leading-none mb-4 text-glow text-green-400 glitch-hover">
                    TREINA MAIS FORTE
                </h1>
                <p class="font-rajdhani text-xl sm:text-2xl md:text-3xl font-light tracking-wider text-green-300/80 mb-10 uppercase">
                    Com Inteligência Artificial adaptada ao teu nível.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-orbitron text-sm tracking-widest px-10 py-4 bg