<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title> Área do quadrado</title>
</head>
<body>

  <h1>Área do quadrado</h1>

  <form method="post" action="">
    <label>Valor:</label>
    <input type="number" name="v1" required><br><br>

    <button type="submit">calcular</button>
  </form>

  <hr>
   <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $val1 = $_POST['v1'];
      $area = $val1 * $val1;
      echo "<p> A área do quadrado de lado $val1 metros é $area metros quadrados </p>";        
  }
  ?>
</body>
</html>
  