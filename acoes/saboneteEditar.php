<?php
require_once "../control/site.config.php";
include "../control/SaboneteControl.class.php";  
include "../control/ProdutoControl.class.php";  
include "../model/Sabonete.class.php";

$saboneteControl = new SaboneteControl($db);
$produtoControl = new ProdutoControl($db);

//pega os valores do formulário editar
$id = $_POST["id"];
$nome = $_POST["nome"];
$nomeAntigo = $_POST["nomeAntigo"];
$marca = $_POST["marca"];
$estoque = $_POST["estoque"];
$preco = $_POST["preco"];
$aroma = $_POST["aroma"];
$peso = $_POST["peso"];

if ($id != "") { 
    if ($produtoControl->verificaNome($nome) || ($nome == $nomeAntigo)) { //se o nome não estiver cadastrado ou não tiver sido atualizado
    $sabonete = $saboneteControl->buscarPorId($id); //retorna o objeto que será editado
        //atualiza os atributos
        $sabonete->setNome($nome); 
        $sabonete->setMarca($marca); 
        $sabonete->setEstoque($estoque); 
        $sabonete->setPreco($preco); 
        $sabonete->setAroma($aroma); 
        $sabonete->setPeso($peso); 
        print_r($sabonete);

        if ($saboneteControl->atualizar($sabonete)) { //chama a função atualizar
            header("Location: saboneteListar.php?editar=sucesso"); //parâmetro para mensagem de sucesso
        } else {
            header("Location: saboneteListar.php?editar=erro"); //parâmetro para mensagem de erro
        }
    } else {
        header("Location: saboneteListar.php?nome=existe"); //parâmetro para mensagem de erro
    }
}
?>