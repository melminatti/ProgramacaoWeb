<?php
  
  session_start();
  if (!isset($_SESSION['usuario'])) {
        $_SESSION['usuario'] = 'Visitante';

        echo"Olá, " . $_SESSION ['usuario'] . "! Você não está logado. <br> ";
        echo '<a href="continue.php"> clique aqui para login </a>';
  }
?>