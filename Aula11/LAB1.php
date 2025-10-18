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
    
 /*Etapa 2 -Fazer uma query simples */
    $result = pg_query($condb, "SELECT COUNT(*) AS QTDTABS FROM pg_tables");
    while($row = pg_fetch_assoc($result)) {
        echo "Numero de tabelas no banco de dados: " .$row['qtdtabs'];
    }

    //Inserir dados na tabela de pessoas
    $aDados = array('João', 'Silva', 'joaosilva@gmail.com', '123456', 'São Paulo', 'SP');
    $result = pg_query_params ($condb, "INSERT INTO TBPESSOA (PESNOME , PESSOBRENOME , PESEMAIL, PESPASSWORD, PESCIDADE, PESESTADO)
                                VALUES ($1, $2, $3, $4, $5, $6)", 
                                $aDados);
    if($result) {
        echo "<br> Dados inseridos com sucesso na tabela TBPESSOA!";
    }

?>