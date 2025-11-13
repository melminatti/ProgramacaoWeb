<?php
// src/respostas.php
require_once __DIR__ . '/db.php';


/**
 * Salva uma avaliação no banco de dados
 * 
 * @param int $setor_id ID do setor
 * @param int $dispositivo_id ID do dispositivo
 * @param array $respostas Array associativo de respostas (pergunta_id => valor)
 * @param string|null $feedback Feedback opcional
 * 
 * @throws Exception em caso de erro na inserção
 */
function saveFeedback($setor_id, $dispositivo_id, $respostas, $feedback)
{
    global $pdo;
    // validar/respeitar tipos
    $pdo->beginTransaction();
    try {
        $feedback = $feedback ? $feedback : null;
        $stmt = $pdo->prepare("INSERT INTO avaliacoes (setor_id, pergunta_id, dispositivo_id, resposta, feedback) VALUES (:setor, :pergunta, :dispositivo, :resposta, :feedback)");
        foreach ($respostas as $pergunta_id => $valor) {
            $pergunta_id = (int)$pergunta_id;
            $valor = (int)$valor;
            if ($valor < 0 || $valor > 10) {
                throw new Exception("Resposta fora do intervalo: $valor");
            }
            $stmt->execute([
                ':setor' => $setor_id,
                ':pergunta' => $pergunta_id,
                ':dispositivo' => $dispositivo_id,
                ':resposta' => $valor,
                ':feedback' => $feedback
            ]);
        }
        $pdo->commit();
    } catch (Exception $e) {
        $pdo->rollBack();
        throw $e;
    }
}


/**
 * Retorna as médias de respostas por pergunta, opcionalmente filtrando por setor
 * 
 * @param int|null $setor_id ID do setor para filtrar, ou null para todos
 * 
 * @return array Lista de perguntas com médias e totais
 */
function getScores($setor_id = null)
{
    global $pdo;
    $sql = "SELECT p.id, p.texto, AVG(a.resposta)::numeric(10,2) AS media, COUNT(a.id) AS total
            FROM perguntas p
            LEFT JOIN avaliacoes a ON a.pergunta_id = p.id"
        . ($setor_id ? " AND a.setor_id = :setor" : "")
        . " GROUP BY p.id, p.texto ORDER BY p.id";
    $stmt = $pdo->prepare($sql);
    if ($setor_id) $stmt->execute([':setor' => $setor_id]);
    else $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Retorna todos os feedbacks associados a um setor específico
 * 
 * @param int $setor_id ID do setor
 * 
 */
function getFeedbackBySetor($setor_id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM avaliacoes WHERE setor_id = :setor ORDER BY data_hora DESC");
    $stmt->execute([':setor' => $setor_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
