<?php
    require_once "exer1/model/calculadora.php";
    require_once "exer1/model/computador.php";

    $c = new Calculadora();
    $c -> setNumero1 (1);
    $c -> setNumero2(2);

    echo $c -> soma(). "<br>";
    echo $c -> dividir()."<br>";
    echo $c -> multiplicacao(). "<br>";
    echo $c -> subtrair(). "<br>";

    $comp = new Computador();
    $comp -> ligar();
    $comp ->desligar();
    echo "<br>" . $comp -> getstatus();
?>