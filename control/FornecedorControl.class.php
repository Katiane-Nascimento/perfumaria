<?php

class FornecedorControl {
    private $conexao; //instância da classe Database
    private $fornecedor; //instância da classe Fornecedor

    function __construct($conexao) {
        $this->conexao = $conexao;
        $fornecedor = new Fornecedor(); 
    }

    public function cadastrar($obj) {        
        $sql = "INSERT INTO fornecedores (CNPJ, razaoSocial, endereco)
        VALUES ('".$obj->getCNPJ()."', '".$obj->getRazaoSocial()."', '".$obj->getEndereco()."')"; //adiciona os dados na tabela fornecedores

        $result = $this->conexao->query($sql);  //faz a conexão e a consulta no banco de dados

        if ($result) {
            return true; //se a conexão funcionar retorna verdadeiro
        } else {
            return false;
        }

    }

    public function listarObj() {
        $sql = "SELECT * FROM fornecedores"; //seleciona todas as linhas da tabela fornecedores
        $result = $this->conexao->query($sql); //faz a conexão e a consulta no banco de dados

        $fornecedores = array();

        if ($result->num_rows > 0) { //se existir pelo menos uma linha na tabela o while será executado
            while ($row = $result->fetch_assoc()) { // é usado para obter cada linha como um array associativo
                $fornecedor =  new Fornecedor($row["CNPJ"], $row["razaoSocial"], $row["endereco"]); //transforma cada linha da tabela em um objeto
                $fornecedor->setId($row["id"]); //adiciona no objeto o id encontrado

                $fornecedores[] = $fornecedor;
            }
        }
        return $fornecedores;
    }

    
    public function buscarPorId($id) {
        $sql = "SELECT * FROM fornecedores WHERE id = $id"; //seleciona a linha da tabela fornecedores com o id informado
        $result = $this->conexao->query($sql);  //faz a conexão e a consulta no banco de dados

        if ($result->num_rows > 0) { //se existir alguma linha com o id informado...

            $row = $result->fetch_assoc(); //transforma os resultados em um array associativo

            $fornecedor = new Fornecedor($row["CNPJ"], $row["razaoSocial"], $row["endereco"]); //cria um objeto com os dados

            $fornecedor->setId($row["id"]); //adiciona o id no objeto

            return $fornecedor;
        } else {
            return false;
        }
    }


    public function atualizar($obj) {        
        $sql = "UPDATE fornecedores SET CNPJ='".$obj->getCNPJ()."', razaoSocial='".$obj->getRazaoSocial()."', endereco='".$obj->getEndereco()."' WHERE id='".$obj->getId()."'"; //atualiza os dados na linha que possui o id recebido como parâmetro

        $result = $this->conexao->query($sql); //faz a conexão e a atualização no banco de dados

        if ($result) {
            return true; //se a atualização funcionar retorna true
        } else {
            return false;
        }
    }

    public function deletar($obj) {        
        $sql = "DELETE FROM fornecedores WHERE id='".$obj->getId()."'"; //deleta os dados na linha que possui o id recebido como parâmetro

        $result = $this->conexao->query($sql);  //faz a conexão e a consulta no banco de dados

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //quando o botão excluir ou editar vinculo é acionado, o id do produto é passado como parâmetro, essa função é usada para obter o id do fornecedor vinculado a esse produto
    public function buscarIdFornecedor($id) {
        $sql = "SELECT idFornecedor FROM relfornecedorproduto WHERE idProduto = '".$id."'";

        $result = $this->conexao->query($sql);

        $row = $result->fetch_assoc();

        return $row["idFornecedor"];
    }

    //verifica se o fornecedor já está cadastrado
    public function verificaCNPJ($CNPJ) { //verifica se o CNPJ já está cadastrado
        $sql = "SELECT * FROM fornecedores WHERE CNPJ = '$CNPJ'"; 

        $result = $this->conexao->query($sql);  //faz a conexão e a consulta no banco de dados

        if ($result->num_rows > 0) { //retorna verdadeira se não existir um ou mais registros
            return false;
        } else {
            return true;
        }
    }

    //verifica se o fornecedor está vinculado a algum produto. Foi usado para impedir que um fornecedor vinculado a um produto seja excluído
    public function verificaVinculacao($id) {
        $sql = "SELECT * FROM relfornecedorproduto WHERE idFornecedor = '$id'"; 

        $result = $this->conexao->query($sql);  //faz a conexão e a consulta no banco de dados

        if ($result->num_rows > 0) { //retorna verdadeira se existir um ou mais registros
            return true;
        } else {
            return false;
        }
    } 

    //seleciona todas as linhas da tabela, onde o CNPj ou a razão social possui a string pesquisada
    public function pesquisar($pesquisa) {
        $sql = "SELECT * FROM fornecedores WHERE CNPJ LIKE '%$pesquisa%' OR razaoSocial LIKE '%$pesquisa%'"; 

        $result = $this->conexao->query($sql);  //faz a conexão e a consulta no banco de dados

        $fornecedores = array();

        if ($result->num_rows > 0) { //se existir pelo menos uma linha na tabela o while será executado
            while ($row = $result->fetch_assoc()) { // é usado para obter cada linha como um array associativo
                $fornecedor =  new Fornecedor($row["CNPJ"], $row["razaoSocial"], $row["endereco"]); //transforma cada linha da tabela em um objeto
                $fornecedor->setId($row["id"]); //adiciona no objeto o id encontrado

                $fornecedores[] = $fornecedor;
            }
        }
        return $fornecedores;
    }
}

?>