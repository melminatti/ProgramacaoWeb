<?php
require_once "../../labs/model/pessoa.php";
require_once "../../labs/model/contato.php";

use app\model\Pessoa;
use app\model\Contato;

$familia = [];

$eu = new Pessoa();
$eu->setNome("Melissa");
$eu->setSobreNome("Minatti");
$eu->setDataNascimento(new DateTime("2005-03-01"));
$eu->setCpfCnpj("111.111.111-11");
$contatoEmailEu = new Contato(1, "E-mail", "melissa@email.com");
$contatoTelefoneEu = new Contato(2, "Celular", "(47) 9999-0000"); 
$eu->addContato($contatoEmailEu);
$eu->addContato($contatoTelefoneEu);
$eu->setEndereco("Rua catharina schmitz, sn, Rio do Sul, SC");

$pai = new Pessoa();
$pai->setNome("Gessinei");
$pai->setSobreNome("Minatti");
$pai->setDataNascimento(new DateTime("1978-08-10"));
$pai->setCpfCnpj("222.222.222-22");
$contatoPai = new Contato(2, "Celular", "(47) 9999-0000"); 
$pai->addContato($contatoPai);
$pai->setEndereco("Rua catharina schmitz, sn, Rio do Sul, SC");

$mae = new Pessoa();
$mae->setNome("Joseane");
$mae->setSobreNome("Goes");
$mae->setDataNascimento(new DateTime("1979-09-23"));
$mae->setCpfCnpj("333.333.333-33");
$contatoMae = new Contato(2, "Celular", "(47) 9999-0000"); 
$mae->addContato($contatoMae);
$mae->setEndereco("Rua catharina schmitz, sn, Rio do Sul, SC");

$irma = new Pessoa();
$irma->setNome("Brenda");
$irma->setSobreNome("Minatti");
$irma->setDataNascimento(new DateTime("2000-02-15"));
$irma->setCpfCnpj("444.444.444-44");
$contatoIrma = new Contato(2, "Celular", "(47) 9999-0000"); 
$irma->addContato($contatoIrma);
$irma->setEndereco("Rua catharina schmitz, sn, Rio do Sul, SC");

$familia[] = $eu;
$familia[] = $pai;
$familia[] = $mae;
$familia[] = $irma;  

$conteudo_final_txt = "";
foreach ($familia as $pessoa) {
     $conteudo_final_txt .= $pessoa->toRelatorioTXT();
}

$arquivo_destino_txt = "familia.txt"; 

if (file_put_contents($arquivo_destino_txt, $conteudo_final_txt)) {
 $mensagem_txt = "Sucesso! O array de instâncias foi salvo em: " . $arquivo_destino_txt;
} else {
 $mensagem_txt = "ERRO: Falha ao escrever no arquivo TXT. Verifique as permissões da pasta.";
}

$familia_serializavel = array_map(function($pessoa) {
 return $pessoa->toJson(); 
}, $familia);

$conteudo_serializado_json_compacto = json_encode($familia_serializavel, JSON_UNESCAPED_UNICODE); 

$conteudo_serializado_json_visual = json_encode($familia_serializavel, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); 

$arquivo_destino_json = "familia.json"; 

if (file_put_contents($arquivo_destino_json, $conteudo_serializado_json_compacto)) {
 $mensagem_json = "Sucesso! O array de instâncias foi salvo em: " . $arquivo_destino_json;
} else {
 $mensagem_json = "ERRO: Falha ao escrever no arquivo JSON. Verifique as permissões da pasta.";
}

$mensagem = $mensagem_txt . "<br>" . $mensagem_json;

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
 <meta charset="UTF-8">
 <title>Exercício 2 & 3 - Persistência TXT e JSON</title>
</head>
<body>
 <h1>Exercício 2 & 3: Persistência TXT e JSON</h1>
 <p><?= $mensagem ?></p>
 
 <h3>Conteúdo do Arquivo TXT (Visualização)</h3>
 <pre><?= htmlspecialchars($conteudo_final_txt) ?></pre>
 
 <h3>Conteúdo do Arquivo JSON (Visualização - Indentado)</h3>
 <pre><?= htmlspecialchars($conteudo_serializado_json_visual) ?></pre>
</body>
</html>