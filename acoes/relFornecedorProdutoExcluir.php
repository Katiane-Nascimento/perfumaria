<?php
require_once "../control/site.config.php";
include "../control/ProdutoControl.class.php";
include "../control/FornecedorControl.class.php";
include "../control/RelFornecedorProdutoControl.class.php";
include "../model/Produto.class.php";
include "../model/Fornecedor.class.php";

$fornecedorControl = new FornecedorControl($db);
$produtoControl = new ProdutoControl($db);
$relfornecedorprodutoControl = new RelFornecedorProdutoControl($db);

$id = $_GET["id"]; //recebe o id do produto cadastrado da tabela relFornecedorProduto

$idFornecedor = $fornecedorControl->buscarIdFornecedor($id); //encontra o id do fornecedor usando o id do produto
$objFornecedor = $fornecedorControl->buscarPorId($idFornecedor); //retorna o objeto do fornecedor através do id informado
$objProduto = $produtoControl->buscarPorId($id); //retorna o objeto produto

// print_r($objFornecedor);
// print_r($ObjProduto);

if ($objFornecedor == false || $objProduto == false) { //se o objeto não for criado retorna false
    header("location: relFornecedorProdutoListar.php?excluir=erro#vincular");
} else {
    if ($relfornecedorprodutoControl->deletar($objFornecedor, $objProduto)) { //retorna true se o vinculo for deletado corretamente
        header("location: relFornecedorProdutoListar.php?excluir=sucesso#vincular"); 
    } else {
        header("location: relFornecedorProdutoListar.php?excluir=sucesso#vincular"); 
    }
}
?>