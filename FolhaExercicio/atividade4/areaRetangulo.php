<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title> Área do retangulo</title>
</head>
<body>

  <h1>Área do retangulo</h1>

  <form method="post" action="">
    <label>Valor A:</label>
    <input type="number" name="v1" required><br><br>

      <label>Valor B:</label>
    <input type="number" name="v2" required><br><br>

    <button type="submit">calcular</button>
  </form>

  <hr>
   <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $valA = $_POST['v1'];
      $valB = $_POST['v2'];
      $area = $valA * $valB;

      if ($area > 10 ) {
        echo "<h1> A área do retângulo de lados $valA e $valB metros é $area metros quadrados. </h1>";
      }
      
      else {
        echo "<h3> A área do retângulo de lados $valA e $valB metros é $area metros quadrados. </h3>";
      }

     
  }
  ?>
</body>
</html>
  