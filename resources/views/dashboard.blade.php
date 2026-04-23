<x-app-layout>
    {{-- 1. Importamos el CSS desde public/css/dashboar.css --}}
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @endpush

    {{-- 2. Encabezado del Dashboard --}}
    <x-slot name="header">
        <h2 class="font-display text-xl text-neon leading-tight tracking-widest uppercase">
            {{ __('Área de Atleta') }}
        </h2>
    </x-slot>

    {{-- 3. Cuerpo del Dashboard (Estructura Neón) --}}
    <div class="py-12 gym-body">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
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

                <div class="card-neon p-6 md:col-span-2">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-display text-xl text-white uppercase tracking-tighter">{{ __('Training Plan') }}</h3>
                        <span class="px-3 py-1 bg-neon/10 text-neon text-xs rounded-full border border-neon/20 animate-pulse">MODO HARDCORE</span>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-5 bg-black/30 rounded-xl border-l-4 border-neon shadow-lg group hover:bg-black/40 transition-all">
                            <h4 class="text-neon font-bold text-lg uppercase">Peito e Ombros</h4>
                            <p class="text-gray-400 text-sm mt-1">Status: <span class="text-white font-medium">Pronto para começar</span></p>
                        </div>
                        
                        <div class="p-5 bg-black/10 rounded-xl border-l-4 border-gray-700 opacity-50">
                            <h4 class="text-gray-400 font-bold text-lg uppercase">Pernas (Amanhã)</h4>
                            <p class="text-gray-500 text-sm mt-1">Bloqueado</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- 4. Importamos el JS desde public/js/dashboard.js --}}
    @push('scripts')
        <script src="{{ asset('js/dashboard.js') }}"></script>
    @endpush
</x-app-layout>