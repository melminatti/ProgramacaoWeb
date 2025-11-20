<?php
// src/funcoes.php
require_once __DIR__ . '/db.php';

// Funções utilitárias (sanitização, validação)
function sanitize_text($text)
{
    return trim(htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
}

function sanitize_int($v, $default = 0)
{
    if (!isset($v)) return $default;
    return filter_var($v, FILTER_VALIDATE_INT, ['options' => ['default' => $default]]);
}

// Funções de Gerenciamento de Setores
function getSetores()
{
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM setores ORDER BY nome");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addSetor($nome)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO setores (nome) VALUES (:nome)");
    return $stmt->execute([':nome' => $nome]);
}

function updateSetor($id, $nome)
{
    global $pdo;
    $stmt = $pdo->prepare("UPDATE setores SET nome = :nome WHERE id = :id");
    return $stmt->execute([':nome' => $nome, ':id' => $id]);
}

function deleteSetor($id)
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("DELETE FROM setores WHERE id = :id");
        $stmt->execute([':id' => $id]);

        return true;
    } catch (PDOException $e) {

        if ($e->getCode() === "23503") {
            return false;
        }
        return false;
    }
}

function getSetor($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM setores WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
