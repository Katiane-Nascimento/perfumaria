<?php
require_once "../control/site.config.php";
include "../control/FornecedorControl.class.php"; 
include "../model/Fornecedor.class.php";

function criaMain($tipo) {
    if ($tipo == 1) {
        return '<main>
            <div class="container" style="display: flex; flex-direction: column; align-items: center;">
            <br>
            <nav class="navbar">
                <div class="container-fluid">
                    <form class="d-flex" action="fornecedorPesquisar.php" method="POST">
                        <input class="form-control me-2 border-dark" type="search" placeholder="CNPJ ou Razão Social" name="pesquisa">
                        <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </nav>
            <br>
                <table class="table table-striped table-hover table-bordered border-dark table" style="width: 60vw;">
                <thead class="table-dark">
                <tr><th class="table-dark text-center" colspan="5">FORNECEDORES</th></tr>
                <tr>
                  <th scope="col" class="col-1">#</th>
                  <th scope="col" class="col-2">CNPJ</th>
                  <th scope="col" class="col-2">Razão Social</th>
                  <th scope="col" class="col-2">Endereço</th>
                  <th scope="col" class="col-2">Ações</th>
                </tr>
              </thead>
              <tbody';
    } else if ($tipo == 2) {
        return '  
        </tbody>  
        </table>
            <a href="../view/index.php#fornecedor" class="btn btn-dark">Voltar</a>
        </div>
        </main>';
    }
}

//após as funções excluir e editar serem chamadas, mostra as mensagens de erro ou de sucesso
function imprimeMensagem () {
    @$editar = $_GET["editar"];
    @$excluir = $_GET["excluir"];
    @$vinculo = $_GET["vinculo"];

    if ($editar == "sucesso") {
        return "<h4 class='sucesso'>Dados do fornecedor atualizados com sucesso!</h4><br><br>";
    } else if ($editar == "erro"){
        return "<h4 class='erro'>Erro! Não foi possível atualizar os dados do fornecedor!</h4><br><br>";
    }

    if ($excluir == "sucesso") {
        return "<h4 class='sucesso'>Fornecedor excluído com sucesso!</h4><br><br>";
    } else if ($excluir == "erro"){
        return "<h4 class='erro'>Erro! O fornecedor não foi excluído!</h4><br><br>";
    }

    if ($vinculo == "existe"){
        return "<h4 class='erro'>Erro! Esse fornecedor não pode ser excluído pois está vinculado a um produto!</h4><br><br>";
    }
} 
 

$fornecedorControl = new FornecedorControl($db);
$pesquisa = $_POST["pesquisa"]; //recebe a string digitada
$resultados = $fornecedorControl->pesquisar($pesquisa); //verifica se a satring existe no CNPJ ou razão social 

echo criaHeaderPagEditar();
echo criaMain(1);
echo imprimeMensagem();
foreach($resultados as $valor) {
    echo "<tr> <td>".$valor->getId()."</td>  <td>".$valor->getCNPJ()."</td>  <td>".$valor->getRazaoSocial()."</td>  <td>".$valor->getEndereco()."</td>  <td><a href='fornecedorLocalizar.php?id=".$valor->getId()."' class='btn btn-primary'>Editar</a> <a href='fornecedorConfirmaExclusao.php?id=".$valor->getId()."' class='btn btn-danger'>Excluir</a></td></tr>"; //os botões excluir e editar enviam o id através da URL
}
echo criaMain(2);
echo criaFooter();
?>
