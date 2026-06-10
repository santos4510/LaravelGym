<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dietasController extends Controller
{
    /**
     * Exibe a dieta ativa vinda diretamente da Base de Dados.
     */
    public function index(Request $request)
    {  // 1. Capturar o tipo selecionado na URL (ex: /dietas?tipo=gigante)
        // Se o utilizador não escolher nenhum, o padrão será 'definir'
        $tipoSelecionado = $request->query('tipo', 'definir');

        // 2. Fazer a consulta na tua tabela de dietas baseada no tipo escolhido
        // Substitui 'dietas' pelo nome exato da tua tabela se for diferente
        $dietaDados = DB::table('dietas')
            ->where('tipo', $tipoSelecionado)
            ->first();

        // 3. Validação de segurança: se não encontrar o tipo na BD, carrega a dieta padrão
        if (!$dietaDados) {
            $tipoSelecionado = 'definir';
            $dietaDados = DB::table('dietas')
                ->where('tipo', $tipoSelecionado)
                ->first();
        }

        // 4. Converter o campo JSON da base de dados para um Array Associativo do PHP
        // Assumindo que a tua coluna na BD onde guardaste o texto do JSON se chama 'conteudo'
        $dietaAtiva = null;
        if ($dietaDados && isset($dietaDados->conteudo)) {
            $dietaAtiva = json_decode($dietaDados->conteudo, true);
        }

        // 5. Enviar os dados para a tua View Blade
        return view('dietas', [
            'dietaAtiva'      => $dietaAtiva,
            'tipoSelecionado' => $tipoSelecionado,
            'tituloPlano'     => $dietaDados->titulo ?? 'Plano Alimentar' // Pega o título da coluna da BD
        ]);
    }
}
