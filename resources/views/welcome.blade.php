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

        

        <style>

            * {

                margin: 0;

                padding: 0;

                box-sizing: border-box;

            }



            body {

                font-family: 'Figtree', sans-serif;

                background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 100%);

                color: #ffffff;

                overflow-x: hidden;

            }



            /* Header/Navbar */

            .navbar {

                display: flex;

                justify-content: space-between;

                align-items: center;

                padding: 1.5rem 5%;

                background: rgba(15, 15, 15, 0.95);

                backdrop-filter: blur(10px);

                position: sticky;

                top: 0;

                z-index: 1000;

                border-bottom: 1px solid rgba(255, 255, 255, 0.1);

            }



            .logo {

                font-size: 1.5rem;

                font-weight: 700;

                letter-spacing: 2px;

                background: linear-gradient(135deg, #ff6b6b, #ffd93d);

                -webkit-background-clip: text;

                -webkit-text-fill-color: transparent;

                background-clip: text;

            }



            .nav-links {

                display: flex;

                gap: 2rem;

                list-style: none;

            }



            .nav-links a {

                color: #ffffff;

                text-decoration: none;

                font-weight: 500;

                transition: color 0.3s ease;

            }



            .nav-links a:hover {

                color: #ff6b6b;

            }



            .nav-buttons {

                display: flex;

                gap: 1rem;

            }



            .btn {

                padding: 0.75rem 1.5rem;

                border: none;

                border-radius: 0.5rem;

                font-weight: 600;

                cursor: pointer;

                transition: all 0.3s ease;

                font-size: 0.95rem;

            }



            .btn-secondary {

                background: transparent;

                color: #ffffff;

                border: 2px solid rgba(255, 255, 255, 0.3);

            }



            .btn-secondary:hover {

                background: rgba(255, 255, 255, 0.1);

                border-color: #ff6b6b;

                color: #ff6b6b;

            }



            .btn-primary {

                background: linear-gradient(135deg, #ff6b6b, #ff8c42);

                color: white;

                border: none;

            }



            .btn-primary:hover {

                transform: translateY(-2px);

                box-shadow: 0 10px 30px rgba(255, 107, 107, 0.4);

            }



            /* Hero Section */

            .hero {

                display: grid;

                grid-template-columns: 1fr 1fr;

                align-items: center;

                gap: 3rem;

                padding: 5rem 5%;

                min-height: 90vh;

            }



            .hero-content h1 {

                font-size: 3.5rem;

                font-weight: 700;

                line-height: 1.1;

                margin-bottom: 1rem;

                background: linear-gradient(135deg, #ffffff, #ff6b6b);

                -webkit-background-clip: text;

                -webkit-text-fill-color: transparent;

                background-clip: text;

            }



            .hero-content h2 {

                font-size: 2rem;

                font-weight: 600;

                color: #ffd93d;

                margin-bottom: 1.5rem;

            }



            .hero-content p {

                font-size: 1.1rem;

                color: #cccccc;

                margin-bottom: 2rem;

                line-height: 1.6;

            }



            .hero-buttons {

                display: flex;

                gap: 1rem;

                margin-bottom: 2rem;

            }



            .hero-buttons .btn {

                padding: 1rem 2rem;

                font-size: 1rem;

            }



            .hero-image {

                position: relative;

                height: 500px;

            }



            .hero-image img {

                width: 100%;

                height: 100%;

                object-fit: cover;

                border-radius: 1rem;

                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);

            }



            .badge {

                display: inline-block;

                background: rgba(255, 107, 107, 0.2);

                border: 1px solid #ff6b6b;

                color: #ff6b6b;

                padding: 0.5rem 1rem;

                border-radius: 2rem;

                font-size: 0.85rem;

                font-weight: 600;

                margin-bottom: 1rem;

            }



            /* Features Section */

            .features {

                padding: 5rem 5%;

                background: rgba(255, 255, 255, 0.02);

            }



            .features-title {

                text-align: center;

                margin-bottom: 4rem;

            }



            .features-title h2 {

                font-size: 2.5rem;

                font-weight: 700;

                margin-bottom: 0.5rem;

            }



            .features-grid {

                display: grid;

                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));

                gap: 2rem;

            }



            .feature-card {

                background: rgba(255, 255, 255, 0.05);

                border: 1px solid rgba(255, 255, 255, 0.1);

                padding: 2rem;

                border-radius: 1rem;

                transition: all 0.3s ease;

                backdrop-filter: blur(10px);

            }



            .feature-card:hover {

                transform: translateY(-10px);

                background: rgba(255, 255, 255, 0.08);

                border-color: #ff6b6b;

                box-shadow: 0 20px 40px rgba(255, 107, 107, 0.1);

            }



            .feature-icon {

                font-size: 2.5rem;

                margin-bottom: 1rem;

            }



            .feature-card h3 {

                font-size: 1.3rem;

                font-weight: 600;

                margin-bottom: 0.75rem;

            }



            .feature-card p {

                color: #b0b0b0;

                line-height: 1.6;

            }



            /* Pricing Section */

            .pricing {

                padding: 5rem 5%;

            }



            .pricing-title {

                text-align: center;

                margin-bottom: 4rem;

            }



            .pricing-title h2 {

                font-size: 2.5rem;

                font-weight: 700;

                margin-bottom: 0.5rem;

            }



            .pricing-grid {

                display: grid;

                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));

                gap: 2rem;

                max-width: 1200px;

                margin: 0 auto;

            }



            .pricing-card {

                background: rgba(255, 255, 255, 0.05);

                border: 2px solid rgba(255, 255, 255, 0.1);

                padding: 2.5rem;

                border-radius: 1rem;

                text-align: center;

                transition: all 0.3s ease;

                position: relative;

            }



            .pricing-card.popular {

                border-color: #ff6b6b;

                background: rgba(255, 107, 107, 0.1);

                transform: scale(1.05);

            }



            .pricing-card.popular .popular-badge {

                position: absolute;

                top: -15px;

                left: 50%;

                transform: translateX(-50%);

                background: #ff6b6b;

                color: white;

                padding: 0.5rem 1rem;

                border-radius: 2rem;

                font-size: 0.8rem;

                font-weight: 600;

            }



            .pricing-card:hover {

                transform: translateY(-10px);

                box-shadow: 0 20px 40px rgba(255, 107, 107, 0.1);

            }



            .pricing-card h3 {

                font-size: 1.5rem;

                font-weight: 700;

                margin-bottom: 1rem;

            }



            .price {

                font-size: 2.5rem;

                font-weight: 700;

                color: #ffd93d;

                margin-bottom: 0.5rem;

            }



            .price-period {

                color: #999999;

                font-size: 1rem;

                margin-bottom: 2rem;

            }



            .pricing-features {

                text-align: left;

                margin-bottom: 2rem;

                list-style: none;

            }



            .pricing-features li {

                padding: 0.75rem 0;

                border-bottom: 1px solid rgba(255, 255, 255, 0.1);

                color: #cccccc;

            }



            .pricing-features li:last-child {

                border-bottom: none;

            }



            .pricing-features li:before {

                content: "✓ ";

                color: #ff6b6b;

                font-weight: bold;

                margin-right: 0.75rem;

            }



            /* Footer */

            .footer {

                background: rgba(0, 0, 0, 0.5);

                border-top: 1px solid rgba(255, 255, 255, 0.1);

                padding: 3rem 5%;

                text-align: center;

                color: #999999;

            }



            .footer p {

                margin-bottom: 1rem;

            }



            .footer a {

                color: #ff6b6b;

                text-decoration: none;

                transition: color 0.3s ease;

            }



            .footer a:hover {

                color: #ffd93d;

            }



            /* Responsive */

            @media (max-width: 768px) {

                .hero {

                    grid-template-columns: 1fr;

                    padding: 3rem 5%;

                    min-height: auto;

                }



                .hero-content h1 {

                    font-size: 2.5rem;

                }



                .hero-content h2 {

                    font-size: 1.5rem;

                }



                .nav-links {

                    display: none;

                }



                .navbar {

                    padding: 1rem 5%;

                }



                .hero-image {

                    height: 300px;

                }



                .pricing-card.popular {

                    transform: scale(1);

                }



                .hero-buttons {

                    flex-direction: column;

                }



                .hero-buttons .btn {

                    width: 100%;

                }

            }

        </style>

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

                <span class="badge">POWERED BY AI</span>

                <h1>TREINA MAIS FORTE</h1>

                <h2>COM INTELIGÊNCIA ARTIFICIAL</h2>

                <p>Planos de treino personalizados, gerados por IA, adaptados aos teus objetivos e nível de experiência.</p>

                <div class="hero-buttons">

                    <button class="btn btn-primary">COMEÇAR AGORA</button>

                    <button class="btn btn-secondary">JÁ TENS CONTA? ENTRAR</button>

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

                    <div class="feature-icon">🤖</div>

                    <h3>IA Personal Trainer</h3>

                    <p>Planos de treino personalizados gerados por inteligência artificial.</p>

                </div>

                <div class="feature-card">

                    <div class="feature-icon">📚</div>

                    <h3>Biblioteca de Exercícios</h3>

                    <p>Mais de 20 exercícios com instruções detalhadas.</p>

                </div>

                <div class="feature-card">

                    <div class="feature-icon">📊</div>

                    <h3>Registo de Progresso</h3>

                    <p>Acompanha a tua evolução com gráficos e estatísticas.</p>

                </div>

                <div class="feature-card">

                    <div class="feature-icon">📅</div>

                    <h3>Calendário de Treinos</h3>

                    <p>Organiza os teus treinos semanais e mensais.</p>

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

                    <button class="btn btn-secondary">COMEÇAR AGORA</button>

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

                    <button class="btn btn-primary">SUBSCREVER</button>

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

                    <button class="btn btn-primary">SUBSCREVER</button>

                </div>

            </div>

        </section>



        <!-- Footer -->

        <footer class="footer">

            <p><strong>LARAGYM</strong></p>

            <p>© 2026 LaraGym. Powered by AI.</p>

            <p><a href="https://app.emergent.sh/?utm_source=emergent-badge">Made with Emergent</a></p>

        </footer>

    </body>

</html>
