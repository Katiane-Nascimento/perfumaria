<?php
require_once "Produto.class.php";

class Perfume extends Produto{ //a classe Perfume é declarada e estendida da classe Produto, pois Perfume herda os métodos e propriedades da classe Produto.
    private $volume;
    private $genero;
    private $id;

    function __construct($nome = "", $marca = "", $estoque = "", $preco = "", $genero = "", $volume = "") {  
        parent::__construct($nome, $marca, $estoque, $preco); //chama o constructor da classe pai
        $this->volume = $volume;
        $this->genero = $genero;   
    }

    function getVolume() {
        return $this->volume;
    }

    function setVolume($novoValor) {
        $this->volume = $novoValor;
    }

    function getGenero() {
        return $this->genero;
    }
    
    function setGenero($novoValor) {
        $this->genero = $novoValor;
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
        " - Volume: ". $this->volume . " - Gênero: ". $this->genero;
    }
}
// //teste:
// $perfume = new Perfume ("Kaiak", "Natura", "50", "100,00", "100ml", "Masculino");
// echo $perfume->toString();
?>