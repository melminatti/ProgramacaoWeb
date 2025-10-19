<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title> Divisivel</title>
</head>
<body>

  <h1>Divisivel</h1>

  <form method="post" action="">
    <label>Valor:</label>
    <input type="number" name="v1" required><br><br>

    <button type="submit">Dividir</button>
  </form>

  <hr>
   <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $val1 = $_POST['v1'];

      if ($val1 %2 == 0) {
          echo "<p>O valor é divisível por 2</p>";
      } else  {
          echo "<p> O valor não é divisível por 2</p>";
      }        
  }
  ?>
</body>
</html>
  