<?php

class Fornecedor {
    private $id;
    private $CNPJ;
    private $razaoSocial;
    private $endereco;
    private $produtos;

    function __construct($CNPJ = "", $razaoSocial = "", $endereco = "") {     
        $this->CNPJ = $CNPJ;
        $this->razaoSocial = $razaoSocial;
        $this->endereco = $endereco;       
        $this->produtos = array();       
    }

    function getCNPJ() {
        return $this->CNPJ;
    }

    function setCNPJ($novoValor) {
        $this->CNPJ = $novoValor;
    }

    function getRazaoSocial() {
        return $this->razaoSocial;
    }
    
    function setRazaoSocial($novoValor) {
        $this->razaoSocial = $novoValor;
    }

    function getEndereco() {
        return $this->endereco;
    }
    
    function setEndereco($novoValor) {
        $this->endereco = $novoValor;
    }

    function getProdutos() {
        return $this->produtos;
    }
    
    function setProdutos($novoValor) {
        $this->produtos[] = $novoValor;
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
        return "#". $this->id . " - CNPJ: ". $this->CNPJ . " - Razão Social: ". $this->razaoSocial .  " - Endereço: ". $this->endereco;
    }

    function mostrarFornecedor() {
        return $this->CNPJ . " - ". $this->razaoSocial;
    }
}
// //teste:
// $fornecedor = new Fornecedor ("123.456.789.097-12", "Eudora", "Barracão");
// echo $fornecedor->toString();
?>