<?php
require_once "../control/site.config.php";
include "../control/ProdutoControl.class.php";
include "../control/PerfumeControl.class.php";
include "../model/Perfume.class.php";;

$perfumeControl = new PerfumeControl($db);
$produtoControl = new ProdutoControl($db);

$id = $_GET["id"];

$obj = $perfumeControl->buscarPorId($id); //retorna o objeto com o id enviado pela URL

if ($produtoControl->verificaVinculacao($id)) { //verifica se o produto está vinculado a algum fornecedor
    header("location: perfumeListar.php?vinculo=existe");   
} else {
    if ($perfumeControl->deletar($obj)) {
        if ($produtoControl->deletarProduto($obj)) {
            header("location: perfumeListar.php?excluir=sucesso"); //parametro para a mensagem de sucesso
        }
    } else {
        header("location: perfumeListar.php?excluir=erro"); //parametro para a mensagem de erro
    }
}
?>