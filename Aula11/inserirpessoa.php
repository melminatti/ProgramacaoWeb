<link rel="stylesheet" href="estilo.css">

<?php
include 'funcoes.php';

$conn = conectarBanco();

$nome      = sanitizarString($_POST['Nome']      ?? '');
$sobrenome = sanitizarString($_POST['Sobrenome'] ?? '');
$email     = $_POST['Email']     ?? ''; 
$senha     = $_POST['Senha']     ?? '';
$cidade    = sanitizarString($_POST['Cidade']    ?? '');
$estado    = sanitizarString($_POST['Estado']    ?? '');


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("<div class='container'><h1>Erro!</h1><p>O e-mail fornecido ($email) é inválido.</p><br><a href='cadastro.html'>Voltar</a></div>");
}

$email = filter_var($email, FILTER_SANITIZE_EMAIL);


$aDados = [$nome, $sobrenome, $email, $senha, $cidade, $estado];


if (inserirPessoa($conn, $aDados)) {
    echo "<div class='container'><h1>Sucesso!</h1><p>Dados inseridos com sucesso!</p></div>";
} else {
    echo "<div class='container'><h1>Erro!</h1><p>Erro ao inserir os dados.</p></div>";
}

echo '<br><br><a href="cadastro.html">Voltar</a>';


pg_close($conn); 
?>