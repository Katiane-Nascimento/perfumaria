<?php
require_once "site.config.php";
include "PerfumeControl.class.php";
include "ProdutoControl.class.php";
include "RelProdutoPerfumeControl.class.php";  
include "../model/Perfume.class.php";

$rel = new RelProdutoPerfumeControl($db);

$produtoControl = new ProdutoControl($db);
$perfumeControl = new PerfumeControl($db);


$produto = new Produto("Essencial", "Jequiti", "1000", "800,00");
$perfume = new Perfume("feminino", "100ml");

$produtoControl->cadastrar($produto);
$perfumeControl->cadastrar($perfume);

$cadastro = $rel->cadastrar($produtoControl->cadastrar($produto), $perfumeControl->cadastrar($perfume));

print_r($cadastro);

//------------------------testes perfumes--------------------------
// $perfume = $perfumeControl->buscarPorId("4", "1");
// $perfume[1]->setVolume("30ml");
// $perfume[0]->setMarca("Jordan");
// $perfume[1]->setMarca("Jordan");
// print_r($perfume);
// $perfumeControl->atualizar($perfume);

// $excluirProduto = $perfumeControl->buscarPorId("9", "3");
// print_r($excluirProduto);
// if ($perfumeControl->deletar($excluirProduto)) {
//     echo "excluiu";
// } else {
//     echo "Não excluiu";
// }

// $produto = new Produto("Essencial", "Jequiti", "1000", "800,00");
// $perfume = new Perfume($produto->getNome(), $produto->getMarca(), $produto->getEstoque(), $produto->getPreco(), "feminino", "100ml");
// print_r($perfumeControl->cadastrar($produto, $perfume));

// $resultados = $perfumeControl->listarObj();
// foreach($resultados[0] as $valor) {
//     echo "<tr> <td>".$valor->getId()."</td>  <td>".$valor->getNome()."</td>  <td>".$valor->getMarca()."</td><br>";
// }

// foreach($resultados[1] as $valor) {
//     echo "<tr> <td>".$valor->getId()."</td>  <td>".$valor->getGenero()."</td>  <td>".$valor->getVolume()."</td><br>";
// }


//-------------------testes fornecedores----------------------------------
// $resultados = $perfumeControl->listarObj();
// foreach($resultados as $valor) {
//     echo "<tr> <td>".$valor->getId()."</td>  <td>".$valor->getGenero()."</td>  <td>".$valor->getVolume()."</td><br>";
// }

// $excluir = $perfumeControl->buscarPorId("3");
// $perfumeControl->deletar($excluir);

// $perfume = $perfumeControl->buscarPorId("4");
// $perfume->setVolume("500ml");
// $perfumeControl->atualizar($perfume);

// $produtoControl = new ProdutoControl($db);
// // $produto1 = new Produto("Kaiak", "Natura", 40, "50,90");

// // $resultados = $produtoControl->listarObj();
// // foreach($resultados as $valor) {
// //     echo "<tr> <td>".$valor->getId()."</td>  <td>".$valor->getNome()."</td>  <td>".$valor->getMarca()."</td><br>";
// // }

// // $excluir = $produtoControl->buscarPorId("3");
// // $produtoControl->deletar($excluir);

// // if($produtoControl->verificaNome("kaiak")){
// //     echo "Não existe";
// // } else {
// //     echo "Já existe";
// // }

// // $produto = $produtoControl->buscarPorId("4");
// // $produto->setMarca("Dior");
// // $produtoControl->atualizar($produto);
?>