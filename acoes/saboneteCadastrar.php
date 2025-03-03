<?php
require_once "../control/site.config.php";
include "../control/ProdutoControl.class.php";
include "../control/SaboneteControl.class.php";

include "../model/Sabonete.class.php";

$produtoControl = new ProdutoControl($db);
$saboneteControl = new SaboneteControl($db);

//recebe os valores digitados no formulário
$nome = $_POST["nome"];
$marca = $_POST["marca"];
$estoque = $_POST["estoque"];
$preco = $_POST["preco"];
$aroma = $_POST["aroma"];
$peso = $_POST["peso"];

$objSabonete = new Sabonete($nome, $marca, $estoque, $preco, $aroma, $peso);

//verifica se algum campo ficou sem ser preenchido
if ($nome == "" || $marca == "" || $estoque == "" || $aroma == "" || $preco == "" || $peso == "") {
    header("location: ../view/index.php?inputSabon=vazio#produto");
} else {
    if ($produtoControl->verificaNome($nome)) { //verifica se o nome está cadastrado, pois uso o nome para vincular o produto ao perfume e ao sabonete
        if($produtoControl->cadastrar($objSabonete)) {  //cadastra o produto
            $id = $produtoControl->buscarId($nome); //busca o id para colocar na chave produtoFK da tabela sabonete
            $saboneteControl->cadastrar($id, $objSabonete);
            header("location: ../view/index.php?cadastrarSabon=sucesso#produto"); //se o cadastro funcionar
        } else {
            header("location: ../view/index.php?cadastrarSabon=erro#produto"); //se o cadastro não funcionar
        }
    } else { //caso o nome já esteja cadastrado, a págian será direcionada para o formulário
        header("location: ../view/index.php?nomeSabon=existe#produto");
    }
}
?>
