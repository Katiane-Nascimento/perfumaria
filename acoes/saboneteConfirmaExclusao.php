<?php 
    require_once "../control/site.config.php";
    echo criaHeaderPagEditar(); 
?>

<main class="container d-flex justify-content-center align-items-center">
        <form class="rounded-5 d-flex flex-column justify-content-center border border-secondary confirmaExlusao">
            <h3>Excluir Sabonete</h3>
            <p>Deseja realmente excluir esse <strong>Sabonete</strong>?</p>
            <div class="botoes">
                <a class="btn btn-success px-4" href="saboneteListar.php">Cancelar</a>
                <a class="btn btn-danger px-4" href="saboneteExcluir.php?id=<?php echo $_GET["id"]; ?>">Excluir</a>
            </div>
        <form>
</main>

<?php echo criaFooter(); ?>