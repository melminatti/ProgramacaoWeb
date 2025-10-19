<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Árvore de Pastas</title>
</head>
<body>

<h1> Árvore de Pastas (Recursividade)</h1>

<?php
$pastas = array(
    "bsn" => array(
        "3a Fase" => array(
            "desenvWeb",
            "bancoDados 1",
            "engSoft 1"
        ),
        "4a Fase" => array(
            "Intro Web",
            "bancoDados 2",
            "engSoft 2"
        )
    )
);

function mostrarPastas($array, $nivel = 1) {
    foreach ($array as $chave => $valor) {
        echo str_repeat("- ", $nivel) . " " . (is_array($valor) ? $chave : $valor) . "<br>";
        if (is_array($valor)) {
            mostrarPastas($valor, $nivel + 1);
        }
    }
}

mostrarPastas($pastas);
?>

</body>
</html>
