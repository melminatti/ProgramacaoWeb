<?php
require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/funcoes.php';

// Verifica se está logado
require_login();

// Processa formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
    $nome = $_POST['nome'] ?? '';

    // Executa ação conforme tipo (delete não requer campo nome)
    switch ($action) {
        case 'add':
            if (!empty($nome)) {
                addSetor($nome);
            }
            break;
        case 'edit':
            if ($id && !empty($nome)) {
                updateSetor($id, $nome);
            }
            break;
        case 'delete':
            if ($id) {
                deleteSetor($id);
            }
            break;
    }

    header('Location: admin_setores.php');
    exit;
}

// Pega setor para edição se ID fornecido
$edit_id = isset($_GET['edit']) ? (int)$_GET['edit'] : null;
$setor_edit = $edit_id ? getSetor($edit_id) : null;

$setores = getSetores();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Setores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Gerenciar Setores</h2>
                    <a href="admin.php" class="btn btn-secondary">Voltar ao Dashboard</a>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <form method="post" class="mb-4">
                            <input type="hidden" name="action" value="<?= $setor_edit ? 'edit' : 'add' ?>">
                            <?php if ($setor_edit): ?>
                                <input type="hidden" name="id" value="<?= $setor_edit['id'] ?>">
                            <?php endif; ?>
                            
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="nome" class="form-label">Nome do Setor</label>
                                </div>
                                <div class="col-auto">
                                    <input type="text" class="form-control" id="nome" name="nome" 
                                           value="<?= $setor_edit ? htmlspecialchars($setor_edit['nome']) : '' ?>" required>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">
                                        <?= $setor_edit ? 'Atualizar' : 'Adicionar' ?> Setor
                                    </button>
                                    <?php if ($setor_edit): ?>
                                        <a href="admin_setores.php" class="btn btn-secondary">Cancelar</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($setores as $setor): ?>
                                    <tr>
                                        <td><?= $setor['id'] ?></td>
                                        <td><?= htmlspecialchars($setor['nome']) ?></td>
                                        <td>
                                            <a href="?edit=<?= $setor['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                                            <form method="post" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este setor?')">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="id" value="<?= $setor['id'] ?>">
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