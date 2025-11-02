<?php
namespace app\model;
    class Contato {
        private $tipo;
        private $nome;
        private $valor;

        public function __construct($tipo, $nome, $valor) {
            $this->tipo = $tipo;
            $this->nome = $nome;
            $this->valor = $valor;
        }

        public function getDescricaoTipo() {
            switch($this->tipo){
                case 1:
                    return "Email";
                case 2:
                    return "Telefone";
                case 3:
                    return "Celular";
                default:
                    return "Desconhecido";
            }
        }

        public function getTipo() {
            return $this->tipo;
        }   

        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }

        public function getValor() {
            return $this->valor;
        }

        public function setValor($valor) {
            $this->valor = $valor;
        }

        public function toJson() {
            return [
                'tipo_id' => $this->tipo,
                'tipo' => $this->getDescricaoTipo(),
                'nome' => $this->nome,
                'valor' => $this->valor
            ];
        }
    }
?>