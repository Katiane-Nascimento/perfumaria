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

//pega os ids
$idProdutoAntigo = $_POST["produtoAntigo"];
$idProdutoNovo = $_POST["produto"];
$idFornecedor = $_POST["fornecedor"];

// print_r($idFornecedor);
// print_r($idProdutoAntigo);
// print_r($idProdutoNovo);

//retorna os objetos
$objFornecedor = $fornecedorControl->buscarPorId($idFornecedor); 
$objProdutoAntigo = $produtoControl->buscarPorId($idProdutoAntigo); 
$objProdutoNovo = $produtoControl->buscarPorId($idProdutoNovo); 

// print_r($objFornecedor);
// print_r($objProdutoAntigo);
// print_r($objProdutoNovo);

if ($objFornecedor == false || $objProdutoAntigo == false || $objProdutoNovo == false) {
    header("location: relFornecedorProdutoListar.php?editar=erro");
} else {
    if ($relfornecedorprodutoControl->atualizar($objFornecedor, $objProdutoAntigo, $objProdutoNovo)) {
        header("location: relFornecedorProdutoListar.php?editar=sucesso");
    } else {
        header("location: relFornecedorProdutoListar.php?editar=erro");
    }
}
?>