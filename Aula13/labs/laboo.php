<?php
require_once "model/pessoa.php"; 
require_once "model/contato.php";

$minhaPessoa = new \app\model\Pessoa();
$minhaPessoa->setNome("Melissa");
$minhaPessoa->setSobreNome("Minatti");
$minhaPessoa->setDataNascimento(new DateTime("2005-03-01")); 
$minhaPessoa->setCpfCnpj("123.456.789-00"); 
$minhaPessoa->setEndereco("Rua catharina schmitz, sn, Rio do Sul, SC"); 

$contatoTelefone = new \app\model\Contato(2, "Telefone Pessoal", "(47) 99999-0000");

$minhaPessoa->addContato($contatoTelefone);


echo "<h1>LAB 3 - Orientação a Objetos</h1>";
echo "<h2>Dados de {$minhaPessoa->getNome()}</h2>";
echo "<ul>";
echo "<li>Nome Completo: " . $minhaPessoa->getNomeCompleto() . "</li>";
echo "<li>Idade Calculada: " . $minhaPessoa->getIdade() . " anos</li>";
echo "<li>Endereço: " . $minhaPessoa->getEndereco() . "</li>";
echo "<li>Telefone Principal: " . $minhaPessoa->getContatoTelefone() . "</li>";
echo "</ul>";
?>