<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LaraGym - Treina Mais Forte com IA</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">LARAGYM</div>
        <ul class="nav-links">
            <li><a href="#features">Funcionalidades</a></li>
            <li><a href="#pricing">Planos</a></li>
        </ul>
        <div>
            @if (Route::has('login'))
                <div>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>TREINA MAIS FORTE</h1>
            <h2>COM INTELIGÊNCIA ARTIFICIAL</h2>
            <p>Planos de treino personalizados, gerados por IA, adaptados aos teus objetivos e nível de experiência.</p>
            <div class="hero-buttons">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary" style="text-decoration: none; display: inline-block; text-align: center;">COMEÇAR AGORA</a>
                @endif
                
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn btn-secondary" style="text-decoration: none; display: inline-block; text-align: center;">JÁ TENS CONTA? ENTRAR</a>
                @endif
            </div>
        </div>
        <div class="hero-image">
            <img src="https://images.unsplash.com/photo-1677658139949-0378cc902911?crop=entropy&cs=srgb&fm=jpg&ixid=M3w4NjAzNDR8MHwxfHNlYXJjaHwxfHxpbnRlbnNlJTIwZ3ltJTIwd29ya291dCUyMGRhcmslMjBhZXN0aGV0aWMlMjBsaWdodGluZ3xlbnwwfHx8fDE3NzA2NDMwNzd8MA&ixlib=rb-4.1.0&q=85" alt="Gym atmosphere">
        </div>
    </section>
    <!-- Features Section -->
    <section id="features" class="features">
        <div class="features-title">
            <h2>FUNCIONALIDADES</h2>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="Personal Trainer Icon">
                <h3>IA Personal Trainer</h3>
                <p>Planos de treino personalizados, gerados por IA, adaptados aos teus objetivos e nível de experiência.</p>
            </div>
            <div class="feature-card">
                <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="Progress Tracking Icon">
                <h3>Acompanhamento de Progresso</h3>
                <p>Regista os teus treinos, acompanha o teu progresso e ajusta os teus planos conforme necessário.</p>
            </div>
            <div class="feature-card">
                <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="Community Icon">
                <h3>Comunidade Ativa</h3>
                <p>Partilha os teus resultados, troca dicas e motiva-te com outros entusiastas do fitness.</p>
            </div>
        </div>
    </section>

    
    <!-- Pricing Section -->
    <section id="pricing" class="pricing">
        <div class="pricing-title">
            <h2>PLANOS</h2>
        </div>
        <div class="pricing-grid">
            <!-- Free Plan -->
            <div class="pricing-card">
                <h3>GRATUITO</h3>
                <div class="price">0<span style="font-size: 1rem; color: #999;">/mês</span></div>
                <div class="price-period"></div>
                <ul class="pricing-features">
                    <li>Biblioteca de exercícios</li>
                    <li>Registo de treinos</li>
                    <li>Calendário básico</li>
                </ul>
                <a href="{{ route('register') }}" class="btn btn-secondary" style="text-decoration: none; display: inline-block; text-align: center;">COMEÇAR AGORA</a>
            </div>
            <!-- Basic Plan (Popular) -->
            <div class="pricing-card popular">
                <div class="popular-badge">POPULAR</div>
                <h3>BÁSICO</h3>
                <div class="price">29.99<span style="font-size: 1rem; color: #999;">/mês</span></div>
                <div class="price-period"></div>
                <ul class="pricing-features">
                    <li>Tudo do plano gratuito</li>
                    <li>IA Personal Trainer</li>
                    <li>Planos personalizados</li>
                </ul>
                <a href="{{ route('register') }}" class="btn btn-primary" style="text-decoration: none; display: inline-block; text-align: center;">SUBSCREVER</a>
            </div>
            <!-- Premium Plan -->
            <div class="pricing-card">
                <h3>PREMIUM</h3>
                <div class="price">49.99<span style="font-size: 1rem; color: #999;">/mês</span></div>
                <div class="price-period"></div>
                <ul class="pricing-features">
                    <li>Tudo do plano básico</li>
                    <li>Calendário avançado</li>
                    <li>Suporte prioritário</li>
                    <li>Relatórios de progresso</li>
                </ul>
                <a href="{{ route('register') }}" class="btn btn-primary" style="text-decoration: none; display: inline-block; text-align: center;">SUBSCREVER</a>
            </div>
        </div>
    </section>

    
    <!-- Footer -->
    <footer class="footer">
        <p><strong>LARAGYM</strong></p>
        <p>© 2026 LaraGym PAP </p>
    </footer>
</body>
</html>
