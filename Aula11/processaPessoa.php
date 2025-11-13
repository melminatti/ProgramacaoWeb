<link rel="stylesheet" href="estilo.css">

<?php
include 'funcoes.php';

$acao = $_POST['acao'] ?? '';

$nome = sanitizarString($_POST['Nome'] ?? '');
$sobrenome = sanitizarString($_POST['Sobrenome'] ?? '');
$email = $_POST['Email'] ?? ''; // Mantido para validação
$senha = $_POST['Senha'] ?? '';
$cidade = sanitizarString($_POST['Cidade'] ?? '');
$estado = sanitizarString($_POST['Estado'] ?? '');


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("<div class='container'><h1>Erro!</h1><p>O e-mail fornecido ($email) é inválido. Não foi possível salvar.</p><br><a href='cadastro.html'>Voltar</a></div>");
}


$email = filter_var($email, FILTER_SANITIZE_EMAIL);


$aDados = [$nome, $sobrenome, $email, $senha, $cidade, $estado];

if ($acao === "Salvar no Banco") {
    $conn = conectarBanco();
    
    if (inserirPessoa($conn, $aDados)) {
        echo "<div class='container'><h1>Sucesso!</h1><p>Dados salvos no banco com sucesso!</p></div>";
    } else {
        echo "<div class='container'><h1>Erro!</h1><p>Erro ao salvar no banco.</p></p></div>";
    }
    pg_close($conn);

} elseif ($acao === "Salvar em Arquivo") {
    salvarTxt($aDados);
    salvarJson($aDados);
    echo "<div class='container'><h1>Sucesso!</h1><p>Dados salvos em arquivo com sucesso!</p></div>";
}

echo '<br><br><a href="cadastro.html">Voltar</a>';
?>