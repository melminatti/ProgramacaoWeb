<?php
// src/perguntas.php
require_once __DIR__ . '/db.php';


/**
 *  Captura todas as perguntas ativas do banco de Dados
 * 
 */
function getQuestionsActives()
{
    global $pdo;
    $stmt = $pdo->query("SELECT id, texto FROM perguntas WHERE ativa = TRUE ORDER BY id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Captura todas as perguntas do banco de dados
 * 
 */
function getAllQuestions()
{
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM perguntas ORDER BY id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Adiciona uma nova pergunta no banco de dados
 * 
 * @param string $texto
 * @param bool $ativa
 */
function addQuestion($texto, $ativa = true)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO perguntas (texto, ativa) VALUES (:texto, :ativa)");
    $stmt->execute([':texto' => $texto, ':ativa' => $ativa]);
}

/**
 * Busca uma pergunta específica pelo ID
 * 
 * @param int $id
 * @return array|false
 */
function getQuestion($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM perguntas WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


/**
 * Atualiza a pergunta no banco de dados
 * 
 * @param int $id
 * @param string $texto
 * @param bool $ativa
 */

function updateQuestion($id, $texto, $ativa)
{
    global $pdo;
    $stmt = $pdo->prepare("UPDATE perguntas SET texto = :texto, ativa = :ativa WHERE id = :id");
    $stmt->execute([':texto' => $texto, ':ativa' => $ativa, ':id' => $id]);
}

/**
 * Deleta a pergunta do banco de dados
 * 
 * @param int $id
 */
function deleteQuestion($id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM perguntas WHERE id = :id");
    $stmt->execute([':id' => $id]);
}
