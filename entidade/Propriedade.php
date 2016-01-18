<?php

/**
 * Header da classe de propriedade do cliente
 * 
 * Todas funções e configurações da propriedade do cliente
 * 
 * Foi feita esta classe pois de acordo com reuniões, foi definido que no boletim tinha que ter Cliente e sua propriedade em questão, 
 * dai então a melhor solução foi criar outra classe o seus derivados
 *
 * @package entidade
 * @subpackage Propriedade
 * @since 1.0
 *  
 */

/**
 * Classe Propriedade
 * 
 * Todas as funções envolvendo Propriedade do cliente
 * 
 * @author Gustavo Tinoco <gustavotinocoo@gmail.com> - Orientador: Edmilson Souza <edmilson.souza@cpao.embrapa.br>
 * @version 1.0
 * @category   Propriedade
 * @copyright Copyright © 2015, Embrapa - Cpao 
 * @package entidade
 * @subpackage Propriedade
 * @link       http://implementar
 * @access public
 */
class Propriedade {

    /**
     * Id da prorpriedade
     * @param int $Id Identificação do ID da propriedade
     */
    public $Id;

    /**
     * Variável de string do campo Nome
     * @param String $Nome Campo Input de nome da propriedade
     */
    public $Nome;

    /**
     * Variável de string do campo Area
     * @param String $Area Campo Input da Area da propriedade
     *   */
    public $Area;

    /**
     * Variável de string do campo Localidade
     * @param String $Localidade Campo Input de Localidade da propriedade
     *  */
    public $Localidade;

    /**
     * Variável de string do campo Municipio
     * @param String $Municipio Campo Input de Municipio da propriedade     
     */
    public $Municipio;

    /**
     * Variável de string do campo Estado
     * @param String $Estado Campo Input de Estado da propriedade    
     *  */
    public $Estado;

    /**
     * Variável que relaciona a propriedade para o Cliente 1 Cliente pode ter várias propriedades. 1:N
     * @param int $Cliente_id Variável que relaciona o ID do cliente
     */
    public $Cliente_id;

    /**
     * Função que mapeia a propriedade para objeto da classe.
     * @access public
     * @param Propriedade $args Objeto com as relações da propriedade
     */
    function mapear($args) {
        if (is_array($args)) {
            $this->Id = $args['Id'];
            $this->Nome = $args['Nome'];
            $this->Area = $args['Area'];
            $this->Localidade = $args['Localidade'];
            $this->Municipio = $args['Municipio'];
            $this->Estado = $args['Estado'];
            $this->Cliente_id = $args['Cliente_id'];
        }
        if ($args instanceof stdClass) {
            $this->Id = $args->Id;
            $this->Nome = $args->Nome;
            $this->Area = $args->Area;
            $this->Localidade = $args->Localidade;
            $this->Municipio = $args->Municipio;
            $this->Estado = $args->Estado;
            $this->Cliente_id = $args->Cliente_id;
        }
    }

    /**
     * Função que realiza a edição da propriedade
     * @param Propriedade $propriedade Objeto propriedade
     * @access public
     */
    function editar($propriedade) {
        $sql = 'UPDATE propriedade 
				SET 
					Nome = :Nome,
					Area = :Area,
					Localidade = :Localidade,
					Municipio = :Municipio,
					Estado = :Estado,
					Cliente_id = :Cliente_id
					WHERE Id = :Id ';
        try {
            $conn = getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':Nome' => $propriedade->Nome,
                ':Area' => $propriedade->Area,
                ':Localidade' => $propriedade->Localidade,
                ':Municipio' => $propriedade->Municipio,
                ':Estado' => $propriedade->Estado,
                ':Cliente_id' => (int) $propriedade->Cliente_id,
                ':Id' => (int) $propriedade->Id
            ));
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Função que faz o salvamento do boletim no banco de dados
     * @param Propriedade $propriedade Objeto propriedade
     * @param int $id_cliente Id do cliente que foi selecionado no <SELECT> na hora da inserção
     * @access public
     */
    function salvar_propriedades($propriedade, $id_cliente) {
        try {
            $conn = getConexao();
            $sql = "INSERT INTO propriedade (Nome, Area, Localidade, Municipio, Estado, Cliente_id)
					       VALUES (:Nome, :Area, :Localidade, :Municipio, :Estado, :Cliente_id)";

            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':Nome' => $propriedade->Nome,
                ':Area' => $propriedade->Area,
                ':Localidade' => $propriedade->Localidade,
                ':Municipio' => $propriedade->Municipio,
                ':Estado' => $propriedade->Estado,
                ':Cliente_id' => (int) $id_cliente
            ));
            //retorna id da inserção
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Função que lista todos as propriedades de acordo com o ID do cliente
     * @param int $idCliente Id do cliente para ser procurado as propriedade
     * @access public
     * @return Propriedade Retona um array com todos as propriedades de acordo com este cliente cadastrados no Banco de Dados.
     */
    function listar_propriedades_cliente($idCliente) {
        $conn = getConexao();
        $sql = "SELECT * FROM propriedade WHERE Cliente_id = " . $idCliente;
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Propriedade();
            $p->mapear($row);
            $propriedades[] = $p;
        }
        return $propriedades;
    }

    /**
     * Função que lista uma propriedade especifíca de acordo com o ID
     * @param int $id Id da propridade a ser pesquisado
     * @access public
     * @return Propriedade Retona apenas uma propriedade que está cadastrado no Banco de Dados.
     */
    function listar_propriedade_especifica($id) {
        $conn = getConexao();
        $sql = "SELECT * FROM propriedade WHERE Id = " . $id;
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Propriedade();
            $p->mapear($row);
            $propriedade = $p;
        }
        return $propriedade;
    }

    /**
     * Função que lista o total de propriedades de acordo com o cleinte
     * @param int $id ID do cliente informado
     * @access public
     * @return int Retona o total de propriedades de acordo com o cliente que está no Banco de dados.
     */
    function contador_amostra($id) {
        $conn = getConexao();
        $sql = "SELECT COUNT(Id) FROM Propriedade WHERE Cliente_id = " . $id;
        $result = $conn->prepare($sql);
        $result->execute();
        $propriedade = $result->fetch(PDO::FETCH_ASSOC);

        return (int) $propriedade;
    }

}
