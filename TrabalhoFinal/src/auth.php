<?php

// Captura os dados de autenticação do arquivo de configuração
require_once __DIR__ . '/db.php';
session_start();

function login($usuario, $senha)
{
    global $pdo;
    // busca usuário no banco
    $stmt = $pdo->prepare("SELECT id, usuario, senha FROM usuarios WHERE usuario = :usuario");
    $stmt->execute([':usuario' => $usuario]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        return false;
    }


    $check = $pdo->prepare("SELECT (crypt(:senha, senha) = senha) AS ok FROM usuarios WHERE id = :id");
    $check->execute([':senha' => $senha, ':id' => $row['id']]);


    $res = $check->fetch(PDO::FETCH_ASSOC);
    if ($res && $res['ok']) {
        $_SESSION['admin_logged'] = true;
        $_SESSION['admin_user'] = $row['usuario'];
        return true;
    } else {
        return false;
    }
}

function require_login()
{
    if (empty($_SESSION['admin_logged'])) {
        header('Location: /public/admin.php'); // redireciona pra página de login
        exit;
    }
}

function logout()
{
    $_SESSION = [];
    session_destroy();
}
