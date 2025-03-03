<?php
class Produto {
    private $nome;
    private $marca;
    private $estoque;
    private $preco;
    private $id;

    function __construct($nome = "", $marca = "", $estoque = "", $preco = "") {     
        $this->nome = $nome;
        $this->marca = $marca;
        $this->estoque = $estoque;       
        $this->preco = $preco;       
    }

    function getNome() {
        return $this->nome;
    }

    function setNome($novoValor) {
        return $this->nome = $novoValor;
    }

    function getMarca() {
        return $this->marca;
    }
    
    function setMarca($novoValor) {
        return $this->marca = $novoValor;
    }

    function getEstoque() {
        return $this->estoque;
    }
    
    function setEstoque($novoValor) {
        if ($novoValor < 0) {
            return null;
        } else {
            $this->estoque = $novoValor;
        }
    }

    function getPreco() {
        return $this->preco;
    }
    
    function setPreco($novoValor) {
        $this->preco = $novoValor;
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
        return "#". $this->id . " - Nome: ". $this->nome . " - Marca: ". $this->marca . " - Preço: R$". $this->preco . " - Estoque: ". $this->estoque;
    }
}
// //teste:
// $produto = new Produto ("Kaiak", "Natura", "50", "100,00");
// echo $produto->toString();
?>