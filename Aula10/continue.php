<?php
    session_start();
    echo "Olá, " . $_SESSION['usuario'] . "você está conectado.";
    session_destroy();   
?>