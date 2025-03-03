<?php
require_once "../control/site.config.php";
include "../control/FornecedorControl.class.php";
include "../control/ProdutoControl.class.php";
include "../control/RelFornecedorProdutoControl.class.php"; 

include "../model/Fornecedor.class.php";
include "../model/Produto.class.php";

$fornecedorControl = new FornecedorControl($db);
$produtoControl = new ProdutoControl($db);
$relFornecedorProduto = new RelFornecedorProdutoControl($db);

$sltFornecedor = $_POST["fornecedor"]; //recebe do formulário o id do fornecedor
$sltProduto = $_POST["produto"]; //recebe do formulário o id do produto

if ($sltFornecedor == "" || $sltProduto == "") { //verifica se as duas entradas foram preenchidas
    header("location: ../view/index.php?selects=vazios#vincular");
} else {
    if ($relFornecedorProduto->cadastrar($sltFornecedor, $sltProduto)){ //passa os ids
        header("location: ../view/index.php?vinculo=sucesso#vincular");
    } else {
        header("location: ../view/index.php?vinculo=erro#vincular");
    }
}
?>