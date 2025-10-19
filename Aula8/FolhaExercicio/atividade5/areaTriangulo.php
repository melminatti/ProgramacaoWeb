<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title> Área do Triangulo</title>
</head>
<body>

  <h1>Área do Triangulo</h1>

  <form method="post" action="">
    <label>Base:</label>
    <input type="number" name="v1" required><br><br>

      <label>Altura:</label>
    <input type="number" name="v2" required><br><br>

    <button type="submit">calcular</button>
  </form>

  <hr>
   <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $base = $_POST['v1'];
      $altura = $_POST['v2'];
      $area = $base * $altura / 2;

      echo "<p> A área do triângulo de base $base e altura $altura é $area metros quadrados. <p>";        
  }
  ?>
</body>
</html>
  