<?php
// public/submit.php
require_once __DIR__ . '/../src/respostas.php';
require_once __DIR__ . '/../src/funcoes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Formata e valida os dados
$setor = isset($_POST['setor_id']) ? (int)$_POST['setor_id'] : null;
$dispositivo = isset($_POST['dispositivo_id']) ? (int)$_POST['dispositivo_id'] : null;
$respostas_raw = $_POST['respostas'] ?? [];
$feedback = isset($_POST['feedback']) ? sanitize_text($_POST['feedback']) : null;

// valida mínimo de dados
if (!$setor || !$dispositivo || empty($respostas_raw)) {
    die('Dados insuficientes.');
}

// filtra respostas e converte para inteiros (evitar injeção)
$respostas = [];
foreach ($respostas_raw as $pid => $val) {
    $pid_i = (int)$pid;
    $val_i = (int)$val;
    $respostas[$pid_i] = $val_i;
}

try {
    saveFeedback($setor, $dispositivo, $respostas, $feedback);
    header('Location: ../public/obrigado.php');
    exit;
} catch (Exception $e) {
    // log em produção e mostrar mensagem genérica
    die('Erro ao salvar avaliação: ' . $e->getMessage());
}
