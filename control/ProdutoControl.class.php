<?php

class ProdutoControl {
    private $conexao;
    private $produto;

    function __construct($conexao) {
        $this->conexao = $conexao;
        $produto = new Produto();
    }


    //cadastra um produto
    public function cadastrar($obj) {        
        $sql = "INSERT INTO produtos (nome, marca, estoque, preco) 
        VALUES ('".$obj->getNome()."', '".$obj->getMarca()."', '".$obj->getEstoque()."', '".$obj->getPreco()."')"; 

        $result = $this->conexao->query($sql); //faz a conexão e a consulta no banco de dados
        print_r($result);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //busca o id através do nome (Na hora de cadastrar um perfume ou sabonete, cadastro primeiro o produto,e uso essa função para buscar o id e adicionar na coluan produtoFK da tabela perfume ou sabonete)
    public function buscarId($nome) {
        $sql = "SELECT id FROM produtos WHERE nome = '".$nome."'";

        $result = $this->conexao->query($sql); //faz a conexão e a consulta no banco de dados

        $row = $result->fetch_assoc();

        return $row["id"];
    }

    //exclui um produto
    public function deletarProduto($obj) {        
        $sql = "DELETE FROM `produtos` WHERE `id` = ".$obj->getId()."";
        //deleta os dados na linha que possui o id recebido como parâmetro
    
        $result = $this->conexao->query($sql);  //faz a conexão e a consulta no banco de dados
    
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    

    //verifica se um produto já está cadastrado
    public function verificaNome($nome) {
        $sql = "SELECT * FROM produtos WHERE nome = '$nome'";

        $result = $this->conexao->query($sql); //faz a conexão e a consulta no banco de dados

        if ($result->num_rows > 0) {
            return false;
        } else {
            return true;
        }
    }

    
    // verifica se o produto está vinculado a algum fornecedor. Foi usada para impedir que um produto vinculado a um fornecedor, seja excluído
    public function verificaVinculacao($id) {
        $sql = "SELECT * FROM relfornecedorproduto WHERE idProduto = '$id'"; 

        $result = $this->conexao->query($sql);  //faz a conexão e a consulta no banco de dados

        if ($result->num_rows > 0) { //retorna verdadeira se existir um ou mais registros
            return true;
        } else {
            return false;
        }
    } 

    //lista os produtos que não estão vinculados a nenhum fornecedor, foi usado para criar um select no index.php
    public function listarProdNaoVinculados() {
        $sql = "SELECT * FROM produtos WHERE id NOT IN (SELECT idProduto FROM relfornecedorproduto)"; //seleciona todos os produtos que não estão na tabela relFornecedorProduto

        $result = $this->conexao->query($sql);  //faz a conexão e a consulta no banco de dados

        $produtos = array();

        $perfumeControl = new PerfumeControl($this->conexao);
        $saboneteControl = new SaboneteControl($this->conexao);

        if ($result->num_rows > 0) { //se existir pelo menos uma linha na tabela o while será executado
            while ($row = $result->fetch_assoc()) { // é usado para obter cada linha como um array associativo
                $perfume = $perfumeControl->buscarPorId($row["id"]); //verifica se o produto é um perfume, caso seja retorna o objeto
                $sabonete = $saboneteControl->buscarPorId($row["id"]);  //verifica se o produto é um sabonete, caso seja retorna o objeto

                if ($perfume == null) {
                    $sabonete->setId($row["id"]); //se $perfume retornar null é porque o produto é um sabonete
                    $produtos[] = $sabonete;
                } else {
                    $perfume->setId($row["id"]);//se não é porque o produto é um perfume
                    $produtos[] = $perfume;
                }
            }
        }
        return $produtos;
    } 

    //Foi usada na função excluir e editar vínculo, para mostrar o id que deve ser inderido na tabela relfornecedorproduto
    public function buscarPorId($id) {
        $sql = "SELECT * FROM produtos WHERE id = $id"; //seleciona a linha da tabela produto com o id informado
        $result = $this->conexao->query($sql);  //faz a conexão e a consulta no banco de dados

        if ($result->num_rows > 0) { //se existir alguma linha com o id informado...

            $row = $result->fetch_assoc(); //transforma os resultados em um array associativo

            $produto = new Produto($row["nome"], $row["marca"], $row["estoque"], $row["preco"]); //cria um objeto com os dados

            $produto->setId($row["id"]); //adiciona o id no objeto

            return $produto;
        } else {
            echo "Nao encontrou o id: ". $id;
            return null;
        }
    }


    //--------------------------------------
    // //usado para criar o select no index.php
    // public function listarProdutos(){
    //     $sql = "SELECT * FROM produtos"; 
    //     $result = $this->conexao->query($sql); //faz a conexão e a consulta no banco de dados

    //     $produtos = array();

    //     if ($result->num_rows > 0) { //se existir pelo menos uma linha na tabela o while será executado
    //         while ($row = $result->fetch_assoc()) { // é usado para obter cada linha como um array associativo
    //             $produto=  new Produto ($row["nome"], $row["marca"], $row["estoque"], $row["preco"]); //transforma cada linha da tabela em um objeto
    //             $produto->setId($row["id"]); //adiciona no objeto o id encontrado

    //             $produtos[] = $produto;
    //         }
    //     }
    //     return $produtos;
    // }
}

?>


