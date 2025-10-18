<?php

    define('aquivo' ,'dados.txt');
    define('arquivo2','dados2.txt');


    if(file_exists(aquivo)) {
        echo "O arquivo existe. <br>";

        $conteudo = file_get_contents(aquivo);
        echo "Conteúdo do arquivo:<br>";
        echo nl2br($conteudo);

        //Escrever em um novo arquivo 
        $conteudoNovo = serialize($conteudo);
        file_put_contents(arquivo2, $conteudoNovo);
        echo "<br>Conteúdo escrito no novo arquivo 'dados2.txt'. ";
    }
?>