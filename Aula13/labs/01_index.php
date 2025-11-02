<?php
require_once '01_pessoa.php'; 

$sNome = "Melissa";
$sSobreNome = "Minatti";

$sNomeCompleto = getNomeCompleto($sNome, $sSobreNome);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>LAB 1</title>
    <link rel="stylesheet" href="estilo.css"> 
    <style>
        .container { 
            width: 50%;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: left; 
        }
        .centralizar-h1 {
            text-align: center;
        }
        h1 { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="centralizar-h1">
            <h1>LAB 1</h1> 
        </div>
        
        <p>Dados de entrada: <?= $sNome ?> <?= $sSobreNome ?></p>

        <div style="font-size: 1.5em; font-weight: bold; color: #0056b3; margin-top: 15px; padding: 10px;">
            <?= $sNomeCompleto ?>
        </div>

        <hr>
        <p><a href="laboo.php">Ir para o LAB 3 (Orientação a Objetos)</a></p>
    </div>
</body>
</html>