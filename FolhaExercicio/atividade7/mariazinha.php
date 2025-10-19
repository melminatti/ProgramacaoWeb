<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title> Jurus</title>
</head>
<body>

  <h1>Jurus pago do carro</h1>

  <p> Valor à vista do carro é de R$22.500,00 </p>
  <p> Mariazinha pagará 60 parcelas de R$489,65 </p>

 <?php
  $valorAvista = 22500;
  $parcelas = 60;
  $valorParcelas = 489.65;

  $juros = ($parcelas * $valorParcelas) - $valorAvista;
  echo "<p> Mariazinha pagará o total de R$" . number_format($juros, 2, '.', ',' ) . " juros</p>";
  ?>

</body>
</html>
