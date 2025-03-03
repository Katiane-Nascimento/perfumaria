<?php
require_once "../control/site.config.php";
include "../control/RelFornecedorProdutoControl.class.php";
include "../control/FornecedorControl.class.php";
include "../control/PerfumeControl.class.php";
include "../control/SaboneteControl.class.php";

include "../model/Fornecedor.class.php";
include "../model/Perfume.class.php";
include "../model/Sabonete.class.php";

function criaMain($tipo) {
    if ($tipo == 1) {
        return '<main>
            <div class="container" style="display: flex; flex-direction: column; align-items: center;">
            <br>
            <nav class="navbar">
                <div class="container-fluid">
                    <form class="d-flex" action="relFornecedorProdutoPesquisar.php" method="POST">
                        <input class="form-control me-2 border-dark" type="search" placeholder="Nome do produto" name="pesquisa">
                        <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </nav>
            <br>
                <table class="table table-striped table-hover table-bordered border-dark table" style="width: 70vw;">
                <thead class="table-dark">
                <tr><th class="table-dark text-center" colspan="12">FORNECEDORES E PRODUTOS VINCULADOS</th></tr>
                <tr>
                    <th class="table-dark text-center">Fornecedor</th>
                    <th class="table-dark text-center">Produto</th>
                    <th class="table-dark text-center col-2"">Ações</th>
                </tr>
              </thead>
              <tbody';
    } else if ($tipo == 2) {
        return '  
        </tbody>  
        </table>
            <a href="../view/index.php#vincular" class="btn btn-dark">Voltar</a>
        </div>
        </main>';
    }
}

//após as funções excluir e editar serem chamadas, mostra as mensagens de erro ou de sucesso
function imprimeMensagem () {
    @$editar = $_GET["editar"];
    @$excluir = $_GET["excluir"];

    if ($editar == "sucesso") {
        return "<h4 class='sucesso'>Vínculo entre fornecedor e produto atualizado com sucesso!</h4><br><br>";
    } else if ($editar == "erro"){
        return "<h4 class='erro'>Erro! Não foi possível atualizar o vínculo entre fornecedor e produto!</h4><br><br>";
    }

    if ($excluir == "sucesso") {
        return "<h4 class='sucesso'>Vínculo entre fornecedor e produto excluído com sucesso!</h4><br><br>";
    } else if ($excluir == "erro"){
        return "<h4 class='erro'>Erro! Não foi possível excluir o vínculo entre o fornecedor e o produto!</h4><br><br>";
    }
} 

$relFornecedorProduto = new RelFornecedorProdutoControl($db);
$resultados = $relFornecedorProduto->listar(); //chama a função responsável por buscar os valores no banco de dados e transformar em objetos

echo criaHeaderPagEditar();
echo criaMain(1);
echo imprimeMensagem();
foreach ($resultados as $valor) { //mostra o fornecedor          //mostra o produto
    echo "<tr> <td>".$valor[0]->toString()."</td>  <td>".$valor[1]->toString()."</td>  <td><a href='relFornecedorProdutoLocalizar.php?id=".$valor[1]->getId()."'class='btn btn-primary'>Editar</a> <a href='relFornecedorProdutoConfirmaExclusao.php?id=".$valor[1]->getId()."'class='btn btn-danger'>Excluir</a></td> </tr>"; //pega o id do produto
}
echo criaMain(2);
echo criaFooter();
?>
