<?php

namespace App\Http\Controllers;

use App\Models\dieta;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DietasController extends Controller
{
       public function index(Request $request)
    {  
        ini_set('memory_limit', '256M');

        $user = $request->user();
        
        // Carrega o perfil com o relacionamento 'dieta'
        $profile = \App\Models\Profile::with('dieta')->where('user_id', $user->id)->first();
        $dietaObjeto = ($profile && $profile->dieta) ? $profile->dieta : null;

        if ($dietaObjeto) {
            // Agora o método vai funcionar porque vai ler o atributo ->json!
            $refeicoesLimpas = $this->formatarDieta($dietaObjeto);
            
            // Vamos extrair o título diretamente do JSON também
            $dadosJson = json_decode($dietaObjeto->json, true);
            $tituloPlano = $dadosJson['titulo'] ?? 'O Meu Plano Alimentar';
            
            $possuiDietaAtiva = true;
            $todasAsDietas = collect(); 
        } else {
            $refeicoesLimpas = [];
            $tituloPlano = 'Planos Disponíveis';
            $possuiDietaAtiva = false;
            $todasAsDietas = \App\Models\dieta::all(); 
        }

        return view('dietas.index', [
            'refeicoes'        => $refeicoesLimpas,
            'tituloPlano'      => $tituloPlano,
            'possuiDietaAtiva' => $possuiDietaAtiva,
            'todasDietas'      => $todasAsDietas,
            'user'             => $user,
            'profile'          => $profile
        ]);
    }
    /**
     * Função auxiliar privada que limpa os campos vazios do JSON da BD
     */
    private function formatarDieta($dietaObjeto)
    {
        // CORREÇÃO 1: Mudar de 'conteudo' para 'json' (como está na tua tabela do MySQL)
        if (!$dietaObjeto || empty($dietaObjeto->json)) {
            return [];
        }

        // CORREÇÃO 2: Aceder à propriedade ->json para descodificar
        $dadosDecodificados = is_string($dietaObjeto->json) 
            ? json_decode($dietaObjeto->json, true) 
            : (array) $dietaObjeto->json;

        if (json_last_error() !== JSON_ERROR_NONE || !isset($dadosDecodificados['refeicoes'])) {
            return [];
        }

        $refeicoesFormatadas = [];
        $categoriasCampos = [
            'proteinas'    => 'Proteínas',
            'carboidratos' => 'Carboidratos',
            'vegetais'     => 'Vegetais',
            'frutas'       => 'Frutas',
            'gorduras'     => 'Gorduras',
            'bebidas'      => 'Bebidas'
        ];

        foreach ($dadosDecodificados['refeicoes'] as $chave => $refeicao) {
            $itensRefeicao = [];

            foreach ($categoriasCampos as $campo => $label) {
                // Garante que a chave existe, é um array e não está vazia
                if (isset($refeicao[$campo]) && is_array($refeicao[$campo]) && !empty($refeicao[$campo])) {
                    $itensRefeicao[$label] = implode(', ', $refeicao[$campo]);
                }
            }

            $nomeRefeicao = $refeicao['nome'] ?? ucfirst($chave);
            $refeicoesFormatadas[$nomeRefeicao] = $itensRefeicao;
        }

        return $refeicoesFormatadas;
    }

        public function show($id)
        {
            $dieta = dieta::findOrFail($id);
            return view('dietas.show', compact('dieta'));
        }

        public function activate($id)
        {            
            $dieta = dieta::findOrFail($id);
            $user = auth()->user();
            $profile = $user->profile;

            if ($profile) {
                $profile->dieta_id = $dieta->id;
                $profile->save();
            }

            return redirect()->route('dietas')->with('success', 'Dieta ativada com sucesso!');
        }

        public function deactivate(Request $request)
        {
            $user = $request->user();
            $profile = $user->profile;

            if ($profile) {
                $profile->dieta_id = null;
                $profile->save();
            }

            return redirect()->route('dietas')->with('success', 'Dieta desativada com sucesso!');
        }
}

