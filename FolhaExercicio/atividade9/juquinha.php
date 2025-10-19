<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Juquinha</title>
</head>
<body>

<h1>Juquinha (Juros Compostos)</h1>

<form method="post">
    <label>Valor da moto (R$):</label>
    <input type="number" name="capital" value="8654" step="0.01" required>
    <input type="submit" value="Calcular Parcelas">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $C = $_POST["capital"]; 

    $opcoes = [
        24 => 0.02,    
        36 => 0.023,    
        48 => 0.026,    
        60 => 0.029     
    ];

    echo "<h2>Resultados (Juros Compostos)</h2>";
    echo "<table border='1' cellpadding='5'>
            <tr>
                <th>Parcelas</th>
                <th>Taxa de Juros (ao mês)</th>
                <th>Montante Final (R$)</th>
                <th>Valor da Parcela (R$)</th>
            </tr>";

    foreach ($opcoes as $parcelas => $juros) {
        $M = $C * pow((1 + $juros), $parcelas);
        $valorParcela = $M / $parcelas;

        echo "<tr>
                <td>{$parcelas}x</td>
                <td>" . number_format($juros * 100, 2, ',', '.') . "%</td>
                <td>" . number_format($M, 2, ',', '.') . "</td>
                <td>" . number_format($valorParcela, 2, ',', '.') . "</td>
              </tr>";
    }

    echo "</table>";
}
?>

</body>
</html>
