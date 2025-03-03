<?php
require_once "../control/site.config.php";
include "../control/ProdutoControl.class.php";
include "../control/PerfumeControl.class.php";
include "../model/Perfume.class.php";

$produtoControl = new ProdutoControl($db);
$perfumeControl = new PerfumeControl($db);

//recebe os valores digitados no formulário
$nome = $_POST["nome"];
$marca = $_POST["marca"];
$estoque = $_POST["estoque"];
$preco = $_POST["preco"];
$genero = $_POST["genero"];
$volume = $_POST["volume"];

$objPerfume = new Perfume($nome, $marca, $estoque, $preco, $genero, $volume);

//verifica se algum campo ficou sem ser preenchido
if ($nome == "" || $marca == "" || $estoque == "" || $genero == "" || $preco == "" || $volume == "") {
    header("location: ../view/index.php?inputPerf=vazio#produto");
} else {
    if ($produtoControl->verificaNome($nome)) { //verifica se o nome está cadastrado, pois uso o nome para vincular o produto ao perfume e ao sabonete
        if($produtoControl->cadastrar($objPerfume)) { //cadastra o produto
            $id = $produtoControl->buscarId($nome); //busca o id para colocar na chave produtoFK da tabela perfume
            $perfumeControl->cadastrar($id, $objPerfume);
            header("location: ../view/index.php?cadastrarPerf=sucesso#produto"); //se o cadastro funcionar
        } else {
            header("location: ../view/index.php?cadastrarPerf=erro#produto"); //se o cadastro não funcionar
        }
    } else { //caso o nome já esteja cadastrado, a págian será direcionada para o formulário
        header("location: ../view/index.php?nome=existe#produto");
    }
}
?>
