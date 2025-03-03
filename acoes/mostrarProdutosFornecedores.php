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
            <br><br>
                <table class="table table-striped table-hover table-bordered border-dark table" style="width: 40vw;">
                <thead class="table-dark">
                <tr><th class="table-dark text-center" colspan="5">PRODUTOS DO FORNECEDOR</th></tr>
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

$idFornecedor = $_POST["fornecedor"];
    if ($idFornecedor == '') { //verifica se algum fornecedor foi selecionado
        header("location: ../view/index.php?id=vazio#vincular");
    } else {
        echo criaHeaderPagEditar();
        echo criaMain(1);
        $fornecedorControl = new FornecedorControl($db);
        $fornecedor = $fornecedorControl->buscarPorId($idFornecedor); //retorna o objeto fornecedor selecionado
        $relfornecedorproduto = new RelFornecedorProdutoControl($db);
        $resultados = $relfornecedorproduto->listarProdutos($fornecedor); //cria um vetor com os objetos vinculados a esse fornecedor
        
        echo "<h1 class='mb-4 fw-bold text-primary'>FORNECEDOR: ".$fornecedor->mostrarFornecedor()."</h1>";

        foreach($resultados as $valor) {
            echo "<tr> <td>".$valor->toString()."</td> </tr>"; //os botões excluir e editar enviam o id através da URL
        }
        
        echo criaMain(2);
        echo criaFooter();
    }
?>
