<?php
require_once "../control/site.config.php";
include "../control/FornecedorControl.class.php"; 
include "../model/Fornecedor.class.php";

$fornecedorControl = new FornecedorControl($db);

$id = @$_GET['id'];
if ($id != "") {
    $obj = $fornecedorControl->buscarPorId($id); //retorna o objeto com o id enviado pela URL
}

echo criaHeaderPagEditar();
?>

<!-- cria um formulário de edição com os valores que estão salvos -->
    <main class="container">
    <h2 class="mt-5">Editar Fornecedor</h2>
    <!-- envia os dados para o arquivo que irá editar -->
    <form class="form mt-3" action="fornecedorEditar.php" method="post">
        <div class="row">
        <!--Input para ID-->
            <div class="mb-3 col">
                <label for="id" class="form-label">#ID:</label>
                <input type="text" name="id_" disabled class="form-control" value="<?php echo $obj->getId()?>">
                <input type="hidden" name="id" class="form-control" value="<?php echo $obj->getId()?>">
            </div>
            <div class="mb-3 col-xl-3 col-md-5">
                <label for="CNPJ" class="form-label">CNPJ:</label>
                <input type="text" class="form-control" name="CNPJ" value='<?php echo $obj->getCNPJ()?>'>
                <input type="hidden" class="form-control" name="CNPJantigo" value='<?php echo $obj->getCNPJ()?>'>
            </div>
            <div class="mb-3 col-xl-3 col-md-5">
                <label for="razaoSoc" class="form-label">Razão Social:</label>
                <input type="text" class="form-control" name="razaoSocial" value='<?php echo $obj->getRazaoSocial()?>' placeholder="Razão social do fornecedor...">
            </div>
            <div class="mb-3 col-xl-3 col-md-5">
                <label for="endereco" class="form-label">Endereço:</label>
                <input type="text" class="form-control" name="endereco" value='<?php echo $obj->getEndereco()?>' placeholder="Endereco do fornecedor...">
            </div>
            <div class="mb-3 col-xl-1 col-sm-2 d-flex mt-4" style="flex-direction: column">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            <div class="mb-3 col-xl-1 col-sm-2 d-flex mt-4" style="flex-direction: column">
                <a href="fornecedorListar.php" class="btn btn-dark">Voltar</td></a>
            </div>
        </div>

    </form>
    </main>
<?php echo criaFooter(); ?>