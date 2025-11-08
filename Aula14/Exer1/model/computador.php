<?php

    class Computador{
        private $status;

    public function ligar (){
        echo"Ligado<br>";
        $this -> status = 'Ligado';
    }    

    public function desligar (){
        echo"Desligado<br>";
         $this -> status = 'Desligado';
    }
         
    
    public function getstatus (){
        return $this -> status;
    }    
    
}
 ?>