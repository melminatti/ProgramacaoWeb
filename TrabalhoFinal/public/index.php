<?php
require_once __DIR__ . '/../src/perguntas.php';
require_once __DIR__ . '/../src/funcoes.php';

$perguntas = getQuestionsActives();
$setores = getSetores();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação de Serviço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Avalie nosso serviço</h1>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progress-bar"></div>
        </div>

        <form action="../src/submit.php" method="post" id="avaliacaoForm">
            <?php foreach ($perguntas as $index => $p): ?>
                <div class="question-container <?= $index === 0 ? 'active' : '' ?>" data-question="<?= $index ?>">
                    <p class="h5 mb-4"><?= sanitize_text($p['texto']) ?></p>
                    <div class="scale">
                        <?php for ($i = 0; $i <= 10; $i++): ?>
                            <label>
                                <input type="radio" name="respostas[<?= $p['id'] ?>]" value="<?= $i ?>" required>
                                <div class="scale-button" data-value="<?= $i ?>"><?= $i ?></div>
                            </label>
                        <?php endfor; ?>
                    </div>
                    <div class="nav-buttons">
                        <?php if ($index > 0): ?>
                            <button type="button" class="btn-nav btn-prev" onclick="previousQuestion()">Anterior</button>
                        <?php else: ?>
                            <div></div>
                        <?php endif; ?>

                        <?php if ($index < count($perguntas) - 1): ?>
                            <button type="button" class="btn-nav btn-next" onclick="nextQuestion()">Próxima</button>
                        <?php else: ?>
                            <button type="button" class="btn-nav btn-next" onclick="showFeedback()">Finalizar</button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="question-container" data-question="<?= count($perguntas) ?>">
                <p class="h5 mb-4">Em poucas palavras, descreva o que motivou a sua nota? (Opcional)</p>
                <div class="feedback-container">
                    <textarea name="feedback" class="form-control" rows="4" placeholder="Seu comentário aqui..."></textarea>
                </div>
                <div class="nav-buttons">
                    <button type="button" class="btn-nav btn-prev" onclick="previousQuestion()">Anterior</button>
                    <button type="submit" class="btn-nav btn-submit">Enviar avaliação</button>
                </div>
            </div>

            <?php if (!empty($setores)): ?>
                <div class="form-group">
                    <label for="setor" class="form-label">Setor</label>
                    <select name="setor_id" id="setor" class="form-control" required>
                        <?php foreach ($setores as $s): ?>
                            <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php else: ?>
                <!-- fallback: caso não haja setores cadastrados, mantém o id 1 -->
                <input type="hidden" name="setor_id" value="1">
            <?php endif; ?>

            <input type="hidden" name="dispositivo_id" value="1">
        </form>

        <footer class="mt-4 text-center">
            <p class="text-muted">Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>