<?php

class SaboneteControl {
    private $conexao;
    private $sabonete;

    function __construct($conexao) {
        $this->conexao = $conexao;
        $sabonete = new Sabonete();
    }

    public function cadastrar($id, $obj) {        
        $sql = "INSERT INTO `sabonetes` (`aroma`, `peso`, `produtoFK`)
        VALUES ('".$obj->getAroma()."', '".$obj->getPeso()."', '".$id."')"; //adiciona os dados na tabela

        $result = $this->conexao->query($sql); //faz a conexão e a consulta no banco de dados

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function listarObj() {
        $sql = "SELECT * FROM produtos p JOIN sabonetes s ON p.id = s.produtoFK"; //retorna as linhas onde o id da tabela produtos está presente na tabela sabonetes
        $result = $this->conexao->query($sql); //faz a conexão e a consulta no banco de dados

        $sabonetes = array();

        if ($result->num_rows > 0) { //se existir pelo menos uma linha na tabela o while será executado
            while ($row = $result->fetch_assoc()) { // é usado para obter cada linha como um array associativo
                $sabonete=  new Sabonete ($row["nome"], $row["marca"], $row["estoque"], $row["preco"], $row["aroma"], $row["peso"]); //transforma cada linha da tabela em um objeto
                $sabonete->setId($row["produtoFK"]); //adiciona no objeto o id encontrado

                $sabonetes[] = $sabonete;
            }
        }
        return $sabonetes;
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM produtos p JOIN sabonetes s ON p.id = s.produtoFK WHERE p.id=$id"; //seleciona a linha da tabela sabonetes com o id informado
        $result = $this->conexao->query($sql); //faz a conexão e a consulta no banco de dados

        if ($result->num_rows > 0) { //se existir alguma linha com o id informado...
            $row = $result->fetch_assoc(); //transforma os resultados em um array associativo
            $sabonete = new Sabonete($row["nome"], $row["marca"], $row["estoque"], $row["preco"], $row["aroma"], $row["peso"]); //cria um objeto com os dados
            $sabonete->setId($row["produtoFK"]); //adiciona o id no objeto
            return $sabonete;
        } else {
            return null;
        }
    }

    public function deletar($obj) {        
        $sql = "DELETE FROM `sabonetes` WHERE `produtoFK` = ".$obj->getId().""; //deleta os dados na linha que possui o id recebido como parâmetro
        $result = $this->conexao->query($sql);  //faz a conexão e a consulta no banco de dados
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    public function atualizar($obj) {        
        $sqlProdutos = "UPDATE produtos SET nome='".$obj->getNome()."', marca='".$obj->getMarca()."', estoque='".$obj->getEstoque()."', preco='".$obj->getPreco()."' WHERE id='".$obj->getId()."'"; 
        $sqlSabonetes = "UPDATE sabonetes SET aroma='".$obj->getAroma()."', peso='".$obj->getPeso()."' WHERE produtoFK='".$obj->getId()."'"; //atualiza os dados na linha que possui o id recebido como parâmetro

        $resultProdutos = $this->conexao->query($sqlProdutos); //faz a conexão e a atualização no banco de dados
        $resultSabonetes = $this->conexao->query($sqlSabonetes);

        if ($resultProdutos && $resultSabonetes) {
            return true; //se a atualização funcionar retorna true
        } else {
            return false;
        }
    }

   //seleciona todas as linhas que pertencem a tabela sabonetes, onde o nome ou a marca possui a string pesquisada
    public function pesquisar($pesquisa) {
        $sql = "SELECT * FROM produtos p JOIN sabonetes s ON p.id = s.produtoFK WHERE p.nome LIKE '%$pesquisa%' OR  p.marca LIKE '%$pesquisa%'"; 
        $result = $this->conexao->query($sql); //faz a conexão e a consulta no banco de dados

        $sabonetes = array();

        if ($result->num_rows > 0) { //se existir pelo menos uma linha na tabela o while será executado
            while ($row = $result->fetch_assoc()) { // é usado para obter cada linha como um array associativo
                $sabonete=  new Sabonete ($row["nome"], $row["marca"], $row["estoque"], $row["preco"], $row["aroma"], $row["peso"]); //transforma cada linha da tabela em um objeto
                $sabonete->setId($row["produtoFK"]); //adiciona no objeto o id encontrado

                $sabonetes[] = $sabonete;
            }
        }
        return $sabonetes;
    }
}
?>


