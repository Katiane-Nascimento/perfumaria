<?php 
    require_once "../control/site.config.php";
    echo criaHeaderPagEditar(); 
?>

<main class="container d-flex justify-content-center align-items-center">
        <form class="rounded-5 d-flex flex-column justify-content-center border border-secondary confirmaExlusao">
            <h3>Excluir vínculo entre Fornecedor e Produto</h3>
            <p>Deseja realmente excluir o vínculo entre esse <strong>Fornecedor</strong> e esse <strong>Produto?</strong></p>
            <div class="botoes">
                <a class="btn btn-success px-4" href="relFornecedorProdutoListar.php">Cancelar</a>
                <a class="btn btn-danger px-4" href="relFornecedorProdutoExcluir.php?id=<?php echo $_GET["id"]; ?>">Excluir</a>
            </div>
        <form>
</main>

<?php echo criaFooter(); ?>