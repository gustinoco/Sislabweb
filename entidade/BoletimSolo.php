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
 * Classe Boletim Solo
 * 
 * Todas as funções envolvendo Boletins. 
 * 
 * @author Gustavo Tinoco <gustavotinocoo@gmail.com> - Orientador: Edmilson Souza <edmilson.souza@cpao.embrapa.br>
 * @version 1.0
 * @category   Boletim de solo
 * @copyright Copyright © 2015, Embrapa - Cpao 
 * @package entidade
 * @subpackage BoletimSolo
 * @link       http://implementar
 * @access public
 */
class BoletimSolo {
    /**
     * Id do boletim
     * @param int $Id Identificação do ID do boletim
     */
    var $Id;

    /**
     * Checkbox de amostra se é pesquisa ou não o boletim
     * @param boolean $Pesquisa Verificação do CheckBox de Pesquisa 
     */
    var $Pesquisa;

    /**
     * Variável de data de entrada do boletim
     * @param datetime $Data_entrada Data de entrada do boletim
     */
    var $Data_entrada;

    /**
     * Variável que instancia o cliente de acordo com o ID
     * @param int $Id_cliente Relaciona o Cliente de acordo com o ID do mesmo
     */
    var $Id_cliente;

    /**
     * Variável do valor do boletim
     * @param float $Valor Valor final do boletim em R$
     */
    var $Valor;

    /**
     * Variável de string do campo Cultura
     * @param String $Cultura Campo Input de cultura do boletim
     */
    var $Cultura;

    /**
     * Variável de string do campo Sistema
     * @param String $Sistema Campo Input de sistema do boletim
     */
    var $Sistema;

    /**
     * Variável de string do campo Observação
     * @param String $Observacao Campo Observação do boletim(textarea)
     */
    var $Observacao;

    /**
     * Variável que relaciona o Pesquisador responsável do boletim
     * @param String $Pesquisador Relaciona o Pesquisador do boletim 1:N
     */
    var $Pesquisador;

    /**
     * Variável que relaciona a propriedade do cliente relacionada.
     * @param int $Propriedade Relaciona a propriedade do cliente de acordo com o cliente informado
     */
    var $Propriedade;

    /**
     * Função que mapeia o boletim para objeto da classe.
     * @access public
     * @param BoletimSolo $args Objeto com as relações do boletim
     */
    function mapear($args) {
        if (is_array($args)) {
            $this->Id = $args['Id'];
            $this->Pesquisa = $args['Pesquisa'];
            $this->Data_entrada = $args['Data_entrada'];
            $this->Id_cliente = $args['Id_cliente'];
            $this->Valor = $args['Valor'];
            $this->Cultura = $args['Cultura'];
            $this->Sistema = $args['Sistema'];
            $this->Observacao = $args['Observacao'];
            $this->Pesquisador = $args['Pesquisador'];
            $this->Propriedade = $args['Propriedade'];
        }
        if ($args instanceof stdClass) {
            $this->Id = $args->Id;
            $this->Pesquisa = $args->Pesquisa;
            $this->Data_entrada = $args->Data_entrada;
            $this->Id_cliente = $args->Id_cliente;
            $this->Valor = $args->Valor;
            $this->Cultura = $args->Cultura;
            $this->Sistema = $args->Sistema;
            $this->Observacao = $args->Observacao;
            $this->Pesquisador = $args->Pesquisador;
            $this->Propriedade = $args->Propriedade;
        }
    }

    /**
     * Função que lista todos os boletins
     * @access public
     * @return BoletimSolo Retona um array com todos os boletins cadastrados no BD.
     */
    function lista_boletim() {
        $conn = getConexao();
        $sql = "SELECT * FROM boletim_solo";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new BoletimSolo();
            $p->mapear($row);
            $boletim[] = $p;
        }
        return $boletim;
    }

    /**
     * Função que lista um boletim especifíco de acordo com o ID
     * @param int $id Id do boletim a ser pesquisado
     * @access public
     * @return BoletimSolo Retona apenas um boletim que está cadastrado no BD.
     */
    function lista_boletim_edicao($id) {
        $conn = getConexao();
        $sql = "SELECT * FROM boletim_solo WHERE Id =" . $id;
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new BoletimSolo();
            $p->mapear($row);
            $boletim = $p;
        }
        return $boletim;
    }

    /**
     * Função que deleta um boletim especifico de acordo com o ID informado.
     * @param int $id_boletim Id do boletim
     * @access public
     */
    function deletar($id_boletim) {
        try {
            if (!is_numeric($id_boletim))
                return;
            $conn = getConexao();
            $sql = 'DELETE FROM boletim_solo WHERE Id=:Boletim_id';
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':boletim_id' => $id_boletim));
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo '<i>Não foi possível deletar o boletim.</i>' . $e->getMessage();
            }
        }
    }

    /**
     * Função que lista o último boletim inserido
     * @access public
     * @return integer Retona o último ID inserido no Banco de dados.
     */
    function lista_ultimo_id() {
        $conn = getConexao();
        $sql = "SELECT MAX(Id) AS MaximoId FROM boletim_solo";
        $result = $conn->prepare($sql);
        $result->execute();
        $boletim = $result->fetch(PDO::FETCH_ASSOC);

        return $boletim;
    }

    /**
     * Função que realiza a edição do boletim
     * @param BoletimSolo $boletim Objeto boletim
     * @access public
     */
    function editar($boletim) {
        $sql = 'UPDATE boletim_solo
				SET 
					Id_cliente = :Id_cliente,
					Cultura = :Cultura,
					Data_entrada = :Data_entrada,
					Observacao = :Observacao,
					Pesquisa = :Pesquisa,
					Sistema = :Sistema,
					Valor = :Valor,	
                                        Pesquisador = :Pesquisador,
                                        Propriedade = :Propriedade
				WHERE Id = :Id';
        try {
            $conn = getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':Id_cliente' => (int) $boletim->Id_cliente,
                ':Cultura' => $boletim->Cultura,
                ':Data_entrada' => $boletim->Data_entrada,
                ':Observacao' => $boletim->Observacao,
                ':Pesquisa' => $boletim->Pesquisa,
                ':Sistema' => $boletim->Sistema,
                ':Valor' => $boletim->Valor,
                ':Pesquisador' => $boletim->Pesquisador,
                ':Propriedade' => (int) $boletim->Propriedade,
                ':Id' => (int) $boletim->Id
            ));
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Função que faz o salvamento do boletim no banco de dados
     * @param BoletimSolo $boletim Objeto boletim
     * @access public
     * @return int Retorna o ID que foi inserido.
     */
    function salvar($boletim) {
        try {
            $conn = getConexao();
            $sql = "INSERT INTO boletim_solo (Pesquisa, Data_entrada, Id_cliente, Valor, Cultura, Sistema, Observacao, Pesquisador, Propriedade)
					       VALUES (:Pesquisa, :Data_entrada, :Id_cliente, :Valor, :Cultura, :Sistema, :Observacao, :Pesquisador, :Propriedade)";

            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':Pesquisa' => $boletim->Pesquisa,
                ':Data_entrada' => $boletim->Data_entrada,
                ':Id_cliente' => $boletim->Id_cliente,
                ':Valor' => $boletim->Valor,
                ':Cultura' => $boletim->Cultura,
                ':Sistema' => $boletim->Sistema,
                ':Observacao' => $boletim->Observacao,
                ':Pesquisador' => $boletim->Pesquisador,
                ':Propriedade' => (int) $boletim->Propriedade,
            ));
//retorna id da inserção
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            echo '<i>Não foi possível salvar o boletim, Tente novamente!</i>';
        }
    }

    /**
     * Função que lista um boletim especifíco de acordo com o ID do cliente
     * @param int $id_cliente ID do cliente
     * @access public
     * @return BoletimSolo Retona um array de boletins de acordo com o cliente
     */
    function verifica_boletim($id_cliente) {
        try {
            $conn = getConexao();
            $sql = "SELECT * FROM boletim_solo WHERE Id_cliente = " . $id_cliente;
            $result = $conn->query($sql);
            while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                $p = new BoletimSolo();
                $p->mapear($row);
                $boletim[] = $p;
            }
            return $boletim;
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Função que lista um boletim especifíco de acordo com o Login do pesquisador
     * @param String $usuario Login do pesquisador
     * @access public
     * @return BoletimSolo Retona um array de boletins de acordo com o pesquisador
     */
    function lista_boletim_pesquisador($login_pesquisador) {
        try {
            $conn = getConexao();
            $sql = "SELECT * FROM boletim_solo WHERE Pesquisador = '$login_pesquisador'";
            $result = $conn->query($sql);
            while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                $p = new BoletimSolo();
                $p->mapear($row);
                $boletim[] = $p;
            }
            return $boletim;
        } catch (PDOException $e) {
            return null;
        }
    }

}
