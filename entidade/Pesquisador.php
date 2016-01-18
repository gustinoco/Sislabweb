<?php

/**
 * Header da classe de pesquisador
 * 
 * Todas funções e configurações do pesquisador
 *
 * @package entidade
 * @subpackage Pesquisador
 * @since 1.0
 *  
 */
//Verifica caso exista sessão ele inclui o arquivo de configuração, fiz isto pois na index ele dava erro pois o include da configuração ficava duplicado, assim resolveu o bug.
if (isset($_SESSION)) {
    include_once __DIR__ . '/../conf/conexao.php';
}

/**
 * Classe Pesquisador
 * 
 * Todas as funções envolvendo Pesquisador
 * 
 * @author Gustavo Tinoco <gustavotinocoo@gmail.com> - Orientador: Edmilson Souza <edmilson.souza@cpao.embrapa.br>
 * @version 1.0
 * @category   Pesquisador
 * @copyright Copyright © 2015, Embrapa - Cpao 
 * @package entidade
 * @subpackage Pesquisador
 * @link       http://implementar
 * @access public
 */
class Pesquisador {

    /**
     * Id do cliente
     * @param int $Id Identificação do ID do cliente
     */
    public $Id;

    /**
     * Variável de string do Login do pesquisador
     * @param String $Login Campo Input Login do pesquisador
     */
    public $Login;

    /**
     * Variável de string do campo Nome
     * @param String $Nome_completo Campo Input de Nome
     */
    public $Nome_completo;

    /**
     * Variável de string do campo Email
     * @param String $Email Campo Input de Email
     */
    public $Email;

    /**
     * Variável de string do campo Senha
     * @param String $Email Campo Input de Senha
     */
    public $Senha;

    /**
     * Variável de data quando foi cadastrado o pesquisador.
     * @param DATETIME $Data_cadastro Data de cadastro do pesquisador
     */
    public $Data_cadastro;

    /**
     * Variável de data que salva ultimo acesso por login.
     * @param DATETIME $Data_ultimo_acesso Data de ultimo acesso do pesquisador
     */
    public $Data_ultimo_acesso;

    /**
     * Variável que verifica pesquisador administrador ou pesquisador.
     * @param int $Permissao Caso seja 0 = Administrador e se for valor 1 = Usuário Pesquiasdor
     */
    public $Permissao;

    /**
     * Função que mapeia o pesquisador para objeto da classe.
     * @access public
     * @param Cliente $args Objeto com as relações do pesquisador.
     */
    function mapear($args) {
        if (is_array($args)) {
            $this->Id = $args['Id'];
            $this->Login = $args['Login'];
            $this->Nome_completo = $args['Nome_completo'];
            $this->Email = $args['Email'];
            $this->Senha = $args['Senha'];
            $this->Data_cadastro = $args['Data_cadastro'];
            $this->Data_ultimo_acesso = $args['Data_ultimo_acesso'];
            $this->Permissao = $args['Permissao'];
        }
        if ($args instanceof stdClass) {
            $this->Id = $args->Id;
            $this->Login = $args->Login;
            $this->Nome_completo = $args->Nome_completo;
            $this->Email = $args->Email;
            $this->Senha = $args->Senha;
            $this->Data_cadastro = $args->Data_cadastro;
            $this->Data_ultimo_acesso = $args->Data_ultimo_acesso;
            $this->Permissao = $args->Permissao;
        }
    }

    /**
     * Função que realiza o login no sistema.
     * @param String $login Recebe do input Login a string digitada.
     * @param String $senha Recebe do input Senha a string digitada.
     * @access public
     * @return Retorna o objeto encontrado de pesquisador, caso exista. Se não existir retorna string informado usuário ou senha inválido.
     */
    function login($login, $senha) {
        $login = mysql_escape_string($login);
        $senha = mysql_escape_string($senha);
        try {
            /** EXECUTA CONSULTA */
            $sql = "SELECT Login, Data_ultimo_acesso, Permissao FROM pesquisador WHERE Login='$login' AND Senha='$senha' LIMIT 1";
            $conn = getConexao();
            $result = $conn->query($sql);
            $row = $result->fetch(PDO::FETCH_OBJ);
            $usr = new Pesquisador();
            $usr->mapear($row);
            //atualiza data de ultimo login
            $this->alterarDataUltimoLogin($usr->Login);

            return $usr;
        } catch (PDOException $e) {
            return 'Usuário ou senha inválidos';
        }
    }

    /**
     * Função que lista todos os pesquisadores
     * @access public
     * @return Pesquisador Retona um array com todos os pesquisadores cadastrados no Banco de Dadoss.
     */
    function lista_pesquisadores() {
        $conn = getConexao();
        $sql = "SELECT * FROM pesquisador ORDER BY Login ASC";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Pesquisador();
            $p->mapear($row);
            $pesquisadores[] = $p;
        }
        return $pesquisadores;
    }

    /**
     * Função que lista um pesquisador especifíco de acordo com o Login
     * @param String $login Login do cliente a ser pesquisado
     * @access public
     * @return Pesquisador Retorna apenas um pesquisador que está cadastrado no BD.
     */
    function listar_pesquisador_especifico($login) {
        $conn = getConexao();
        $sql = "SELECT * FROM pesquisador WHERE Login = '$login'";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Pesquisador();
            $p->mapear($row);
            $pesquisador = $p;
        }
        return $pesquisador;
    }

    /**
     * Função que altera a data de último acesso do pesquisador.
     * @param String $login Login do cliente a ser alterado a última data
     * @access public
     */
    function alterarDataUltimoLogin($login) {
        $data_atual = date("Y-m-d H:i:s");
        try {
            $sql = "UPDATE pesquisador SET Data_ultimo_acesso = '$data_atual' WHERE Login = '$login'";
            $conn = getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    /**
     * Função que realiza a edição do pesquisador
     * @param Pesquisador $pesquisador Objeto pesquisador
     * @access public
     */
    function editar($pesquisador) {
        $sql = "UPDATE pesquisador 
				SET 
					Nome_completo = :Nome_completo,
					Login = :Login,
					Email = :Email,
					Permissao = :Permissao 
					                                       
				WHERE Login = :Login";
        try {
            $conn = getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':Nome_completo' => $pesquisador->Nome_completo,
                ':Email' => $pesquisador->Email,
                ':Permissao' => $pesquisador->Permissao,
                ':Login' => $pesquisador->Login
            ));
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Função que faz o salvamento do pesquisador no banco de dados
     * @param Pesquisador $pesquisador Objeto pesquisador
     * @access public
     * @return int Retorna o ID que foi inserido.
     */
    function salvar($pesquisador) {
        try {

            $ae = $pesquisador->Id = static:: lista_ultimo_id();
            $ae['UltimoId'] + 1;
            $conn = getConexao();
            $sql = "INSERT INTO pesquisador (Id, Nome_completo, Senha, Login, Email, Data_cadastro, Permissao)
					       VALUES (:Id, :Nome_completo, :Senha, :Login, :Email, :Data_cadastro, :Permissao)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':Id' => (int) $ae,
                ':Nome_completo' => $pesquisador->Nome_completo,
                ':Login' => $pesquisador->Login,
                ':Email' => $pesquisador->Email,
                ':Senha' => $pesquisador->Senha,
                ':Data_cadastro' => date("Y-m-d H:i:s"),
                ':Permissao' => $pesquisador->Permissao,
                ':Login' => $pesquisador->Login
            ));
            //retorna id da inserção
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            echo '<i>Não foi possível salvar o pesquisador, Tente novamente!</i>' . $e->getMessage();
        }
    }

    /**
     * Função que lista o último pesquisador inserido
     * @access public
     * @return integer Retona o último ID inserido no Banco de dados.
     */
    function lista_ultimo_id() {
        $conn = getConexao();
        $sql = "SELECT MAX(Id) AS UltimoId FROM pesquisador";
        $result = $conn->prepare($sql);
        $result->execute();
        $pesquisador = $result->fetch(PDO::FETCH_ASSOC);
        return $pesquisador;
    }

    /**
     * Função que deleta um pesquisador especifico de acordo com o login informado.
     * @param String $login Login do pesquisador
     * @access public
     */
    function deletar($login) {
        try {

            $conn = getConexao();
            $sql = 'DELETE FROM pesquisador WHERE Login = :Login';
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':Login' => $login));
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo '<i>Não foi possível deletar o pesquisador.</i>';
            }
        }
    }

}
