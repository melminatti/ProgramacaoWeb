<?php
    class Session {
        private $sessionId;
        private $status;
        private $usuario;
        private $dataHoraInicio;
        private $dataHoraUltimoAcesso

        public function iniciaSessao(){
            session_start();
            $this->$sessionId = session_id();
            if($this->getDadosSessao('usuario')){  
            $this->$dataHoraUltimoAcesso = date()
        }
        public function finalizaSessao(){

        }
        public function getUsuarioSessao(){
            return $this->usuario;
        }
    }
    
    }    
?>