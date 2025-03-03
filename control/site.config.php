<?php
    require_once "../model/Database.class.php";
    $db = new Database("localhost", "root", "", "perfumaria");  //servidor, usuário, senha e base de dados

    //header da págian index.php
    function criaHeader() {
        return '<!DOCTYPE html>
        <html lang="pt-br">
        
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>PERFUMARIA :: Gerenciamento</title>
            <!-- link bootstrap -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"
                defer>
            <!-- icones do bootstrap -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
            <link rel="stylesheet" href="../front-end/style.css">
            <link rel="icon" type="../imagens/imagem/png" href="icone.png"/>
        </head>
        
        <body>
            <header>
                <img src="../imagens/logo.png" alt="Logo da empresa">
                <nav>
                    <a href="home.php" class="link">HOME</a>
                    <a href="#" style="color: #BB5E5E; border-bottom: 3px solid #BB5E5E;" class="link">GERENCIAMENTO</a>
                </nav>
            </header>
            <div class="imagem">
                <h1>Gerenciamento para Perfumaria</h1>
            </div>';
    }

    //header de todas as páginas de editar e localizar
    function criaHeaderPagEditar() {
        return '<!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Perfumaria</title>
            <!-- link bootstrap -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"
                defer>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
            <link rel="stylesheet" href="../front-end/style.css">
            <link rel="icon" type="imagem/png" href="icone.png"/>
        </head> 
        <body>
            
        <div class="flex-container">
            <header>
                <img src="../imagens/logo.png" alt="Logo da empresa">
                <nav>
                    <a href="../view/home.php" class="link">HOME</a>
                    <a href="#" style="color: #BB5E5E; border-bottom: 3px solid #BB5E5E;" class="link">GERENCIAMENTO</a>
                </nav>
            </header>
            <div class="imagem">
                <h1>Gerenciamento para Perfumaria</h1>
            </div>';
    }

    //footer de todas as páginas de editar e localizar
    function criaFooter() {
        return '<footer>
            <h4 class="d-flex justify-content-center"><i class="bi-whatsapp"></i> (27) 99650-2786</h4>
            <img src="../imagens/logoFooter.png" class="logo img-fluid" alt="Logo da empresa">
            <img src="../imagens/icones.png" class="icone img-fluid" alt="Icones de telefone e email">
            </footer>
            </div>
        </body>
        </html>';
    }

    // function criaFooterPagEditar() {
    //     return '<footer>
    //         <h4 class="d-flex justify-content-center"><i class="bi-whatsapp"></i> (27) 99650-2786</h4>
    //         <img src="../imagens/logoFooter.png" class="logo img-fluid" alt="Logo da empresa">
    //         <img src="../imagens/icones.png" class="icone img-fluid" alt="Icones de telefone e email">
    //         </footer>
    //     </div>
    //     </body>
    //     </html>';
    // }
?>