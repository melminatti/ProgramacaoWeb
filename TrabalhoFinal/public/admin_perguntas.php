<?php
require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/perguntas.php';

// Verifica se está logado
require_login();

// Processa formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
    $texto = $_POST['texto'] ?? '';
    $ativa = isset($_POST['ativa']) ? true : false;

    // Executa ação conforme tipo
    switch ($action) {
        case 'add':
            if (!empty($texto)) {
                addQuestion($texto, $ativa);
            }
            break;
        case 'edit':
            if ($id && !empty($texto)) {
                updateQuestion($id, $texto, $ativa);
            }
            break;
        case 'delete':
            if ($id) {
                deleteQuestion($id);
            }
            break;
    }

    header('Location: admin_perguntas.php');
    exit;
}

// Pega pergunta para edição se ID fornecido
$edit_id = isset($_GET['edit']) ? (int)$_GET['edit'] : null;
$pergunta_edit = $edit_id ? getQuestion($edit_id) : null;

$perguntas = getAllQuestions();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Perguntas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Gerenciar Perguntas</h2>
                    <a href="admin.php" class="btn btn-secondary">Voltar ao Dashboard</a>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <form method="post" class="mb-4">
                            <input type="hidden" name="action" value="<?= $pergunta_edit ? 'edit' : 'add' ?>">
                            <?php if ($pergunta_edit): ?>
                                <input type="hidden" name="id" value="<?= $pergunta_edit['id'] ?>">
                            <?php endif; ?>
                            
                            <div class="mb-3">
                                <label for="texto" class="form-label">Texto da Pergunta</label>
                                <textarea class="form-control" id="texto" name="texto" rows="2" required><?= $pergunta_edit ? htmlspecialchars($pergunta_edit['texto']) : '' ?></textarea>
                            </div>
                            
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="ativa" name="ativa" 
                                       <?= (!$pergunta_edit || $pergunta_edit['ativa']) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="ativa">Pergunta Ativa</label>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">
                                    <?= $pergunta_edit ? 'Atualizar' : 'Adicionar' ?> Pergunta
                                </button>
                                <?php if ($pergunta_edit): ?>
                                    <a href="admin_perguntas.php" class="btn btn-secondary">Cancelar</a>
                                <?php endif; ?>
                            </div>
                        </form>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pergunta</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($perguntas as $pergunta): ?>
                                    <tr>
                                        <td><?= $pergunta['id'] ?></td>
                                        <td><?= htmlspecialchars($pergunta['texto']) ?></td>
                                        <td>
                                            <span class="badge <?= $pergunta['ativa'] ? 'bg-success' : 'bg-danger' ?>">
                                                <?= $pergunta['ativa'] ? 'Ativa' : 'Inativa' ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="?edit=<?= $pergunta['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                                            <form method="post" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir esta pergunta?')">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="id" value="<?= $pergunta['id'] ?>">
                                                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>