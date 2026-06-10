<x-app-layout>
    {{-- 1. Importamos o CSS desde public/css/dashboard.css --}}
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @endpush

    {{-- 2. Encabeçado do Dashboard com estilo Néon --}}
    <x-slot name="header">
        <h2 class="font-display text-xl text-neon leading-tight tracking-widest uppercase">
            {{ __('Dietas') }}
        </h2>
    </x-slot>

    {{-- 3. Corpo com a classe gym-body para manter o fundo escuro integrado --}}
    <div class="py-12 gym-body">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Container Principal card-neon (Mesma largura do treino max-w-4xl) --}}
            <div class="card-neon p-6 sm:p-8 shadow sm:rounded-lg max-w-4xl mx-auto">
                <div>
                    
                    {{-- Cabeçalho da Secção --}}
                    

                    @if($possuiDietaAtiva)
                        {{-- ==================================================== --}}
                        {{-- 1. CASO O UTILIZADOR TENHA UM PLANO ATIVO            --}}
                        {{-- ==================================================== --}}
                        <div class="mb-6 border-b pb-4 border-neon/20">
                            <h2 class="font-display text-xl text-white uppercase tracking-widest">
                                Plano Alimentar Ativo: {{ $tituloPlano ?? 'Sem título definido' }}
                            </h2>
                        </div>

                        <div class="space-y-4">
                            @if(!empty($refeicoes))
                                @foreach($refeicoes as $nomeDaRefeicao => $categorias)
                                    <div class="p-4 bg-black/40 border-l-4 border-neon rounded shadow-sm">
                                        <h4 class="text-white font-display text-md uppercase tracking-wide mb-2">
                                            {{ $nomeDaRefeicao }}
                                        </h4>
                                        
                                        <div class="text-sm text-gray-400 space-y-1.5 font-mono">
                                            @foreach($categorias as $label => $alimentos)
                                                <div>
                                                    <span class="text-neon font-bold uppercase text-xs tracking-wider">{{ $label }}:</span> 
                                                    <span class="text-gray-200">
                                                        {{ is_array($alimentos) ? implode(', ', $alimentos) : $alimentos }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                                {{-- Botão de Desativação Protegido com Formulário POST --}}
                                <div class="pt-4 w-full max-w-xs mx-auto">
                                    <form action="{{ route('dietas.deactivate') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="block w-full py-2 bg-black/20 border border-red-500/40 hover:bg-red-500 hover:text-black text-red-500 text-xs font-display font-bold uppercase tracking-widest rounded transition-all duration-300">
                                            Solicitar desativação
                                        </button>
                                    </form>
                                </div>
                            @else
                                <p class="text-neon font-mono text-xs animate-pulse">// Erro ao processar a estrutura dos alimentos deste plano.</p>
                            @endif
                        </div>

                    @else
                        {{-- ==================================================== --}}
                        {{-- 2. CASO NÃO TENHA PLANO ATIVO (LISTAGEM DE SUB-CARDS) --}}
                        {{-- ==================================================== --}}
                        <div class="mb-6 border-b pb-4 border-neon/20">
                            <h2 class="font-display text-xl text-white uppercase tracking-widest">
                                // PLANOS DISPONÍVEIS
                            </h2>
                        </div>
                        <div class="mb-8 p-4 bg-black/10 border border-neon/20 text-neon rounded text-xs font-mono tracking-wide">
                            [AVISO]: Ainda não tens nenhum plano alimentar ativo associado ao teu perfil. Consulta as opções disponíveis abaixo:
                        </div>

                        <div class="space-y-12 mt-4">
                            @if(!empty($todasDietas) && count($todasDietas) > 0)
                                @foreach($todasDietas as $dieta)
                                    @php
                                        $dadosJson = json_decode($dieta->json, true);
                                        $tituloDoJson = $dadosJson['titulo'] ?? 'Plano Alimentar #' . $dieta->id;
                                        $refeicoesDoJson = $dadosJson['refeicoes'] ?? [];
                                    @endphp

                                    {{-- Bloco do Plano Geral --}}
                                    <div class="flex flex-col items-center text-center py-6 border-b border-neutral-900 last:border-none space-y-4">
                                        
                                        {{-- Título Principal do Macrociclo da Dieta --}}
                                        <h3 class="text-md font-display font-bold text-white uppercase tracking-wider mb-2">
                                            {{ $tituloDoJson }}
                                        </h3>
                                        
                                        {{-- Grid de Sub-Cards das Refeições --}}
                                        <div class="w-full max-w-2xl space-y-2 text-left">
                                            @foreach($refeicoesDoJson as $chaveRefeicao => $refeicaoData)
                                                @php
                                                    $itensDaRefeicao = [];
                                                    foreach(['proteinas', 'carboidratos', 'vegetais', 'gorduras', 'frutas', 'bebidas'] as $cat) {
                                                        if(!empty($refeicaoData[$cat]) && is_array($refeicaoData[$cat])) {
                                                            $itensDaRefeicao = array_merge($itensDaRefeicao, $refeicaoData[$cat]);
                                                        }
                                                    }
                                                @endphp

                                                {{-- Sub-Card Estilo Linha de Exercício --}}
                                                <div class="p-3 bg-black/40 border-l-4 border-neon rounded flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1 sm:gap-4">
                                                    <span class="text-white font-display text-sm uppercase tracking-wide min-w-[160px] text-neon/90">
                                                        {{ $refeicaoData['nome'] ?? ucfirst($chaveRefeicao) }}
                                                    </span>
                                                    <span class="text-gray-400 font-mono text-xs sm:text-right line-clamp-2">
                                                        {{ !empty($itensDaRefeicao) ? implode(', ', $itensDaRefeicao) : 'Nenhum alimento registado' }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>

                                        {{-- RESOLUÇÃO DO ERRO: Formulário POST com o token @csrf obrigatório do Laravel --}}
                                        <div class="pt-4 w-full max-w-xs">
                                            <form action="{{ route('dietas.activate', ['id' => $dieta->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="block w-full py-2 bg-black/20 border border-neon/40 hover:bg-neon hover:text-black text-neon text-xs font-display font-bold uppercase tracking-widest rounded transition-all duration-300">
                                                    Solicitar ativação
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-gray-500 text-xs font-mono text-center">// Não existem planos disponíveis no sistema de momento.</p>
                            @endif
                        </div>
                    @endif

                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>