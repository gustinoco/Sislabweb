<?php

include_once __DIR__ . '/../conf/conexao.php';

class Cliente {

    public $Id;
    public $Nome;
    public $Cpf;
    public $Cnpj;
    public $Fone;
    public $Endereco;
    public $Fax;
    public $Celular;
    public $Email;
    public $Cep;
    public $Cidade;
    public $Estado;

    function mapear($args) {
        if (is_array($args)) {
            $this->Id = $args['Id'];
            $this->Nome = $args['Nome'];
            $this->Cpf = $args['Cpf'];
            $this->Cnpj = $args['Cnpj'];
            $this->Fone = $args['Fone'];
            $this->Endereco = $args['Endereco'];
            $this->Fax = $args['Fax'];
            $this->Celular = $args['Celular'];
            $this->Email = $args['Email'];
            $this->Fax = $args['Fax'];
            $this->Cep = $args['Cep'];
            $this->Cidade = $args['Cidade'];
            $this->Estado = $args['Estado'];
        }
        if ($args instanceof stdClass) {
            $this->Id = $args->Id;
            $this->Nome = $args->Nome;
            $this->Cpf = $args->Cpf;
            $this->Cnpj = $args->Cnpj;
            $this->Fone = $args->Fone;
            $this->Endereco = $args->Endereco;
            $this->Fax = $args->Fax;
            $this->Celular = $args->Celular;
            $this->Email = $args->Email;
            $this->Fax = $args->Fax;
            $this->Cep = $args->Cep;
            $this->Cidade = $args->Cidade;
            $this->Estado = $args->Estado;
        }
    }

    function listar_cliente() {
        $conn = getConexao();
        $sql = "SELECT * FROM CLIENTE ORDER BY Nome ASC";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Cliente();
            $p->mapear($row);
            $clientes[] = $p;
        }
        return $clientes;
    }

    function listar_cliente_especifico($idCliente) {
        $conn = getConexao();
        $sql = "SELECT * FROM CLIENTE WHERE Id = " . $idCliente;
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Cliente();
            $p->mapear($row);
            $cliente = $p;
        }
        return $cliente;
    }

    ///Nome, Cpf, Cnpj, Fone, Endereco, Fax, Celular, Email, Cep, Cidade, Estado, Nome_propriedade, Area_propriedade, Localidade_propriedade, Municipio_propriedade,Estado_propriedade )
    function editar($cliente) {
        $sql = 'UPDATE CLIENTE 
				SET 
					Nome = :Nome,
					Cpf = :Cpf,
					Cnpj = :Cnpj,
					Fone = :Fone,
					Endereco = :Endereco,
					Fax = :Fax,
					Celular = :Celular,
					Email = :Email,
					Cep = :Cep,
					Cidade = :Cidade,
					Estado = :Estado
                                       
                                       
				WHERE Id = :Id ';
        try {
            $conn = getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':Nome' => $cliente->Nome,
                ':Cpf' => $cliente->Cpf,
                ':Cnpj' => $cliente->Cnpj,
                ':Fone' => $cliente->Fone,
                ':Endereco' => $cliente->Endereco,
                ':Fax' => $cliente->Fax,
                ':Celular' => $cliente->Celular,
                ':Email' => $cliente->Email,
                ':Cep' => $cliente->Cep,
                ':Cidade' => $cliente->Cidade,
                ':Estado' => $cliente->Estado,
                ':Id' => (int) $cliente->Id
            ));
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function salvar($cliente) {
        try {
            $conn = getConexao();
            $sql = "INSERT INTO CLIENTE (Nome, Cpf, Cnpj, Fone, Endereco, Fax, Celular, Email, Cep, Cidade, Estado)
					       VALUES (:Nome, :Cpf, :Cnpj, :Fone, :Endereco, :Fax, :Celular, :Email, :Cep, :Cidade, :Estado)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':Nome' => $cliente->Nome,
                ':Cpf' => $cliente->Cpf,
                ':Cnpj' => $cliente->Cnpj,
                ':Fone' => $cliente->Fone,
                ':Endereco' => $cliente->Endereco,
                ':Fax' => $cliente->Fax,
                ':Celular' => $cliente->Celular,
                ':Email' => $cliente->Email,
                ':Cep' => $cliente->Cep,
                ':Cidade' => $cliente->Cidade,
                ':Estado' => $cliente->Estado,
            ));
            //retorna id da inserção
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            echo '<i>Não foi possível salvar o cliente, Tente novamente!</i>' . $e->getMessage();
        }
    }

    function deletar($id_cliente) {
        try {
            if (!is_numeric($id_cliente))
                return;
            $conn = getConexao();
            $sql = 'DELETE FROM CLIENTE WHERE Id=:id_cliente';
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':id_cliente' => $id_cliente));
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo '<i>Não foi possível deletar o clente.</i>'. $e->getMessage();
            }
        }
    }

}

?>