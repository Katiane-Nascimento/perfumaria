<?php
require_once "../control/site.config.php";
include "../control/PerfumeControl.class.php";
include "../model/Perfume.class.php";

function criaMain($tipo) {
    if ($tipo == 1) {
        return '<main>
            <div class="container" style="display: flex; flex-direction: column; align-items: center;">
            <br>
            <nav class="navbar">
                <div class="container-fluid">
                    <form class="d-flex" action="perfumePesquisar.php" method="POST">
                        <input class="form-control me-2 border-dark" type="search" placeholder="Nome ou Marca" name="pesquisa">
                        <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </nav>
            <br>
                <table class="table table-striped table-hover table-bordered border-dark table" style="width: 60vw;">
                <thead class="table-dark">
                <tr><th class="table-dark text-center" colspan="8">PERFUMES</th></tr>
                <tr>
                  <th scope="col" class="col-1">#</th>
                  <th scope="col" class="col">Nome</th>
                  <th scope="col" class="col">Marca</th>
                  <th scope="col" class="col">Estoque</th>
                  <th scope="col" class="col">Preço</th>
                  <th scope="col" class="col">Gênero</th>
                  <th scope="col" class="col">Volume</th>
                  <th scope="col" class="col">Ações</th>
                </tr>
              </thead>
              <tbody';
    } else if ($tipo == 2) {
        return '  
        </tbody>  
        </table>
            <a href="../view/index.php" class="btn btn-dark">Voltar</a>
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
        return "<h4 class='sucesso'>Dados do perfume atualizados com sucesso!</h4><br><br>";
    } else if ($editar == "erro"){
        return "<h4 class='erro'>Erro! Não foi possível atualizar os dados do perfume!</h4><br><br>";
    }

    if ($excluir == "sucesso") {
        return "<h4 class='sucesso'>Perfume excluído com sucesso!</h4><br><br>";
    } else if ($excluir == "erro"){
        return "<h4 class='erro'>Erro! O perfume não foi excluído!</h4><br><br>";
    }

    if ($vinculo == "existe"){
        return "<h4 class='erro'>Erro! Esse perfume não pode ser excluído pois está vinculado a um fornecedor!</h4><br><br>";
    }
}

$pesquisa = $_POST["pesquisa"];
$perfumeControl = new PerfumeControl($db);
$resultados = $perfumeControl->pesquisar($pesquisa); //retorna os obejtos que posssui no nome ou na marca a string digitada pelo usuário

echo criaHeaderPagEditar();
echo criaMain(1);
echo imprimeMensagem();
foreach($resultados as $valor) {
    echo "<tr> <td>".$valor->getId()."</td>  <td>".$valor->getNome()."</td>  <td>".$valor->getMarca()."</td>  <td>".$valor->getEstoque()."</td>  <td>".$valor->getPreco()."</td>  <td>".$valor->getGenero()."</td>  <td>".$valor->getVolume()."</td>  <td><a href='perfumeLocalizar.php?id=".$valor->getId()."' class='btn btn-primary'>Editar</a> <a href='perfumeConfirmaExclusao.php?id=".$valor->getId()."' class='btn btn-danger'>Excluir</a></td></tr>"; //os botões excluir e editar enviam o id através da URL
}
echo criaMain(2);
echo criaFooter();
?>
