<?php
$disciplinas = array("Linguagem de Programação e Paradigmas ", 
"Banco de dados II", "Administração", "Engenharia de Software II", 
"programação web I");

$professor = array("Ademar", "Marco", "Marciel", "Julian", "Cleber");

for ($i  = 0; $i < 5; $i++) {
    echo "Disciplica $disciplinas[$i] - Professor $professor[$i]. </br> </br>";
}

?>