<?php

namespace app\model;

class Pessoa {
    private $nome;
    private $sobreNome;
    private $dataNascimento;
    private $cpfCnpj;
    private $tipo;
    private $contato;
    private $endereco;

    public function __construct() {
        $this->inicializaClasse();
    }  

    private function inicializaClasse(){
        $this->tipo = 1;
        $this->contato = array();
    }
    
    public function getNomeCompleto() {
        return $this->nome . " " . $this->sobreNome . ".";
    }

    public function getIdade() {
        $dataAtual = new \DateTime();
        $idade = $dataAtual->diff($this->dataNascimento);
        return $idade->y;
    }

    public function getDescricaoTipo() {
        switch($this->tipo){
            case 1:
                return "Física";
            case 2:
                return "Jurídica";
            default:
                return "Desconhecido";
        }
    }

    public function getNome() {
        return $this->nome;
    }   

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getSobreNome() {
        return $this->sobreNome;
    }

    public function setSobreNome($sobreNome) {
        $this->sobreNome = $sobreNome;
    }

    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    public function setDataNascimento(\DateTime $dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    public function getCpfCnpj() {
        return $this->cpfCnpj;
    }

    public function setCpfCnpj($cpfCnpj) {
        $this->cpfCnpj = $cpfCnpj;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        if($tipo < 1 || $tipo > 2){
            throw new \Exception("Tipo inválido. Use 1 para Física ou 2 para Jurídica.");
        }
        $this->tipo = $tipo;
    }

    public function getEndereco() {
        return $this->endereco;
    }   

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function addContato($contato) {
        array_push($this->contato, $contato);
    }

    public function getContatos() {
        return $this->contato;
    }

    public function getContatoTelefone() {
        foreach($this->contato as $contato) {
            if($contato->getTipo() == 2) {
                return $contato->getValor();
            }
        }
        return "";
    }
    
    public function toRelatorioTXT() {
        $linha = "Nome: " . $this->nome . " " . $this->sobreNome . "\n";
        $linha .= "Idade: " . $this->getIdade() . "\n";
        $linha .= "Tipo: " . $this->getDescricaoTipo() . "\n";
        $linha .= "CPF/CNPJ: " . $this->cpfCnpj . "\n";
        $linha .= "Endereço: " . $this->endereco . "\n";
        $linha .= "Contatos:\n";
        
        foreach($this->contato as $contato) {
            $linha .= " - " . $contato->getDescricaoTipo() . ": " . $contato->getValor() . "\n";
        }
        
        $linha .= "\n"; 
        return $linha;
    }

    public function toJson() {
        
        $vars = [
            'nomeCompleto' => $this->getNomeCompleto(),
            'idade' => $this->getIdade(),
            'descricaoTipo' => $this->getDescricaoTipo(),
            'cpfCnpj' => $this->getCpfCnpj(),
            'endereco' => $this->getEndereco(),
        ];
        
        if ($this->dataNascimento instanceof \DateTime) {
            $vars['dataNascimento'] = $this->dataNascimento->format('Y-m-d');
        }

        $contatos_serializados = [];
        foreach ($this->contato as $contato) {
            if (method_exists($contato, 'toJson')) {
                $contatos_serializados[] = $contato->toJson();
            }
        }
        $vars['contatos'] = $contatos_serializados;

        return $vars;
    }
}