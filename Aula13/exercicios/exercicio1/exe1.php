<?php
// Arquivo: exercicios/exercicio1/exe1.php

// 1. CORREÇÃO: Ajuste do caminho (subindo dois níveis para encontrar /labs/model/)
require_once "../../labs/model/pessoa.php";
require_once "../../labs/model/contato.php";

// 2. Usar os Namespaces para importar as classes
use app\model\Pessoa;
use app\model\Contato;

// 3. Instanciar um objeto PESSOA para VOCÊ (Melissa Minatti)
$minhaPessoa = new Pessoa();

// 4. Passar os dados usando os Setters
$minhaPessoa->setNome("Melissa");
$minhaPessoa->setSobreNome("Minatti");
$minhaPessoa->setDataNascimento(new DateTime("2005-03-01")); 
$minhaPessoa->setCpfCnpj("123.456.789-00");
$minhaPessoa->setEndereco("Rua catharina schmitz, sn, Rio do Sul, SC");

// Cria um Contato para demonstração de Colaboração
$contatoEmail = new Contato(1, "E-mail Pessoal", "melissa.minatti@email.com");
$minhaPessoa->addContato($contatoEmail);


// 5. Exibir os resultados
echo "<h1>Exercício 1: Implementação do Modelo Completo</h1>";
echo "<h2>Instância: {$minhaPessoa->getNome()} {$minhaPessoa->getSobreNome()}</h2>";
echo "<ul>";
echo "<li>Nome Completo: " . $minhaPessoa->getNomeCompleto() . "</li>";
echo "<li>Idade Calculada: " . $minhaPessoa->getIdade() . " anos</li>"; 
echo "<li>Endereço: " . $minhaPessoa->getEndereco() . "</li>";
echo "<li>E-mail Principal: " . $minhaPessoa->getContatos()[0]->getValor() . "</li>"; 
echo "</ul>";

?>