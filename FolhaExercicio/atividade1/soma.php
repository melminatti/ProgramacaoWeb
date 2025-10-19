<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title> Soma dos 3 numeros</title>
</head>
<body>

  <h1>Soma</h1>

  <form method="post" action="">
    <label>Valor 1:</label>
    <input type="number" name="v1" required><br><br>

    <label>Valor 2:</label>
    <input type="number" name="v2" required><br><br>

    <label>Valor 3:</label>
    <input type="number" name="v3" required><br><br>

    <button type="submit">Somar</button>
  </form>

  <hr>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $val1 = $_POST['v1'];
      $val2 = $_POST['v2'];
      $val3 = $_POST['v3'];

      $soma = $val1 + $val2 + $val3;

      if ($val1 > 10) {
          echo "<p style='color:blue'>Soma: $soma</p>";
      } elseif ($val2 < $val3) {
          echo "<p style='color:green'>Soma: $soma</p>";
      } elseif ($val3 < $val1 && $val3 < $val2) {
          echo "<p style='color:red'>Soma: $soma</p>";
      } else {
          echo "<p>Soma: $soma</p>";
      }

      echo "<p>Valores: $val1, $val2 e $val3</p>";
      
  }
  ?>

</body>
</html>
