<?php

    class Calculadora{
        private $numero1;
        private $numero2;

    public function soma (){
        return $this -> numero1 + $this -> numero2;
    }    

    public function subtrair (){
        return $this -> numero1 - $this -> numero2;
    }    
    
    public function dividir (){
        return $this -> numero1 / $this -> numero2;
    }    
    
    public function multiplicacao (){
        return $this -> numero1 * $this -> numero2;
    }    
    

    public function getNumero1 () {
        return $this -> numero1;
     
    }

    public function setNumero1 ($n1){
        $this ->numero1=$n1;
    }

    public function getNumero2 () {
        return $this -> numero2;
     }

    public function setNumero2 ($n2){
        $this ->numero2=$n2;
    }
 }
 ?>