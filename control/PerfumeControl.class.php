<?php

class perfumeControl {
    private $conexao;
    private $perfume;

    function __construct($conexao) {
        $this->conexao = $conexao;
        $perfume = new Perfume();
    }

    public function cadastrar($id, $obj) {        
        $sql = "INSERT INTO `perfumes` (`genero`, `volume`, `produtoFK`)
        VALUES ('".$obj->getGenero()."', '".$obj->getVolume()."', '".$id."')"; //adicona os dados na tabela perfumes

        $result = $this->conexao->query($sql); //faz a conexão e a consulta no banco de dados

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function listarObj() {
        $sql = "SELECT * FROM produtos pr JOIN perfumes p ON pr.id = p.produtoFK"; //seleciona todas as linhas onde o id da tabela produtos é igual ao produtoFK da tabela perfumes
        $result = $this->conexao->query($sql); //faz a conexão e a consulta no banco de dados

        $perfumes = array();

        if ($result->num_rows > 0) { //se existir pelo menos uma linha na tabela o while será executado
            while ($row = $result->fetch_assoc()) { // é usado para obter cada linha como um array associativo
                $perfume=  new Perfume ($row["nome"], $row["marca"], $row["estoque"], $row["preco"], $row["genero"], $row["volume"]); //transforma cada linha da tabela em um objeto
                $perfume->setId($row["produtoFK"]); //adiciona no objeto o id encontrado

                $perfumes[] = $perfume;
            }
        }
        return $perfumes;
    }

    //usado para listar excluir o perfume e para listar no html
    public function buscarPorId($id) {
        $sql = "SELECT * FROM produtos pr JOIN perfumes p ON pr.id = p.produtoFK WHERE pr.id=$id"; //seleciona a linha da tabela perfumes com o id informado
        $result = $this->conexao->query($sql);  //faz a conexão e a consulta no banco de dados

        if ($result->num_rows > 0) { //se existir alguma linha com o id informado...
            $row = $result->fetch_assoc(); //transforma os resultados em um array associativo
            $perfume = new Perfume($row["nome"], $row["marca"], $row["estoque"], $row["preco"], $row["genero"], $row["volume"]); //cria um objeto com os dados
            $perfume->setId($row["produtoFK"]); //adiciona o id no objeto
            return $perfume;
        } else {
            return null;
        }
    }


    public function deletar($obj) {        
        $sql = "DELETE FROM `perfumes` WHERE `produtoFK` = ".$obj->getId().""; //deleta os dados na linha que possui o id recebido como parâmetro
        $result = $this->conexao->query($sql);  //faz a conexão e a consulta no banco de dados
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    public function atualizar($obj) {        
        $sqlProdutos = "UPDATE produtos SET nome='".$obj->getNome()."', marca='".$obj->getMarca()."', estoque='".$obj->getEstoque()."', preco='".$obj->getPreco()."' WHERE id='".$obj->getId()."'"; //atualização da tabela produtos
        $sqlPerfumes = "UPDATE perfumes SET genero='".$obj->getGenero()."', volume='".$obj->getVolume()."' WHERE produtoFK='".$obj->getId()."'"; //atualiza os dados na linha que possui o id recebido como parâmetro

        $resultProdutos = $this->conexao->query($sqlProdutos); //faz a conexão e a atualização no banco de dados
        $resultPerfumes = $this->conexao->query($sqlPerfumes);

        if ($resultProdutos && $resultPerfumes) {
            return true; //se a atualização funcionar retorna true
        } else {
            return false;
        }
    }

    //seleciona todas as linhas que pertencem a tabela perfumes, onde o nome ou a marca possui a string pesquisada
    public function pesquisar($pesquisa) {
        $sql = "SELECT * FROM produtos pr JOIN perfumes p ON pr.id = p.produtoFK WHERE pr.nome LIKE '%$pesquisa%' OR  pr.marca LIKE '%$pesquisa%'"; 
        $result = $this->conexao->query($sql); //faz a conexão e a consulta no banco de dados

        $perfumes = array();

        if ($result->num_rows > 0) { //se existir pelo menos uma linha na tabela o while será executado
            while ($row = $result->fetch_assoc()) { // é usado para obter cada linha como um array associativo
                $perfume=  new Perfume ($row["nome"], $row["marca"], $row["estoque"], $row["preco"], $row["genero"], $row["volume"]); //transforma cada linha da tabela em um objeto
                $perfume->setId($row["produtoFK"]); //adiciona no objeto o id encontrado

                $perfumes[] = $perfume;
            }
        }
        return $perfumes;
    }
}
?>


