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

/**
 * Cadastra um novo Setor no banco de dados
 * 
 * @param string $nome Nome do novo setor
 * 
 */
function addSetor($nome)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO setores (nome) VALUES (:nome)");
    return $stmt->execute([':nome' => $nome]);
}

/**
 * Atualiza um setor no banco de dados
 * 
 * @param int $id ID do setor a ser atualizado
 * @param string $nome Novo nome do setor
 * 
 */
function updateSetor($id, $nome)
{
    global $pdo;
    $stmt = $pdo->prepare("UPDATE setores SET nome = :nome WHERE id = :id");
    return $stmt->execute([':nome' => $nome, ':id' => $id]);
}

/**
 * Deleta um setor do banco de dados
 * 
 * @param int $id ID do setor a ser deletado
 * 
 */
function deleteSetor($id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM setores WHERE id = :id");
    return $stmt->execute([':id' => $id]);
}

/**
 * Busca um setor pelo ID
 * 
 * @param int $id ID do setor a ser buscado
 * 
 */
function getSetor($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM setores WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
