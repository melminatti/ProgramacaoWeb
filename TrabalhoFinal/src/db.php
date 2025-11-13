<?php
// Captura os detalhes da conexão com o banco de dados a partir do arquivo de configuração
require_once __DIR__ . '/../config.php';


try {
    // OBS: o DSN precisa do "port" também (por padrão 5432)
    $dsn = "pgsql:host=" . DB_HOST . ";port=5432;dbname=" . DB_NAME;

    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    // Opcional: teste rápido
    $result = $pdo->query("SELECT version()")->fetch();
} catch (PDOException $e) {
    die("<h3 style='color: red;'>❌ Erro de conexão com o banco:</h3> " . $e->getMessage());
}
