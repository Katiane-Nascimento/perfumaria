<?php
require_once "../control/site.config.php";
include "../control/SaboneteControl.class.php";
include "../control/ProdutoControl.class.php"; 
include "../model/Sabonete.class.php";

$saboneteControl = new saboneteControl($db);
$produtoControl = new ProdutoControl($db);

$id = $_GET["id"];

$obj = $saboneteControl->buscarPorId($id); //retorna o objeto com o id enviado pela URL

if ($produtoControl->verificaVinculacao($id)) { //verifica se o sabonete já está vinculado a algum fornecedor
    header("location: saboneteListar.php?vinculo=existe");   
} else {
    if ($saboneteControl->deletar($obj)) {
        if ($produtoControl->deletarProduto($obj)) {
            header("location: saboneteListar.php?excluir=sucesso"); //parametro para a mensagem de sucesso
        }
    } else {
        header("location: saboneteListar.php?excluir=erro"); //parametro para a mensagem de erro
    }
}
?>