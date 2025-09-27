<?php

    $salario01= 1000;
    $salario02 = 2000;

    $salario02 = $salario01;

    $salario02++;

    $salario01 *= 1.1;

    echo "salario 1: $salario01, salario 2: $salario02"; 

    echo"<br>";
    echo"<br>";
    
    if($salario01 > $salario02) {
        echo "O valor da variável 1 é maior que o valor da variável 2";
    }
    elseif ($salario01 < $salario02){
        echo "O valor da variável 1 é menor que o valor da variável 2";
    }
    else {
        echo "Os valores são iguais";
    }

    echo"<br>";
    echo"<br>";

    $status = array("Ótimo", "Muito Bom", "Bom");
    foreach ($status as $valor) {
    echo "$valor <br>";
}

    for ($x = 0; $x < 100; ++$x){
        $salario01++;
        if ($x == 49) {
            break;
        }        
    }
 if ($salario01 < $salario02){
    echo "Valor de salario1: $salario01";
 }
?>