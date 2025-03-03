<?php

class RelFornecedorProdutoControl {
    private $conexao;
    private $produtos;
    private $fornecedor;

    function __construct($conexao) {
        $this->conexao = $conexao;
        $produtos = array(); 
        $fornecedor = new Fornecedor();
    }

    //lista os produtos de um determinado fornecedor
    public function listarProdutos($fornecedor) {
        $sql = "SELECT * FROM `relfornecedorproduto` WHERE `idFornecedor` = '".$fornecedor->getId()."'";
        $result = $this->conexao->query($sql);  //seleciona as linha da tabela relfornecedorproduto onde o id fornecedor é igual ao selecioando pelo usuário
        $produtos = array();
        $perfumeControl = new PerfumeControl($this->conexao);
        $saboneteControl = new SaboneteControl($this->conexao);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $perfume = $perfumeControl->buscarPorId($row["idProduto"]); //verifica se o produto é um perfume, caso seja retorna o objeto
                $sabonete = $saboneteControl->buscarPorId($row["idProduto"]);  //verifica se o produto é um sabonete, caso seja retorna o objeto

                if ($perfume == null) {
                    $sabonete->setId($row["idProduto"]); //se $perfume retornar null é porque o produto é um sabonete
                    $produtos[] = $sabonete;
                } else {
                    $perfume->setId($row["idProduto"]);//se não é porque o produto é um perfume
                    $produtos[] = $perfume;
                }                          
            }
        }
        return $produtos;
    }

    public function listar() {
        $sql = "SELECT * FROM relfornecedorproduto";
        $result = $this->conexao->query($sql);

        $fornecedores = array();

        $controlFornecedor = new FornecedorControl($this->conexao);
        $perfumeControl = new PerfumeControl($this->conexao);
        $saboneteControl = new SaboneteControl($this->conexao);       

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $idFornecedor = $row["idFornecedor"]; 
                $idProduto = $row["idProduto"];

                $fornecedor = $controlFornecedor->buscarPorId($idFornecedor); //cria um objeto fornecedor de cada linha da tabela
                $perfume = $perfumeControl->buscarPorId($idProduto);
                $sabonete = $saboneteControl->buscarPorId($idProduto); 

                if ($perfume == null) {
                    $sabonete->setId($idProduto ); //adiciona no objeto o id encontrado
                    $produto = $sabonete;
                } else {
                    $perfume->setId($idProduto); //adiciona no objeto o id encontrado
                    $produto = $perfume;
                } 
                
                $fornecedores[] = array($fornecedor, $produto); //em cada posição do vetor adiciona um objeto fornecedor e um objeto produto 
            }
        }
        return $fornecedores;
    }

    public function cadastrar($fornecedor, $produto) {    //recebe o id do fornecedor e do produto
        $sql = "INSERT INTO `relfornecedorproduto` (`idFornecedor`, `idProduto`) VALUES ('".$fornecedor."', '".$produto."');"; //adiciona os ids na tabela relfornecedorproduto

        $result = $this->conexao->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deletar($fornecedor, $produto) {  //recebe o id do fornecedor e do produto           
        $sql = "DELETE FROM `relfornecedorproduto` WHERE `idFornecedor` = ".$fornecedor->getId()." AND `idProduto` = ".$produto->getId().""; //exclui a linha que possui o id do fornecedor e do produto recebido como parâmetro

        $result = $this->conexao->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //recebe os objetos e atualiza a tabela relfornecedorproduto
    public function atualizar($fornecedor, $produto_antigo, $produto_novo) {      
        $sql = "UPDATE `relfornecedorproduto` SET `idFornecedor`='".$fornecedor->getId()."',`idProduto`='".$produto_novo->getId()."' WHERE idFornecedor = '".$fornecedor->getId()."' AND idProduto = '".$produto_antigo->getId()."'"; //atualiza a linha que possui o id fornecedor e o id do produto antigo

        $result = $this->conexao->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }    

    //filtra por marca
    public function pesquisar($pesquisa) {
        $sql = "SELECT * FROM relfornecedorproduto r JOIN produtos p ON p.id = r.idProduto WHERE p.nome LIKE '%$pesquisa%'"; //seleciona as linhas da tabela relfornecedorproduto onde o idProduto pertence a tabela produto e a string digitada pelo usuário está presente na marca do produto

        $result = $this->conexao->query($sql);

        $fornecedores = array();

        $controlFornecedor = new FornecedorControl($this->conexao);
        $perfumeControl = new PerfumeControl($this->conexao);
        $saboneteControl = new SaboneteControl($this->conexao);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $idFornecedor = $row["idFornecedor"];

                $perfume = $perfumeControl->buscarPorId($idProduto); //verifica se o produto é um perfume, caso seja retorna o objeto
                $sabonete = $saboneteControl->buscarPorId($idProduto);  //verifica se o produto é um sabonete, caso seja retorna o objeto
                $fornecedor = $controlFornecedor->buscarPorId($idFornecedor); //cria um objeto fornecedor de cada linha da tabela
                
                if ($perfume == null) {
                    $sabonete->setId($row["id"]); //se $perfume retornar null é porque o produto é um sabonete
                    $produto = $sabonete;
                } else {
                    $perfume->setId($row["id"]);//se não é porque o produto é um perfume
                    $produto = $perfume;
                }

                $fornecedores[] = array($fornecedor, $produto); //em cada posição do vetor adiciona um objeto fornecedor e um objeto produto 
            }
        }
        return $fornecedores;
    }

    // //verifica se o fornecedor e o produto já estão vinculados
    // public function verificaVinculacao($fornecedor, $produto) {
    //     $sql = "SELECT * FROM `relfornecedorproduto` WHERE `idFornecedor` = '$fornecedor' AND `idProduto` = '$produto'";  

    //     $result = $this->conexao->query($sql);

    //     if ($result->num_rows > 0) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // //verifica se um produto já está vinculado a um fornecedor
    // public function verificaVinculacaoProduto($produto) {
    //     $sql = "SELECT * FROM `relfornecedorproduto` WHERE `idProduto` = '$produto'";  

    //     $result = $this->conexao->query($sql);

    //     if ($result->num_rows > 0) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
?>