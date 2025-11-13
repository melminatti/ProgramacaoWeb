<?php

require_once "../../labs/model/pessoa.php";
require_once "../../labs/model/contato.php";

use app\model\Pessoa;
use app\model\Contato;


$minhaPessoa = new Pessoa();


$minhaPessoa->setNome("Melissa");
$minhaPessoa->setSobreNome("Minatti");
$minhaPessoa->setDataNascimento(new DateTime("2005-03-01")); 
$minhaPessoa->setCpfCnpj("123.456.789-00");
$minhaPessoa->setEndereco("Rua catharina schmitz, sn, Rio do Sul, SC");

$contatoEmail = new Contato(1, "E-mail Pessoal", "melissa.minatti@email.com");
$minhaPessoa->addContato($contatoEmail);

echo "<h1>Exercício 1: Implementação do Modelo Completo</h1>";
echo "<h2>Instância: {$minhaPessoa->getNome()} {$minhaPessoa->getSobreNome()}</h2>";
echo "<ul>";
echo "<li>Nome Completo: " . $minhaPessoa->getNomeCompleto() . "</li>";
echo "<li>Idade Calculada: " . $minhaPessoa->getIdade() . " anos</li>"; 
echo "<li>Endereço: " . $minhaPessoa->getEndereco() . "</li>";
echo "<li>E-mail Principal: " . $minhaPessoa->getContatos()[0]->getValor() . "</li>"; 
echo "</ul>";

?>