<?php
require_once "../control/site.config.php";
include "../control/PerfumeControl.class.php";
include "../model/Perfume.class.php";

$perfumeControl = new PerfumeControl($db);

$id = @$_GET['id'];
if ($id != "") {
    $obj = $perfumeControl->buscarPorId($id); //retorna o objeto com o id enviado pela URL
}

echo criaHeaderPagEditar();
?>

<!-- cria um formulário de edição com os valores que estão salvos -->
    <main class="container">
    <h2 class="mt-5">Editar Perfume</h2>
    <!-- envia os dados para o arquivo que irá editar -->
    <form class="form mt-3 mb-5" action="perfumeEditar.php" method="POST">
        <div class="row">
            <div class="mb-3 col">
                <label for="id" class="form-label">#ID:</label>
                <input type="text" name="id_" disabled class="form-control" value="<?php echo $obj->getId()?>">
                <input type="hidden" name="id" class="form-control" value="<?php echo $obj->getId()?>">
            </div>
            <div class="mb-3 col-xl-3 col-md-5">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="inNome" name="nome" value="<?php echo $obj->getNome()?>">
                    <input type="hidden" class="form-control" id="inNome" name="nomeAntigo" value="<?php echo $obj->getNome()?>">
                </div>
            <div class="mb-3 col-xl-3 col-md-5">
                    <label for="marca" class="form-label">Marca:</label>
                    <input type="text" class="form-control" id="inMarca" name="marca" value="<?php echo $obj->getMarca()?>">
                </div>
            <div class="mb-3 col-xl-3 col-md-5">
                    <label for="estoque" class="form-label">Estoque:</label>
                    <input type="number" class="form-control" id="inEstoque"  name="estoque" value="<?php echo $obj->getEstoque()?>">
                </div>
            <div class="mb-3 col-xl-3 col-md-5">
                    <label for="preco" class="form-label">Preço:</label>
                    <input type="text" class="form-control" id="inPreco" name="preco" value="<?php echo $obj->getPreco()?>">
                </div>
            <div class="mb-3 col-xl-3 col-md-5">
                <label for="genero" class="form-label">Gênero:</label>
                    <select class="form-select" id="inGenero" name="genero">
                        <option disabled>Selecione uma opção</option>
                        <!--verifica a opção selecionada pelo usuário-->
                        <option value="Feminino" <?php if ($obj->getGenero() === 'Feminino') echo 'selected'; ?>>Feminino</option>
                        <option value="Masculino" <?php if ($obj->getGenero() === 'Masculino') echo 'selected'; ?>>Masculino</option>
                    </select> 
                </div> 
            <div class="mb-3 col-xl-3 col-md-5">
                    <label for="volume" class="form-label">Volume:</label>
                    <input type="text" class="form-control" id="inVolume" name="volume" value="<?php echo $obj->getVolume()?>">
                </div>
            <div class="mb-3 col-xl-1 col-sm-2 d-flex mt-4" style="flex-direction: column">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            <div class="mb-3 col-xl-1 col-sm-2 d-flex mt-4" style="flex-direction: column">
                <a href="PerfumeListar.php" class="btn btn-dark">Voltar</td></a>
            </div>
        </form>
    </main>
<?php echo criaFooter(); ?>