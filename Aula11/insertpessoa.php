<?php
define('DB_HOST', 'localhost');
define('DB_PORT' , '5432');
define('DB_USER', 'postgres');
define('DB_PASS', 'postgres');
define('DB_NAME','local');

$connectionString =  "host=" .DB_HOST.
                     " port=". DB_PORT.
                     " dbname=".DB_NAME.
                     " user=".DB_USER.
                     " password=".DB_PASS;

$condb = pg_connect($connectionString);
if(!$condb) {
    echo "Erro ao conectar ao banco de dados";
} else {
    echo"Conexão bem-sucedida! <br>";
}
    $nome = $_POST["Nome"];
    $sobrenome = $_POST["Sobrenome"];
    $email = $_POST["Email"];
    $senha = $_POST["Senha"];
    $cidade = $_POST["Cidade"];
    $estado = $_POST["Estado"];
    
    $aDados = array($nome, $sobrenome, $email, $senha, $cidade, $estado);
    $result = pg_query_params ($condb, "INSERT INTO TBPESSOA (PESNOME , PESSOBRENOME , PESEMAIL, PESPASSWORD, PESCIDADE, PESESTADO)
                                VALUES ($1, $2, $3, $4, $5, $6)", 
                                $aDados);
        if($result) {
            echo "<br> Dados inseridos com sucesso na tabela TBPESSOA!";
    }
    echo"<a href='http://localhost/ProgramacaoWeb/Aula11/cadastro.html'> Voltar</a>";
?>