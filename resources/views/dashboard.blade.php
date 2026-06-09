<x-app-layout>
    {{-- 1. Importamos o CSS desde public/css/dashboard.css --}}
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @endpush

    {{-- 2. Encabeçado do Dashboard --}}
    <x-slot name="header">
        <h2 class="font-display text-xl text-neon leading-tight tracking-widest uppercase">
            {{ __('Área de Atleta') }}
        </h2>
    </x-slot>

    {{-- 3. Corpo do Dashboard (Estructura Neón) --}}
    <div class="py-12 gym-body">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                {{-- CARD DE STREAK / RACHA --}}
                <div class="card-neon p-6 streak-glow">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-400 text-xs font-bold uppercase tracking-widest">Racha Atual</span>
                        <span id="streak-flame" class="text-2xl opacity-50 transition-all duration-500">🔥</span>
                    </div>
                    <div class="flex items-end gap-2 mb-6">
                        <span id="streak-number" class="font-display text-7xl font-black text-neon">23</span>
                        <span class="text-gray-500 mb-3 uppercase text-sm font-bold">Dias</span>
                    </div>

                    <div class="flex justify-between gap-1 mb-6">
                        @foreach(['D','L','M','X','J','V','S'] as $index => $dia)
                            <div id="day-{{ $index }}" class="day-dot">{{ $dia }}</div>
                        @endforeach
                    </div>

                    <button id="btn-checkin" class="btn-checkin-neon w-full">
                        REGISTAR TREINO HOJE
                    </button>
                </div>

                {{-- CARD DINÂMICO DE TREINOS (TABS INTERATIVAS) --}}
                <div class="card-neon p-6 md:col-span-2">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-display text-xl text-white uppercase tracking-tighter">{{ __('Training Plan') }}</h3>
                        <span class="px-3 py-1 bg-neon/10 text-neon text-xs rounded-full border border-neon/20 animate-pulse">MODO HARDCORE</span>
                    </div>
                    
                    {{-- Barra de Botões Seletores (Abas) --}}
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 mb-6">
                        <button class="tab-btn active-neon p-3 bg-black/30 border border-neon/20 text-white font-bold text-xs uppercase tracking-wider rounded transition-all" data-treino="peito">
                            PEITO
                        </button>
                        <button class="tab-btn p-3 bg-black/10 border border-transparent text-gray-500 font-bold text-xs uppercase tracking-wider rounded transition-all" data-treino="costas">
                            COSTAS
                        </button>
                        <button class="tab-btn p-3 bg-black/10 border border-transparent text-gray-500 font-bold text-xs uppercase tracking-wider rounded transition-all" data-treino="bracos">
                            BRAÇOS
                        </button>
                        <button class="tab-btn p-3 bg-black/10 border border-transparent text-gray-500 font-bold text-xs uppercase tracking-wider rounded transition-all" data-treino="pernas">
                            PERNAS
                        </button>
                    </div>

                    {{-- Contentor dos Exercícios --}}
                    <div class="workout-display-container">
                        
                        {{-- TREINO: PEITO (Visível por defeito) --}}
                        <div id="peito-content" class="workout-card active-content space-y-3">
                            <h4 class="text-neon font-bold text-md uppercase tracking-wide mb-2">// TARGET: PEITO & OMBROS</h4>
                            <div class="p-4 bg-black/40 border-l-4 border-neon rounded flex justify-between items-center">
                                <span class="text-white font-medium">1. Supino Reto com Barra</span>
                                <span class="text-neon font-mono text-sm">4x 8-12</span>
                            </div>
                            <div class="p-4 bg-black/40 border-l-4 border-neon rounded flex justify-between items-center">
                                <span class="text-white font-medium">2. Supino Inclinado com Halteres</span>
                                <span class="text-neon font-mono text-sm">3x 10</span>
                            </div>
                            <div class="p-4 bg-black/40 border-l-4 border-neon rounded flex justify-between items-center">
                                <span class="text-white font-medium">3. Desenvolvimento Militar</span>
                                <span class="text-neon font-mono text-sm">4x 10</span>
                            </div>
                        </div>

                        {{-- TREINO: COSTAS (Escondido) --}}
                        <div id="costas-content" class="workout-card hidden space-y-3">
                            <h4 class="text-neon font-bold text-md uppercase tracking-wide mb-2">// TARGET: COSTAS & TRAPÉZIO</h4>
                            <div class="p-4 bg-black/40 border-l-4 border-neon rounded flex justify-between items-center">
                                <span class="text-white font-medium">1. Puxada Atrás (Lat Pulldown)</span>
                                <span class="text-neon font-mono text-sm">4x 8-12</span>
                            </div>
                            <div class="p-4 bg-black/40 border-l-4 border-neon rounded flex justify-between items-center">
                                <span class="text-white font-medium">2. Remada Baixa Sentada</span>
                                <span class="text-neon font-mono text-sm">3x 10</span>
                            </div>
                            <div class="p-4 bg-black/40 border-l-4 border-neon rounded flex justify-between items-center">
                                <span class="text-white font-medium">3. Puxada Unilateral com Halter</span>
                                <span class="text-neon font-mono text-sm">3x 12</span>
                            </div>
                        </div>

                        {{-- TREINO: BRAÇOS (Escondido) --}}
                        <div id="bracos-content" class="workout-card hidden space-y-3">
                            <h4 class="text-neon font-bold text-md uppercase tracking-wide mb-2">// TARGET: BICEP & TRICEP</h4>
                            <div class="p-4 bg-black/40 border-l-4 border-neon rounded flex justify-between items-center">
                                <span class="text-white font-medium">1. Bicep Direto com Barra</span>
                                <span class="text-neon font-mono text-sm">4x 10</span>
                            </div>
                            <div class="p-4 bg-black/40 border-l-4 border-neon rounded flex justify-between items-center">
                                <span class="text-white font-medium">2. Tricep à Testa (Skullcrusher)</span>
                                <span class="text-neon font-mono text-sm">4x 10</span>
                            </div>
                            <div class="p-4 bg-black/40 border-l-4 border-neon rounded flex justify-between items-center">
                                <span class="text-white font-medium">3. Bicep Martelo Alternado</span>
                                <span class="text-neon font-mono text-sm">3x 12</span>
                            </div>
                        </div>

                        {{-- TREINO: PERNAS (Escondido) --}}
                        <div id="pernas-content" class="workout-card hidden space-y-3">
                            <h4 class="text-neon font-bold text-md uppercase tracking-wide mb-2">// TARGET: QUADRÍCEPS & FEMORAIS</h4>
                            <div class="p-4 bg-black/40 border-l-4 border-neon rounded flex justify-between items-center">
                                <span class="text-white font-medium">1. Agachamento Livre (Squat)</span>
                                <span class="text-neon font-mono text-sm">4x 8-10</span>
                            </div>
                            <div class="p-4 bg-black/40 border-l-4 border-neon rounded flex justify-between items-center">
                                <span class="text-white font-medium">2. Prensa de Pernas (Leg Press 45º)</span>
                                <span class="text-neon font-mono text-sm">3x 12</span>
                            </div>
                            <div class="p-4 bg-black/40 border-l-4 border-neon rounded flex justify-between items-center">
                                <span class="text-white font-medium">3. Leg Curl Deitado (Femoral)</span>
                                <span class="text-neon font-mono text-sm">4x 12</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/dashboard.js') }}"></script>
        
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const botoes = document.querySelectorAll('.tab-btn');
                const cards = document.querySelectorAll('.workout-card');

                botoes.forEach(botao => {
                    botao.addEventListener('click', function() {
                        // 1. Resetar estilos de todos os botões para o estado inativo
                        botoes.forEach(b => {
                            b.classList.remove('active-neon', 'bg-black/30', 'border-neon/20', 'text-white');
                            b.classList.add('bg-black/10', 'border-transparent', 'text-gray-500');
                        });
                        
                        // 2. Aplicar estilo ativo (Verde Neon) no botão clicado
                        this.classList.remove('bg-black/10', 'border-transparent', 'text-gray-500');
                        this.classList.add('active-neon', 'bg-black/30', 'border-neon/20', 'text-white');

                        // 3. Ocultar todos os blocos de exercícios utilizando a classe utilitária 'hidden' do Tailwind
                        cards.forEach(card => card.classList.add('hidden'));

                        // 4. Capturar o treino alvo pelo atributo data-treino
                        const treinoSelecionado = this.getAttribute('data-treino');

                        // 5. Mostrar o bloco correspondente removendo a classe 'hidden'
                        const cardAlvo = document.getElementById(`${treinoSelecionado}-content`);
                        if (cardAlvo) {
                            cardAlvo.classList.remove('hidden');
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>