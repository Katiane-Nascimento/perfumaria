<?php
require_once "../control/site.config.php";
include "../control/FornecedorControl.class.php"; 
include "../model/Fornecedor.class.php";

$fornecedorControl = new FornecedorControl($db);

//recebe os valores digitados no formulário
$CNPJ = $_POST["cnpj"];
$razaoSocial = $_POST["razaoSocial"];
$endereco = $_POST["endereco"];

$obj = new Fornecedor($CNPJ, $razaoSocial, $endereco);

//verifica se algum campo ficou sem ser preenchido
if ($CNPJ == "" || $razaoSocial == "" || $endereco == "") {
    header("location: ../view/index.php?input=vazio#fornecedor");
//verifica se o CNPJ possui entre 14 e 18 caracteres
} else if (strlen($CNPJ) < 14 || strlen($CNPJ) > 18) {
    header("location: ../view/index.php?cnpj=invalido#fornecedor");
} else {
    if ($fornecedorControl->verificaCNPJ($CNPJ)) { //verifica se o CNPj já está cadastrado
        if ($fornecedorControl->cadastrar($obj)) {
            header("location: ../view/index.php?cadastrar=sucesso#fornecedor"); //redireciona para a página de cadastro e mostra uma mensagem de sucesso
        } else {
            header("location: ../view/index.php?cadastrar=erro#fornecedor"); //redireciona para a página de cadastro e mostra uma mensagem de erro
        }
    } else {
        header("location: ../view/index.php?cnpj=existe#fornecedor");
    }
}
?>
