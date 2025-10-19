<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title> Feira - Joãozinho</title>
</head>
<body>

  <h1>Feira</h1>

  <form method="post" action="">
    <label>Maça:</label>
    <input type="number" name="v1" step="0.1" required><br><br>

    <label>Melancia:</label>
    <input type="number" name="v2" step="0.1" required><br><br>

    <label>Laranja:</label>
    <input type="number" name="v3" step="0.1" required><br><br>

     <label>Repolho:</label>
    <input type="number" name="v4" step="0.1" required><br><br>

    <label>Cenoura:</label>
    <input type="number" name="v5" step="0.1" required><br><br>

    <label>Batatinha:</label>
    <input type="number" name="v6" step="0.1" required><br><br>

    <button type="submit">Calcular</button>
  </form>

  <hr>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $precos = [
        "maca" => 5.00,
        "melancia" => 3.50,
        "laranja" => 4.20,
        "repolho" => 2.80,
        "cenoura" => 3.00,
        "batatinha" => 2.50
      ];

      $quantidades = [
        "maca" => $_POST["v1"],
        "melancia" => $_POST["v2"],
        "laranja" => $_POST["v3"],
        "repolho" => $_POST["v4"],
        "cenoura" => $_POST["v5"],
        "batatinha" => $_POST["v6"]
      ];

      $total = 0;
      echo "<h3>Resumo da compra:</h3>";
      foreach ($precos as $produto => $preco) {
        $subtotal = $preco * $quantidades[$produto];
        $total += $subtotal;
        echo ucfirst($produto) . ": R$ " . number_format($subtotal, 2, ',', '.') . "<br>";
      }

      echo "<hr>";
      echo "<p><strong>Total gasto:</strong> R$ " . number_format($total, 2, ',', '.') . "</p>";
      
      if ($total > 50) {
          echo "<p style='color:red'>Faltou R$ " .  number_format($total - 50, 2, ',', '.') . "</p>";
      } elseif ($total < 50) {
          echo "<p style='color:blue'>Sobrou R$ " .  number_format(50 - $total , 2, ',', '.') . "</p>";
      } else {
          echo "<p style='color:green'> Joãozinho gastou todo o seu dinheito</p>" ;
      }
  }
  ?>

</body>
</html>
