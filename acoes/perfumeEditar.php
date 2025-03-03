<?php
require_once "../control/site.config.php";
include "../control/ProdutoControl.class.php";
include "../control/PerfumeControl.class.php";
include "../model/Perfume.class.php";

$perfumeControl = new PerfumeControl($db);
$produtoControl = new ProdutoControl($db);

//pega os valores do formulário editar
$id = $_POST["id"];
$nome = $_POST["nome"];
$nomeAntigo = $_POST["nomeAntigo"];
$marca = $_POST["marca"];
$estoque = $_POST["estoque"];
$preco = $_POST["preco"];
$genero = $_POST["genero"];
$volume = $_POST["volume"];

if ($id != "") { 
    if ($produtoControl->verificaNome($nome) || ($nome == $nomeAntigo)) { //se o nome não estiver cadastrado ou não tiver sido atualizado
        $perfume = $perfumeControl->buscarPorId($id); //retorna o objeto que será editado
        //atualiza todos os atributos
        $perfume->setMarca($marca); 
        $perfume->setNome($nome); 
        $perfume->setEstoque($estoque); 
        $perfume->setPreco($preco); 
        $perfume->setGenero($genero); 
        $perfume->setVolume($volume); 
        // print_r($perfume);

        if ($perfumeControl->atualizar($perfume)) { //chama a função atualizar
            header("Location: perfumeListar.php?editar=sucesso"); //parâmetro para mensagem de sucesso
        } else {
            header("Location: perfumeListar.php?editar=erro"); //parâmetro para mensagem de erro
        }
    } else {
        header("Location: perfumeListar.php?nome=existe"); //parâmetro para mensagem de erro
    }
}
?>