<?php
require_once "../control/site.config.php";
include "../control/FornecedorControl.class.php"; 
include "../model/Fornecedor.class.php";

$fornecedorControl = new FornecedorControl($db);
$id = $_GET["id"];

$obj = $fornecedorControl->buscarPorId($id); //retorna o objeto com o id enviado pela URL

if ($fornecedorControl->verificaVinculacao($id)) { //verifica se o fornecedor está vinculado a algum produto
    header("location: fornecedorListar.php?vinculo=existe");
} else {
    if ($fornecedorControl->deletar($obj)) {
        header("location: fornecedorListar.php?excluir=sucesso"); //parametro para a mensagem de sucesso
    } else {
        header("location: fornecedorListar.php?excluir=erro"); //parametro para a mensagem de erro
    }
}
?>