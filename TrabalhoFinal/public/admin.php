<?php
require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/respostas.php';
require_once __DIR__ . '/../src/perguntas.php';
require_once __DIR__ . '/../src/funcoes.php';

// Processar logout
if (isset($_GET['logout'])) {
    logout();
    header('Location: admin.php');
    exit;
}

// Processar login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (login($usuario, $senha)) {
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Usuário ou senha inválidos';
    }
}

$logged_in = !empty($_SESSION['admin_logged']);

// Se não estiver logado, mostra o formulário de login
if (!$logged_in):
?>
    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administração - Login</title>
        <link rel="stylesheet" href="css/admin.css">
    </head>

    <body>
        <div class="login-container">
            <div class="login-header">
                <h2>Login</h2>
            </div>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="form-group">
                    <label for="usuario" class="form-label">Usuário</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" required>
                </div>
                <div class="form-group">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100">Entrar</button>
            </form>
        </div>
    </body>

    </html>
<?php
    exit;
endif;

// A partir daqui, usuário está logado
$setor_id = isset($_GET['setor']) ? (int)$_GET['setor'] : null;
$setores = getSetores();
$scores = getScores($setor_id);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="#" class="navbar-brand">Painel Administrativo</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="?" class="active">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle">Setores</a>
                    <div class="dropdown-content">
                        <?php foreach ($setores as $setor): ?>
                            <a href="?setor=<?= $setor['id'] ?>"><?= htmlspecialchars($setor['nome']) ?></a>
                        <?php endforeach; ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="admin_perguntas.php">Gerenciar Perguntas</a>
                </li>
                <li class="nav-item">
                    <a href="admin_setores.php">Gerenciar Setores</a>
                </li>
                <li class="nav-item">
                    <a href="?logout=1">Sair</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5>Média de Avaliações <?= $setor_id ? "do Setor" : "Geral" ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="avaliacoesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5>Resumo</h5>
                    </div>
                    <div class="card-body">
                        <div class="scores-list">
                            <?php foreach ($scores as $score): ?>
                                <div class="score-item d-flex justify-content-between align-items-center">
                                    <span><?= htmlspecialchars($score['texto']) ?></span>
                                    <span class="badge badge-primary"><?= $score['media'] == null ? 0 : number_format($score['media'], 1) ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($setor_id):
            $feedbacks = getFeedbackBySetor($setor_id);
        ?>
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Feedbacks do Setor</h5>
                </div>
                <div class="card-body">
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Data/Hora</th>
                                    <th>Pergunta</th>
                                    <th>Nota</th>
                                    <th>Comentário</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($feedbacks as $feedback): ?>
                                    <tr>
                                        <td><?= date('d/m/Y H:i', strtotime($feedback['data_hora'])) ?></td>
                                        <td><?= htmlspecialchars($feedback['pergunta_id']) ?></td>
                                        <td><?= $feedback['resposta'] ?></td>
                                        <td><?= htmlspecialchars($feedback['feedback'] ?? '-') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Configuração do gráfico
        const ctx = document.getElementById('avaliacoesChart').getContext('2d');
        const data = {
            labels: <?= json_encode(array_column($scores, 'texto')) ?>,
            datasets: [{
                label: 'Média de Avaliações',
                data: <?= json_encode(array_column($scores, 'media')) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };
        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 10
                    }
                }
            }
        });
    </script>
</body>

</html>