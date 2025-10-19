<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Juros Simples (Paulinho)</title>
</head>
<body>

  <h1>Juros Simples (Paulinho)</h1>

  <form method="post" action="">
    <label>Valor à vista da moto (R$):</label>
    <input type="number" name="valor" step="0.01" value="8654" required>
    <br><br>
    <button type="submit">Calcular Parcelas</button>
  </form>

  <hr>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $valor = $_POST["valor"]; 
    $juros_inicial = 1.5; 
    $parcelas_opcoes = [24, 36, 48, 60];

    echo "<h3>Opções de parcelamento (Juros Simples)</h3>";
    echo "<table border=1>";
    echo "<tr><th>Parcelas</th><th>Taxa de Juros</th><th>Valor Total (R$)</th><th>Valor da Parcela (R$)</th></tr>";

    foreach ($parcelas_opcoes as $indice => $t) {
  
      $taxa = ($juros_inicial + (0.5 * $indice)) / 100;
      
      $montante = $valor + ($valor * $taxa * $t);
      $parcela = $montante / $t;

      echo "<tr>";
      echo "<td>$t vezes</td>";
      echo "<td>" . number_format(($taxa * 100), 1, ',', '.') . "%</td>";
      echo "<td>" . number_format($montante, 2, ',', '.') . "</td>";
      echo "<td>" . number_format($parcela, 2, ',', '.') . "</td>";
      echo "</tr>";
    }

    echo "</table>";
  }
  ?>

</body>
</html>
