<?php
require_once "../control/site.config.php";
include "../control/RelFornecedorProdutoControl.class.php";
include "../control/FornecedorControl.class.php";
include "../control/ProdutoControl.class.php";
include "../control/PerfumeControl.class.php";
include "../control/SaboneteControl.class.php";

include "../model/Fornecedor.class.php";
include "../model/Produto.class.php";
include "../model/Perfume.class.php";
include "../model/Sabonete.class.php";

$fornecedorControl = new FornecedorControl($db);
$perfumeControl = new PerfumeControl($db);
$saboneteControl = new SaboneteControl($db);
$produtoControl = new ProdutoControl($db);
$relFornecedorProduto = new RelFornecedorProdutoControl($db);

$resultadosProdutos = $produtoControl->listarProdNaoVinculados(); //lista os produtos não vinculados para adicionar no formulário de edição

$id = @$_GET['id'];
if ($id != "") {
    $idFornecedor = $fornecedorControl->buscarIdFornecedor($id); //busca o id do fornecedor usando o id do produto
    $objFornecedor = $fornecedorControl->buscarPorId($idFornecedor); //retorna o objeto fornecedor
    $objPerfume = $perfumeControl->buscarPorId($id); //retorna o objeto perfume ou null
    $objSabonete = $saboneteControl->buscarPorId($id); //retorna o objeto sabonete ou null

    if ($objPerfume == null) { //verifica se o objeto qeu está vinculado ao fornecedor é um perfume ou sabonete
        $objProduto = $objSabonete; //se for sabonete cria um objeto sabonete
    } else {
        $objProduto = $objPerfume; //se for perfume cria um objeto perfume
    }
}
echo criaHeaderPagEditar();
?>

<!-- cria um formulário de edição com os valores que estão salvos -->
    <main class="container">
    <h2 class="mt-5">Editar Vínculo entre fornecedor e produto</h2>
    <!-- envia os dados para o arquivo que irá editar -->
    <form class="form mt-3 mb-5" action="relFornecedorProdutoEditar.php" method="POST">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="inCNPJ" class="form-label">Fornecedor:</label>
                    <select class="form-select" id="inFornecedor" name="fornecedor">
                        <option value="<?php echo $objFornecedor->getId()?>" selected> <?php echo $objFornecedor->toString()?> </option>
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="inProduto" class="form-label">Produto:</label>
                    <select class="form-select" id="inProduto" name="produto">

                    <!-- mostra o produto antigo que está no banco de dados-->
                    <option value="<?php echo $objProduto->getId();?>" selected> <?php echo $objProduto->toString()?> </option>

                        <!-- mostra os produtos que não estão vinculados ainda -->
                        <?php foreach ($resultadosProdutos as $valor) {
                                echo '<option value="'.$valor->getId().'">'.$valor->toString().'</option>';
                               }
                        ?>

                        <!-- <?php foreach ($resultadosProdutos as $valor) : ?>
                            <option value="<?php echo $valor->getId(); ?>" <?php echo ($valor->getId() == $objProduto->getId()) ? 'selected' : ''; ?>>
                                <?php echo $valor->toString(); ?>
                            </option>
                        <?php endforeach; ?> -->

                    </select>
                </div> 

                <div> 
                    <!-- foi usado para guardar o id do produto antigo que está no banco de dados-->
                    <input type="hidden" name="produtoAntigo" value="<?php echo $objProduto->getId()?>">
                </div>

            </div>
            <div style="display: flex; justify-content: end; gap: 1vw;">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href='relFornecedorProdutoListar.php' class='btn btn-dark'>Voltar</td></a>
            </div>
        </form>
    </main>
<?php echo criaFooter(); ?>