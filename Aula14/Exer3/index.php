<?php
    $session = new Session();
    if($session->start()) {
        echo "Sessão iniciada com sucesso.";

        $usuario = new Usuario();
        $usuario -> setNome("João Silva");
        $usuario -> setLogin("joãosilva");
        $usuario->setPass("senha456");
        $session->setUsuarioSessao($usuario);

    }
?>