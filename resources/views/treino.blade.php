 <?php
// Ativar sessões caso queiras proteger a página mais tarde
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configuração do array de treinos associados aos dias da semana
// 1 = Segunda, 2 = Terça, 3 = Quarta, 4 = Quinta, 5 = Sexta, 6 = Sábado, 7 = Domingo
$rotina_treinos = [
    1 => [
        'grupo' => 'Peito & Tricep',
        'exercicios' => [
            ['nome' => 'Supino Reto com Barra', 'series' => '4x', 'reps' => '8-12'],
            ['nome' => 'Supino Inclinado com Halteres', 'series' => '3x', 'reps' => '10'],
            ['nome' => 'Aberturas no Pulley (Crossover)', 'series' => '3x', 'reps' => '12'],
            ['nome' => 'Tricep à Testa (Skullcrusher)', 'series' => '4x', 'reps' => '10'],
            ['nome' => 'Tricep na Corda (Pulldown)', 'series' => '3x', 'reps' => '12']
        ]
    ],
    2 => [
        'grupo' => 'Costas & Bicep',
        'exercicios' => [
            ['nome' => 'Puxada Atrás (Lat Pulldown)', 'series' => '4x', 'reps' => '8-12'],
            ['nome' => 'Remada Baixa Sentada', 'series' => '3x', 'reps' => '10'],
            ['nome' => 'Puxada Unilateral com Halter', 'series' => '3x', 'reps' => '12'],
            ['nome' => 'Bicep Direto com Barra', 'series' => '4x', 'reps' => '10'],
            ['nome' => 'Bicep Concentrado no Banco Scott', 'series' => '3x', 'reps' => '12']
        ]
    ],
    3 => [
        'grupo' => 'Pernas Completo',
        'exercicios' => [
            ['nome' => 'Agachamento Livre (Squat)', 'series' => '4x', 'reps' => '8-10'],
            ['nome' => 'Prensa de Pernas (Leg Press 45º)', 'series' => '3x', 'reps' => '10-12'],
            ['nome' => 'Extensões de Pernas (Leg Extension)', 'series' => '3x', 'reps' => '15'],
            ['nome' => 'Leg Curl (Femoral deitado)', 'series' => '4x', 'reps' => '12'],
            ['nome' => 'Elevação de Gémeos em Pé', 'series' => '4x', 'reps' => '20']
        ]
    ],
    4 => [
        'grupo' => 'Ombros & Abdominais',
        'exercicios' => [
            ['nome' => 'Desenvolvimento Militar com Halteres', 'series' => '4x', 'reps' => '8-12'],
            ['nome' => 'Elevações Laterais', 'series' => '4x', 'reps' => '12-15'],
            ['nome' => 'Voos Posteriores (Deltoide Posterior)', 'series' => '3x', 'reps' => '12'],
            ['nome' => 'Abdominais Crunch na Polia', 'series' => '4x', 'reps' => '15'],
            ['nome' => 'Elevação de Pernas em Suspensão', 'series' => '3x', 'reps' => 'Máximo']
        ]
    ],
    5 => [
        'grupo' => 'Braços (Bicep & Tricep Super-Série)',
        'exercicios' => [
            ['nome' => 'Supino Fechado (Mãos Juntas)', 'series' => '4x', 'reps' => '10'],
            ['nome' => 'Bicep Alternado com Halteres', 'series' => '4x', 'reps' => '10'],
            ['nome' => 'Tricep Paralelas (Dips)', 'series' => '3x', 'reps' => '12'],
            ['nome' => 'Bicep Martelo (Hammer Curl)', 'series' => '3x', 'reps' => '12']
        ]
    ],
    6 => [
        'grupo' => 'Cardio & Flexibilidade',
        'exercicios' => [
            ['nome' => 'Corrida em Alta Intensidade (HIIT)', 'series' => '1x', 'reps' => '20 min'],
            ['nome' => 'Mobilidade de Anca e Ombros', 'series' => '1x', 'reps' => '15 min'],
            ['nome' => 'Prancha Abdominal Estática', 'series' => '3x', 'reps' => '60 seg']
        ]
    ],
    7 => [
        'grupo' => 'Descanso Ativo / Repouso',
        'exercicios' => [
            ['nome' => 'Recuperação Muscular Total', 'series' => '0x', 'reps' => '0 min']
        ]
    ]
];

// Captura o dia selecionado via URL ou define o dia atual da semana (1 a 7)
// date('N') dá o dia atual: 1 para Segunda, 7 para Domingo
$dia_selecionado = isset($_GET['dia']) ? (int)$_GET['dia'] : (int)date('N');

// Garantir que o dia está no intervalo correto de segurança
if ($dia_selecionado < 1 || $dia_selecionado > 7) {
    $dia_selecionado = (int)date('N');
}

$treino_do_dia = $rotina_treinos[$dia_selecionado];
$nomes_dias = [1 => 'SEG', 2 => 'TER', 3 => 'QUA', 4 => 'QUI', 5 => 'SEX', 6 => 'SÁB', 7 => 'DOM'];
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Protocolo de Treino Diário</title>
    <style>
        :root {
            --neon-green: #00ff41;
            --dark-green: #003b11;
            --dark-bg: #000000;
            --card-bg: #050505;
        }
        body {
            background-color: var(--dark-bg);
            color: #ffffff;
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 2rem;
            display: flex;
            justify-content: center;
        }
        .container {
            width: 100%;
            max-width: 650px;
        }
        /* Título Estilo Terminal */
        h1 {
            color: var(--neon-green);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 1.6rem;
            text-shadow: 0 0 10px rgba(0, 255, 65, 0.4);
            margin-bottom: 1.5rem;
            border-bottom: 1px solid var(--dark-green);
            padding-bottom: 0.5rem;
        }
        /* Barra de Seleção de Dias (.day-dot adaptado) */
        .days-nav {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            gap: 8px;
        }
        .day-link {
            flex: 1;
            text-align: center;
            padding: 10px 0;
            background: #0a0a0a;
            color: #555;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.85rem;
            border: 1px solid #111;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        .day-link:hover {
            border-color: var(--dark-green);
            color: #aaa;
        }
        .day-link.active-neon {
            background: rgba(0, 255, 65, 0.05);
            border: 1px solid var(--neon-green);
            color: var(--neon-green);
            box-shadow: 0 0 15px rgba(0, 255, 65, 0.3);
            transform: scale(1.05);
        }
        /* Card de Treino */
        .workout-card {
            background: var(--card-bg);
            border: 1px solid var(--dark-green);
            border-radius: 4px;
            padding: 1.5rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
        }
        .workout-header {
            font-size: 1.25rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .workout-header span {
            color: var(--neon-green);
            font-size: 0.9rem;
            background: rgba(0, 255, 65, 0.1);
            padding: 4px 8px;
            border: 1px solid var(--neon-green);
        }
        /* Lista de Exercícios */
        .exercise-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .exercise-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.85rem 0;
            border-bottom: 1px solid rgba(0, 59, 17, 0.3);
        }
        .exercise-item:last-child {
            border-bottom: none;
        }
        .exercise-name {
            font-weight: 500;
            color: #e0e0e0;
        }
        .exercise-name::before {
            content: "> ";
            color: var(--neon-green);
            font-weight: bold;
        }
        .exercise-details {
            font-family: monospace;
            color: var(--neon-green);
            background: rgba(0, 0, 0, 0.5);
            padding: 4px 8px;
            border-radius: 2px;
            border: 1px solid rgba(0, 255, 65, 0.1);
        }
        .rest-day {
            text-align: center;
            color: #666;
            padding: 2rem 0;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>[SISTEMA_TREINO] // PROTOCOLO_DIÁRIO</h1>

    <div class="days-nav">
        <?php foreach ($nomes_dias as $num => $nome): ?>
            <a href="?dia=<?= $num; ?>" class="day-link <?= ($num === $dia_selecionado) ? 'active-neon' : ''; ?>">
                <?= $nome; ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="workout-card">
        <div class="workout-header">
            <div>TARGET: <?= htmlspecialchars($treino_do_dia['grupo']); ?></div>
            <span><?= $nomes_dias[$dia_selecionado]; ?>-STATUS</span>
        </div>

        <ul class="exercise-list">
            <?php if ($dia_selecionado == 7): // Caso seja Domingo (Descanso) ?>
                <div class="rest-day">Nenhum treino agendado. Sistema em modo de recuperação celular.</div>
            <?php else: ?>
                <?php foreach ($treino_do_dia['exercicios'] as $ex): ?>
                    <li class="exercise-item">
                        <span class="exercise-name"><?= htmlspecialchars($ex['nome']); ?></span>
                        <span class="exercise-details"><?= $ex['series']; ?> &times; <?= $ex['reps']; ?></span>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>

</body>
</html>