<?php

/**
 * Header do boletim de Solo
 * 
 * Todas funções e configurações do boletim de solo
 *
 * @package entidade
 * @subpackage BoletimSolo
 * @since 1.0
 *  
 */
include_once __DIR__ . '/../conf/conexao.php'; //include do arquivo de configuração

/**
 * Classe Cliente
 * 
 * Todas as funções envolvendo Clientes. 
 * 
 * @author Gustavo Tinoco <gustavotinocoo@gmail.com> - Orientador: Edmilson Souza <edmilson.souza@cpao.embrapa.br>
 * @version 1.0
 * @category   Cliente
 * @copyright Copyright © 2015, Embrapa - Cpao 
 * @package entidade
 * @subpackage Cliente
 * @link       http://implementar
 * @access public
 */
class Cliente {

    /**
     * Id do cliente
     * @param int $Id Identificação do ID do cliente
     */
    var $Id;

    /**
     * Variável de string do campo Nome
     * @param String $Nome Campo Input Nome do cliente
     */
    var $Nome;

    /**
     * Variável de string do campo Cpf
     * @param String $Cpf Campo Input de cultura do boletim
     */
    var $Cpf;

    /**
     * Variável de string do campo Cnpj
     * @param String $Cnpj Campo Input de cnpj do cliente
     */
    var $Cnpj;

    /**
     * Variável de string do campo Telefone
     * @param String $Fone Campo Input de Telefone do cliente
     */
    var $Fone;

    /**
     * Variável de string do campo Endereço
     * @param String $Endereco Campo Input de Endereço do cliente
     */
    var $Endereco;

    /**
     * Variável de string do campo Fax
     * @param String $Fax Campo Input de fax do cliente
     */
    var $Fax;

    /**
     * Variável de string do campo Celular
     * @param String $Celular Campo Input de celular do cliente
     */
    var $Celular;

    /**
     * Variável de string do campo Email
     * @param String $Email Campo Input de email do cliente
     */
    var $Email;

    /**
     * Variável de string do campo Cep
     * @param String $Cep Campo Input de cep do cliente
     */
    var $Cep;

    /**
     * Variável de string do campo Cidade
     * @param String $Cidade Campo Input de cidade do cliente
     */
    var $Cidade;

    /**
     * Variável de string do campo Estado
     * @param String $Estado Campo Input de estado do cliente
     */
    var $Estado;

    /**
     * Função que mapeia o cliente para objeto da classe.
     * @access public
     * @param Cliente $args Objeto com as relações do cliente
     */
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

    /**
     * Função que lista todos os clientes
     * @access public
     * @return Cliente Retona um array com todos os clientes cadastrados no Banco de Dadoss.
     */
    function listar_cliente() {
        $conn = getConexao();
        $sql = "SELECT * FROM cliente ORDER BY Nome ASC";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Cliente();
            $p->mapear($row);
            $clientes[] = $p;
        }
        return $clientes;
    }

    /**
     * Função que lista um cliente especifíco de acordo com o ID
     * @param int $idCliente Id do cliente a ser pesquisado
     * @access public
     * @return Cliente Retorna apenas um cliente que está cadastrado no BD.
     */
    function listar_cliente_especifico($idCliente) {
        $conn = getConexao();
        $sql = "SELECT * FROM cliente WHERE Id = " . $idCliente;
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Cliente();
            $p->mapear($row);
            $cliente = $p;
        }
        return $cliente;
    }

    /**
     * Função que realiza a edição do cliente
     * @param Cliente $cliente Objeto cliente
     * @access public
     */
    function editar($cliente) {
        $sql = 'UPDATE cliente 
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

    /**
     * Função que faz o salvamento do cliente no banco de dados
     * @param Cliente $cliente Objeto cliente
     * @access public
     * @return int Retorna o ID que foi inserido.
     */
    function salvar($cliente) {
        try {
            $conn = getConexao();
            $sql = "INSERT INTO cliente (Nome, Cpf, Cnpj, Fone, Endereco, Fax, Celular, Email, Cep, Cidade, Estado)
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

    /**
     * Função que deleta um cliente especifico de acordo com o ID informado.
     * @param int $id_cliente Id do cliente
     * @access public
     */
    function deletar($id_cliente) {
        try {
            if (!is_numeric($id_cliente))
                return;
            $conn = getConexao();
            $sql = 'DELETE FROM cliente WHERE Id=:Id_cliente';
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':Id_cliente' => $id_cliente));
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo '<i>Não foi possível deletar o cliente.</i>' . $e->getMessage();
            }
        }
    }

}

?>