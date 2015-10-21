<?php

if (isset($_SESSION)) {
    include_once __DIR__ . '/../conf/conexao.php';
}

class Pesquisador {

    public $Login;
    public $Nome_completo;
    public $Email;
    public $Senha;
    public $Data_cadastro;
    public $Data_ultimo_acesso;
    public $Permissao;
    public $Id;

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

    function login($login, $senha) {
        $login = mysql_escape_string($login);
        $senha = mysql_escape_string($senha);
        try {
            /** EXECUTA CONSULTA */
            $sql = "SELECT Login, Data_ultimo_acesso, Permissao FROM PESQUISADOR WHERE Login='$login' AND Senha='$senha' LIMIT 1";
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

    function lista_pesquisadores() {
        $conn = getConexao();
        $sql = "SELECT * FROM PESQUISADOR ORDER BY Login ASC";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Pesquisador();
            $p->mapear($row);
            $pesquisadores[] = $p;
        }
        return $pesquisadores;
    }

    function listar_pesquisador_especifico($login) {
        $conn = getConexao();
        $sql = "SELECT * FROM PESQUISADOR WHERE Login = '$login'";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Pesquisador();
            $p->mapear($row);
            $pesquisador = $p;
        }
        return $pesquisador;
    }

    function alterarDataUltimoLogin($login) {
        $data_atual = date("Y-m-d H:i:s");
        try {
            $sql = "UPDATE PESQUISADOR SET Data_ultimo_acesso = '$data_atual' WHERE Login = '$login'";
            $conn = getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    function editar($pesquisador) {
        $sql = 'UPDATE PESQUISADOR 
				SET 
					Nome_completo = :Nome_completo,
					Login = :Login,
					Email = :Email,
					Permissao = :Permissao,
					                                       
				WHERE Login = :Login ';
        try {
            $conn = getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':Nome_completo' => $pesquisador->Nome_completo,
                ':Login' => $pesquisador->Login,
                ':Email' => $pesquisador->Email,
                ':Permissao' => $pesquisador->Permissao,
                ':Login' => $pesquisador->Login
            ));
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function salvar($pesquisador) {
        try {
            
            $ae = $pesquisador->Id = static:: lista_ultimo_id() ;
            $ae['UltimoId'] + 1;
            $conn = getConexao();
            $sql = "INSERT INTO PESQUISADOR (Id, Nome_completo, Senha, Login, Email, Data_cadastro, Permissao)
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

   
    
    function lista_ultimo_id() {
        $conn = getConexao();
        $sql = "SELECT MAX(Id) as UltimoId FROM Pesquisador";
        $result = $conn->prepare($sql);
        $result->execute();
        $pesquisador = $result->fetch(PDO::FETCH_ASSOC);
        return $pesquisador;
    }

    function deletar($login) {
        try {
            if (!is_numeric($elogin))
                return;
            $conn = getConexao();
            $sql = 'DELETE FROM PESQUISADOR WHERE Login = :Login';
            $stmt = $conn->prepare($sql);
            $stmt->execute(array('::Login' => $login));
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo '<i>Não foi possível deletar o pesquisador.</i>';
            }
        }
    }

}
