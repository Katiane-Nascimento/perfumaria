<?php
require_once "Produto.class.php";

class Sabonete extends Produto{ //a classe sabonete é declarada e estendida da classe Produto, pois herda os métodos e propriedades da classe Produto.
    private $peso;
    private $aroma;
    private $id;

    function __construct($nome = "", $marca = "", $estoque = "", $preco = "", $aroma = "", $peso = "") {  
        parent::__construct($nome, $marca, $estoque, $preco); //chama o constructor da classe pai
        $this->peso = $peso;
        $this->aroma = $aroma;   
    }

    function getPeso() {
        return $this->peso;
    }

    function setPeso($novoValor) {
        $this->peso = $novoValor;
    }

    function getAroma() {
        return $this->aroma;
    }
    
    function setAroma($novoValor) {
        $this->aroma = $novoValor;
    }

    //---
    function getId() {
        return $this->id;
    }
    
    function setId($id) {
        return $this->id = $id;
    }
    //--

    function toString() {
        return parent::toString() . //chama o toString da classe pai
        " - Peso: ". $this->peso . " - Aroma: ". $this->aroma;
    }
}

// //teste:
// $sabonete = new Sabonete ("Jasmin", "Francis", "100", "3,00", "40g", "Jasmin");
// echo $sabonete->toString();
?>