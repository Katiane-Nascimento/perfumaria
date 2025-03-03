<?php
require_once "../control/site.config.php";
include "../control/FornecedorControl.class.php"; 
include "../model/Fornecedor.class.php";

$fornecedorControl = new FornecedorControl($db);

//pega os valores do formulário editar
$id = $_POST["id"];
$CNPJ = $_POST["CNPJ"];
$CNPJantigo = $_POST["CNPJantigo"];
$razaoSocial = $_POST["razaoSocial"];
$endereco = $_POST["endereco"];

if ($id != "") {
    if ($fornecedorControl->verificaCNPJ($CNPJ) || ($CNPJ == $CNPJantigo)) { //se o CNPJ não estiver cadastrado ou não tiver sido atualizado
        $fornecedor = $fornecedorControl->buscarPorId($id);
        $fornecedor->setCNPJ($CNPJ); //edita o CNPJ
        $fornecedor->setRazaoSocial($razaoSocial); //edita a razão social
        $fornecedor->setEndereco($endereco); 
 
        if ($fornecedorControl->atualizar($fornecedor)) { //chama a função atualizar
            header("Location: fornecedorListar.php?editar=sucesso"); //parâmetro para mensagem de sucesso
        } else {
            header("Location: fornecedorListar.php?editar=erro"); //parâmetro para mensagem de erro
        }
    } else {
        header("Location: fornecedorListar.php?cnpj=existe"); //parâmetro para mensagem de sucesso
    }
}

?>