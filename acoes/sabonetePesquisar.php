<?php
require_once "../control/site.config.php";
include "../control/SaboneteControl.class.php";
include "../model/Sabonete.class.php";

function criaMain($tipo) {
    if ($tipo == 1) {
        return '<main>
            <div class="container" style="display: flex; flex-direction: column; align-items: center;">
            <br>
            <nav class="navbar">
                <div class="container-fluid">
                    <form class="d-flex" action="sabonetePesquisar.php" method="POST">
                        <input class="form-control me-2 border-dark" type="search" placeholder="Nome ou Marca" name="pesquisa">
                        <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </nav>
            <br>
                <table class="table table-striped table-hover table-bordered border-dark table" style="width: 60vw;">
                <thead class="table-dark">
                <tr><th class="table-dark text-center" colspan="8">SABONETES</th></tr>
                <tr>
                  <th scope="col" class="col-1">#</th>
                  <th scope="col" class="col">Nome</th>
                  <th scope="col" class="col">Marca</th>
                  <th scope="col" class="col">Estoque</th>
                  <th scope="col" class="col">Preço</th>
                  <th scope="col" class="col">Aroma</th>
                  <th scope="col" class="col">Peso</th>
                  <th scope="col" class="col">Ações</th>
                </tr>
              </thead>
              <tbody';
    } else if ($tipo == 2) {
        return '  
        </tbody>  
        </table>
            <a href="../view/index.php#produto" class="btn btn-dark">Voltar</a>
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
        return "<h4 class='sucesso'>Dados do sabonete atualizados com sucesso!</h4><br><br>";
    } else if ($editar == "erro"){
        return "<h4 class='erro'>Erro! Não foi possível atualizar os dados do sabonete!</h4><br><br>";
    }

    if ($excluir == "sucesso") {
        return "<h4 class='sucesso'>Sabonete excluído com sucesso!</h4><br><br>";
    } else if ($excluir == "erro"){
        return "<h4 class='erro'>Erro! O sabonete não foi excluído!</h4><br><br>";
    }

    if ($vinculo == "existe"){
        return "<h4 class='erro'>Erro! Esse sabonete não pode ser excluído pois está vinculado a um fornecedor!</h4><br><br>";
    }
}

$pesquisa = $_POST["pesquisa"];
$saboneteControl = new SaboneteControl($db);
$resultados = $saboneteControl->pesquisar($pesquisa); //retorna os obejtos que posssui no nome ou na marca a string digitada pelo usuário

echo criaHeaderPagEditar();
echo criaMain(1);
echo imprimeMensagem();
foreach($resultados as $valor) {
    echo "<tr> <td>".$valor->getId()."</td>  <td>".$valor->getNome()."</td>  <td>".$valor->getMarca()."</td>  <td>".$valor->getEstoque()."</td>  <td>".$valor->getPreco()."</td>  <td>".$valor->getAroma()."</td>  <td>".$valor->getPeso()."</td>  <td><a href='saboneteLocalizar.php?id=".$valor->getId()."' class='btn btn-primary'>Editar</a> <a href='saboneteConfirmaExclusao.php?id=".$valor->getId()."' class='btn btn-danger'>Excluir</a></td></tr>"; //os botões excluir e editar enviam o id através da URL
}
echo criaMain(2);
echo criaFooter();
?>
