<?php
require_once "../control/site.config.php";
include "../control/FornecedorControl.class.php";
include "../control/ProdutoControl.class.php";
include "../control/PerfumeControl.class.php";
include "../control/SaboneteControl.class.php";

include "../model/Fornecedor.class.php";
include "../model/Perfume.class.php";
include "../model/Sabonete.class.php";
 
//adiciona os fornecedores em um vetor para listar no select
$fornecedorControl = new FornecedorControl($db);
$resultados = $fornecedorControl->listarObj(); 

//adiciona os produto não vinculados em um vetor para listar no select
$produtoControl = new ProdutoControl($db);
$resultadosProdutos = $produtoControl->listarProdNaoVinculados(); 

echo criaHeader();
?>
    <!-- Select com opções de produtos -->
   <section>
    <main class="container">
    <hr id="produto">
        <h2 class="mt-3">Cadastro de Produto</h2>

        <p class="mt-1">Selecione o produto que deseja cadastrar:</p>
        <div class="row">
            <div class="col-4">
                <select class="form-select" id="sltProduto" name="sltProduto">
                    <option value="perfume" selected>Perfume</option>
                    <option value="sabonete">Sabonete</option>
                </select>
            </div>
        </div>
        <?php //frases de erro e sucesso da página cadastrar perfume
            @$inputPerf = $_GET["inputPerf"];
            if ($inputPerf == "vazio") {
                echo "<h6 class='erro mt-4'>Nenhum campo pode ser deixado vazio!</h6>";
            }

            @$nome = $_GET["nome"];
            if ($nome == "existe") {
                echo "<h6 class='erro mt-4'>Erro! Esse perfume já está cadastrado!</h6>";
            }

            @$cadastrarPerf = $_GET["cadastrarPerf"];
            if ($cadastrarPerf == "erro") {
                echo "<h6 class='erro mt-4'>Erro! Não foi possível cadastrar o perfume!</h6>";
            } else if ($cadastrarPerf == "sucesso") {
                echo "<h6 class='sucesso mt-4'>Perfume cadastrado com sucesso!</h6>";
            }
    
    
            //frases de erro e sucesso da página cadastrar sabonete
            @$inputSabon = $_GET["inputSabon"];
            if ($inputSabon == "vazio") {
                echo "<h6 class='erro mt-4'>Nenhum campo pode ser deixado vazio!</h6>";
            }

            @$nomeSabon = $_GET["nomeSabon"];
            if ($nomeSabon == "existe") {
                echo "<h6 class='erro mt-4'>Erro! Esse sabonete já está cadastrado!</h6>";
            }

            @$cadastrarSabon = $_GET["cadastrarSabon"];
            if ($cadastrarSabon == "erro") {
                echo "<h6 class='erro mt-4'>Erro! Não foi possível cadastrar o sabonete!</h6>";
            } else if ($cadastrarSabon== "sucesso") {
                echo "<h6 class='sucesso mt-4'>Sabonete cadastrado com sucesso!</h6>";
            }
        ?>

        <!-- Cadastro de Perfumes -->
        <div id="divPerfume">
        <form class="form mt-3 mb-4" action="../acoes/perfumeCadastrar.php" method="POST">
            <div class="row">
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="inNome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="inNome" name="nome" placeholder="Nome do Perfume...">
                </div>
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="inMarca" class="form-label">Marca:</label>
                    <input type="text" class="form-control" id="inMarca" name="marca" placeholder="Marca do perfume...">
                </div>
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="inEstoque" class="form-label">Estoque:</label>
                    <input type="number" class="form-control" id="inEstoque"  name="estoque" placeholder="Quantidade em estoque...">
                </div>
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="inPreco" class="form-label">Preço:</label>
                    <input type="text" class="form-control" id="inPreco" name="preco" placeholder="Preço do perfume...">
                </div>
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="inGenero" class="form-label">Gênero:</label>
                    <select class="form-select" id="inGenero" name="genero">
                        <option selected disabled>Selecione uma opção</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Masculino">Masculino</option>
                    </select>
                </div>
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="inVolume" class="form-label">Volume:</label>
                    <input type="text" class="form-control" id="inVolume" name="volume" placeholder="Volume em ml...">
                </div>
            </div>
                <button type="submit" class="btn btn-primary" id="btSalvarPerfum">Cadastrar</button>
                <a href='../acoes/perfumeListar.php' class='btn btn-primary'>Listar</td></a>
            </div>
        </form>
        </div>

                
        <!-- Cadastro de Sabonetes -->
        <div id="divSabonete" style="display: none;">
        <form class="form mt-3 mb-4" action="../acoes/saboneteCadastrar.php" method="POST">
            <div class="row">
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="inNome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="inNome" name="nome" placeholder="Nome do Sabonete...">
                </div>
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="inMarca" class="form-label">Marca:</label>
                    <input type="text" class="form-control" id="inMarca" name="marca" placeholder="Marca do Sabonete...">
                </div>
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="inEstoque" class="form-label">Estoque:</label>
                    <input type="number" class="form-control" id="inEstoque" name="estoque" placeholder="Quantidade em estoque...">
                </div>
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="inPreco" class="form-label">Preço:</label>
                    <input type="text" class="form-control" id="inPreco" name="preco" placeholder="Preço do Sabonete...">
                </div>
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="inAroma" class="form-label">Aroma:</label>
                    <input type="text" class="form-control" id="inAroma" name="aroma" placeholder="Aroma do sabonete...">
                </div>
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="inPeso" class="form-label">Peso:</label>
                    <input type="text" class="form-control" id="inPeso" name="peso" placeholder="Peso em mg...">
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="btSalvarSabonete">Cadastrar</button>
            <a href='../acoes/saboneteListar.php' class='btn btn-primary'>Listar</td></a>
        </form>
        </div>

        <!-- Cadastro de Fornecedores -->
        <hr id="fornecedor" class="mb-4">
        <h2>Cadastro de Fornecedores</h2>
        <p class="mt-1">O CNPJ deve ter no mínimo 14 caracteres</p>

        <?php //frases de erro e sucesso da página cadastrar fornecedores
        @$cadastrar = $_GET["cadastrar"]; 
            if ($cadastrar == "sucesso") { //Verifica se o cadastro deu certo
                echo "<h6 class='sucesso'>Fornecedor cadastrado com sucesso!</h6>";
            } else if ($cadastrar == "erro"){
                echo "<h6 class='erro'>Erro! O fornecedor não foi cadastrado!</h6>";
            }
        @$input = $_GET["input"]; //verifica se todos os campos foram preenchidos
            if ($input == "vazio") {
                echo "<h6 class='erro'>Nenhum campo pode ser deixado vazio!</h6>";
            } 
        @$cnpj = $_GET["cnpj"]; //verifica se o CNPJ digitado já está cadastrado
            if ($cnpj == "existe") {
                echo "<h6 class='erro'>Erro! Esse CNPJ já está cadastrado!</h6>";
            } else if ($cnpj == "invalido") { //verifica se o CNPJ tem entre 14 e 18 caracteres
                echo "<h6 class='erro'>Digite o CNPJ corretamente!</h6>";
            }
        ?>

        <form class="form mt-2 mb-4" action="../acoes/fornecedorCadastrar.php" method="POST">
            <div class="row">
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="inCNPJ" class="form-label">CNPJ:</label>
                    <input type="text" class="form-control" id="inCNPJ" name="cnpj" placeholder="00.000.000/0000-00">
                </div>
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="inRazaoSoc" class="form-label">Razão Social:</label>
                    <input type="text" class="form-control" id="inRazaoSoc" name="razaoSocial" placeholder="Razão social do fornecedor...">
                </div>
                <div class="mb-3 col-md-6 col-lg-4">
                    <label for="inEndereco" class="form-label">Endereço:</label>
                    <input type="text" class="form-control" id="inEnderecob" name="endereco" placeholder="Endereco do fornecedor...">
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="btSalvarFornec">Cadastrar</button>
            <a href='../acoes/fornecedorListar.php' class='btn btn-primary'>Listar</td></a>
        </form>

        <!-- Vincular fornecedor e produto -->
        <hr id="vincular" class="mb-4">
        <h2>Vincular fornecedor e produto</h2>
        <?php 
        @$selects = $_GET["selects"];
        if ($selects == "vazios") { //Verifica se o fornecedor foi selecionado
            echo "<h6 class='erro mt-2'>Você precisa selecionar um fornecedor e um produto!</h6>";
        } 

        @$vinculo = $_GET["vinculo"]; 
            if ($vinculo == "sucesso") { //verifica se a vinculação funcionou
                echo "<h6 class='sucesso mt-2'>Fornecedor e produto vinculados com sucesso!</h6>";
            } else if ($vinculo == "erro") { //verifica se a vinculação deu erro
                echo "<h6 class='erro mt-2'>Erro! Não foi possível vincular o fornecedor e o produto!</h6>";
            }
        ?>

        <form class="form mt-3 mb-4" action="../acoes/relFornecedorProdutoVincular.php" method="POST">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="inCNPJ" class="form-label">Fornecedor:</label>

                    <select class="form-select" id="inFornecedor" name="fornecedor">
                        <option value = '' selected disabled>Selecione um fornecedor!</option>
                        <?php foreach($resultados as $valor) { //cria um select com todos os fornecedores
                            echo '<option value="'.$valor->getId().'">'.$valor->toString().'</option>';
                        }?> 
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="inProduto" class="form-label">Produto:</label>
                    <select class="form-select" id="inProduto" name="produto">
                        <option selected disabled>Selecione um produto!</option>
                        <?php   foreach($resultadosProdutos as $valor) { //cria um select com os produtos que não estão vinculados a nenhum fornecedor
                                echo '<option value="'.$valor->getId().'">'.$valor->toString().'</option>';
                                }
                        ?> 
                    </select>
                </div>

            </div>
            <button type="submit" class="btn btn-primary">Vincular</button>
            <a href='../acoes/relFornecedorProdutoListar.php' class='btn btn-primary'>Listar</td></a>
        </form>

        <!-- Filtro: Mostrar produtos de um fornecedor -->
        <hr id="filtro" class="mb-4">
        <h2>Mostrar produtos de um fornecedor</h2>

        <form class="form mt-3 mb-5" action="../acoes/mostrarProdutosFornecedores.php" method="POST">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <?php 
                        @$id = $_GET["id"]; //verifica se algum fornecedor foi selecionado
                            if ($id == "vazio") { 
                                echo "<h6 class='erro mt-1 mb-4'>Você precisa selecionar um fornecedor!</h6>";
                            } 
                    ?>
                    <label class="form-label">Fornecedor:</label>
                    <div class="input-group">
                    <select class="form-select" id="inFornecedor" name="fornecedor">
                        <option selected disabled>Selecione um fornecedor!</option>
                        <?php foreach($resultados as $valor) { //cria um select com todos os fornecedores
                            echo '<option value="'.$valor->getId().'">'.$valor->toString().'</option>';
                        }?> 
                    </select>

                        <div class="col-1"><button type="submit" class="btn btn-primary" id="btMostar">Mostrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
    </section>

    <footer>
        <h4 class="d-flex justify-content-center"><i class="bi-whatsapp"></i> (27) 99650-2786</h4>
        <img src="../imagens/logoFooter.png" class="logo img-fluid" alt="Logo da empresa">
        <img src="../imagens/icones.png" class="icone img-fluid" alt="Icones de telefone e email">
    </footer>

   <script type="module" src="../front-end/select.config.js"></script>
</body>
</html>