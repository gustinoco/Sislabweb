<?php

/**
 * Header da classe de Plana
 * 
 * Todas funções e configurações de Planta
 * 
 * @package entidade
 * @subpackage Planta
 * @since 1.0
 *  
 */
include_once __DIR__ . '/../conf/conexao.php'; //include do arquivo de configuração

/**
 * Classe Planta
 * 
 * Todas as funções envolvendo Planta. 
 * 
 * @author Gustavo Tinoco <gustavotinocoo@gmail.com> - Orientador: Edmilson Souza <edmilson.souza@cpao.embrapa.br>
 * @version 1.0
 * @category  Planta
 * @copyright Copyright © 2015, Embrapa - Cpao 
 * @package entidade
 * @subpackage Planta
 * @link       http://implementar
 * @access public
 */
class Planta {

    /**
     * Id do planta
     * @param int $Id Identificação do ID de planta
     */
    public $Id;

    /**
     * Variável de string do campo C
     * @param String $C Campo Input de C de planta
     */
    public $C;
    
    
    /**
     * Variável de string do campo N
     * @param String $N Campo Input de N de planta
     */
    public $N;

    /**
     * Variável de string do campo P
     * @param String $P Campo Input de P de planta
     */
    public $P;

    /**
     * Variável de string do campo K
     * @param String $K Campo Input de K do planta
     */
    public $K;

    /**
     * Variável de string do campo Ca
     * @param String $Ca Campo Input de Ca do planta
     */
    public $Ca;

    /**
     * Variável de string do campo Mg
     * @param String $Mg Campo Input de Mg do planta
     */
    public $Mg;

    /**
     * Variável de string do campo S
     * @param String $S Campo Input de S do planta
     */
    public $S;

    /**
     * Variável de string do campo Cu
     * @param String $Cu Campo Input de Cu do planta
     */
    public $Cu;

    /**
     * Variável de string do campo Fe
     * @param String $Fe Campo Input de Fe do planta
     */
    public $Fe;

    /**
     * Variável de string do campo Mn
     * @param String Mn Campo Input de Mn do planta
     */
    public $Mn;

    /**
     * Variável de string do campo Zn
     * @param String $Zn Campo Input de Zn do planta
     */
    public $Zn;

    /**
     * Variável de string do campo B
     * @param String $B Campo Input de B do planta
     */
    public $B;

    /**
     * Variável de Tempo que foi cadastrada a amostra de Planta
     * @param TIMESTAMP $Data_cadastro Data de cadastro da amostra de Planta.
     */
    public $Data_cadastro;

    /**
     * Variável de string do campo Email
     * @param String  $Pesquisador Data de cadastro do pesquisador
     */
    public $Pesquisador;

    /**
     * Variável de string do campo Identificação
     * @param String $Identificacao Campo input de identificação da amostra.
     */
    public $Identificacao;

    /**
     * Variável de boolean que verifica o checkbox de Macro
     * @param boolean $Macro
     */
    public $Macro;

    /**
     * Variável de boolean que verifica o checkbox de Micro
     * @param boolean $Micro
     */
    public $Micro;

    /**
     * Variável de boolean que verifica o checkbox de Somente N
     * @param boolean $Somente_n
     */
    public $Somente_n;

    /**
     * Variável que relaciona o Boletim da amostra
     * @param int $Id_boletim ID do boletim que está cadastrada a amostra. 1:1 no Banco de dados
     */
    public $Id_boletim;

    /**
     * Função que mapeia o planta para objeto da classe.
     * @access public
     * @param Planta $args Objeto com as relações do planta
     */
    function mapear($args) {
        if (is_array($args)) {
            $this->Id = $args['Id'];
            $this->C = $args['C'];
            $this->N = $args['N'];
            $this->P = $args['P'];
            $this->K = $args['K'];
            $this->Ca = $args['Ca'];
            $this->Mg = $args['Mg'];
            $this->S = $args['S'];
            $this->Cu = $args['Cu'];
            $this->Fe = $args['Fe'];
            $this->Mn = $args['Mn'];
            $this->Zn = $args['Zn'];
            $this->B = $args['B'];
            $this->Pesquisador = $args['Pesquisador'];
            $this->Data_cadastro = $args->$args['Data_cadastro'];
            $this->Identificacao = $args->$args['Identificacao'];
            $this->Macro = $args->$args['Macro'];
            $this->Micro = $args->$args['Micro'];
            $this->Somente_n = $args->$args['Somente_n'];
            $this->Id_boletim = $args->$args['Id_boletim'];
        }
        if ($args instanceof stdClass) {
            $this->Id = $args->Id;
            $this->C = $args->C;
            $this->N = $args->N;
            $this->P = $args->P;
            $this->K = $args->K;
            $this->Ca = $args->Ca;
            $this->Mg = $args->Mg;
            $this->S = $args->S;
            $this->Cu = $args->Cu;
            $this->Fe = $args->Fe;
            $this->Mn = $args->Mn;
            $this->Zn = $args->Zn;
            $this->B = $args->B;
            $this->Pesquisador = $args->Pesquisador;
            $this->Data_cadastro = $args->Data_cadastro;
            $this->Identificacao = $args->Identificacao;
            $this->Macro = $args->Macro;
            $this->Micro = $args->Micro;
            $this->Somente_n = $args->Somente_n;
            $this->Id_boletim = $args->Id_boletim;
        }
    }

    /**
     * Função que lista o total de planta de acordo com o ID do boletim
     * @param int $id ID do boletim informado
     * @access public
     * @return int Retona o total de amostras de planta de acordo com o boletim que está relacionado a ele no Banco de dados.
     */
    function contador_amostra($id) {

        $conn = getConexao();
        $sql = "SELECT COUNT(Id) FROM planta WHERE Id_boletim = " . $id;
        $result = $conn->prepare($sql);
        $result->execute();
        $boletim = $result->fetch(PDO::FETCH_ASSOC);
        return (int) $boletim;
    }

    /**
     * Função que faz o salvamento das opções na criação do boletim, salva Pesquisador, Boletim Responsável, Identificação da amostra e os checkbox MO,MICRO,TEXTURA e ROTINA
     * @param int $id ID da amostra para salvar.
     * @param String $Pesquisador login do pesquisador para ser salvo.
     * @param int $id_boletim ID do boletim para ser salvo.
     * @param String $identificacao String de identificação da amostra para ser salvo.
     * @param boolean $rotina verificação do checkbox para ser salvo.
     * @param boolean $mo verificação do checkbox para ser salvo.
     * @param boolean $micro verificação do checkbox para ser salvo.
     * @param boolean $textura verificação do checkbox para ser salvo.
     * @access public
     */
    function salvar_nulo($id, $Pesquisador, $id_boletim, $identificacao, $macro, $micro, $somente_n) {
        try {
            $conn = getConexao();
            $sql = "INSERT INTO planta (Id, Pesquisador, Data_cadastro, Id_boletim, Identificacao, Macro, Micro, Somente_n)
					       VALUES (:Id, :Pesquisador, :Data_cadastro, :Id_boletim, :Identificacao, :Macro, :Micro, :Somente_n)";

            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':Id' => (int) $id,
                ':Pesquisador' => $Pesquisador,
                ':Id_boletim' => (int) $id_boletim,
                ':Identificacao' => $identificacao,
                ':Data_cadastro' => date("Y-m-d H:i:s"),
                ':Macro' => $macro,
                ':Micro' => $micro,
                ':Somente_n' => $somente_n
            ));
        } catch (PDOException $e) {
            echo '<i>Não foi possível salvar a leitura da Planta, Tente novamente!</i>';
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Função que faz o salvamento da amostra individual de Planta no banco de dados
     * @param Planta $planta Objeto planta
     * @access public
     */
    function salvar($planta) {
        try {
            $conn = getConexao();
            $sql = "INSERT INTO planta (N, C, P, K, Ca, Mg, S, Cu, Fe, Mn, Zn, B, Data_cadastro, Pesquisador)
					       VALUES (:N, :C, :P, :K, :Ca, :Mg, :S, :Cu, :Fe, :Mn, :Zn, :B, :Data_cadastro, :Pesquisador)";

            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':N' => $planta->N,
                ':C' => $planta->C,
                ':P' => $planta->P,
                ':K' => $planta->K,
                ':Ca' => $planta->Ca,
                ':Mg' => $planta->Mg,
                ':S' => $planta->S,
                ':Cu' => $planta->Cu,
                ':Fe' => $planta->Fe,
                ':Mn' => $planta->Mn,
                ':Zn' => $planta->Zn,
                ':B' => $planta->B,
                ':Pesquisador' => $planta->Pesquisador,
                ':Data_cadastro' => date("Y-m-d H:i:s")
            ));
        } catch (PDOException $e) {
            echo '<i>Não foi possível salvar a leitura da planta, Tente novamente!</i>';
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Função que faz a atualização de acordo com o checkbox marcado na criação dos boletins. No arquivo de salvar_formulario_planta  faz o desmembramento dos inputs[MyInputs] e
     * e faz a atualização 1 por 1 de cada amostra, de acordo com o ID da amostra.
     * @param Planta $planta Objeto planta
     * @param int $id_boletim Atualiza a amostra para lincar o ID do boletim.
     * @access public
     */
    function salvar_boletins($planta, $id_boletim) {
        $sql = 'UPDATE planta 
				SET 
   
                                        Id_Boletim = :Id_Boletim,
                                        Macro = :Macro,
                                        Micro = :Micro,
                                        Identificacao = :Identificacao,
                                        Somente_n = :Somente_n
				WHERE Id = :Id';
        try {
            $conn = getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':Id_Boletim' => (int) $id_boletim,
                ':Macro' => $planta->Macro,
                ':Micro' => $planta->Micro,
                ':Identificacao' => $planta->Identificacao,
                ':Somente_n' => $planta->Somente_n,
                ':Id' => (int) $planta->Id
            ));
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Função que lista todos as amostras de acordo com o ID do boletim.
     * @param int $idBoletim Id do boletim informado.
     * @access public
     * @return Planta Retona um array de plantas de acordo com o Id do boletim
     */
    function listar_planta_idboletim($idBoletim) {
        $conn = getConexao();
        $sql = "SELECT * FROM planta WHERE Id_Boletim = " . $idBoletim;
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Planta();
            $p->mapear($row);
            $plantas[] = $p;
        }
        return $plantas;
    }

    /**
     * Função que lista todos as amostras de acordo com o pesquisador
     * @param String $pesquisador Login do pesquisador informado.
     * @access public
     * @return Planta Retona um array de plantas de acordo com o Pesquisador.
     */
    function listar_planta($pesquisador) {
        $conn = getConexao();
        $sql = "SELECT * FROM planta WHERE Pesquisador = '$pesquisador'";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Planta();
            $p->mapear($row);
            $plantas[] = $p;
        }
        return $plantas;
    }

    /**
     * Função que lista o último planta inserido
     * @access public
     * @return integer Retona o último ID inserido no Banco de dados.
     */
    function lista_ultimo_id() {
        $conn = getConexao();
        $sql = "SELECT MAX(Id) AS MaximoId FROM planta";
        $result = $conn->prepare($sql);
        $result->execute();
        $planta = $result->fetch(PDO::FETCH_ASSOC);
        return $planta;
    }

    /**
     * Função que lista todos as amostras que não tenham Boletim lincado, e o pesquisador não seje nulo (pois mostrada erro se não fosse inserido isto)
     * @access public
     * @return Planta Retona um array de plantas que não tenha boletim e pesquisador seje não nulo.
     */
    function listar_basico_planta() {
        $conn = getConexao();
        $sql = "SELECT * FROM planta WHERE Id_boletim IS NULL AND Pesquisador IS NOT NULL ORDER BY Id DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Planta();
            $p->mapear($row);
            $plantas[] = $p;
        }
        return $plantas;
    }

    /**
     * Função que lista todos as amostras de planta ordenado por ID descrescente.
     * @access public
     * @return Planta Retona um array de plantas.
     */
    function listar_todos_planta() {
        $conn = getConexao();
        $sql = "SELECT * FROM planta ORDER BY Id DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Planta();
            $p->mapear($row);
            $plantas[] = $p;
        }
        return $plantas;
    }

    /**
     * Função que realiza a edição da amostra do Planta
     * @param Planta $planta Objeto planta
     * @access public
     */
    function editar($planta) {
        $sql = 'UPDATE planta 
				SET 
					N = :N,
                                        C = :C,
					P = :P,
                                        K = :K,
					Ca = :Ca,
					Mg = :Mg,
					S= :S,
					Cu = :Cu,
					Fe= :Fe,
                                        Mn= :Mn,
                                        Zn= :Zn,
                                        B = :B,
                                        Data_cadastro = :Data_cadastro
				WHERE Id = :Id ';
        try {
            $conn = getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':N' => $planta->N,
                ':C' => $planta->C,
                ':P' => $planta->P,
                ':K' => $planta->K,
                ':Ca' => $planta->Ca,
                ':Mg' => $planta->Mg,
                ':S' => $planta->S,
                ':Cu' => $planta->Cu,
                ':Fe' => $planta->Fe,
                ':Mn' => $planta->Mn,
                ':Zn' => $planta->Zn,
                ':B' => $planta->B,
                
                ':Data_cadastro' => date("Y-m-d H:i:s"),
                ':Id' => (int) $planta->Id
            ));
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Função que realiza a atualização da amostra quando o boletim for deletado.
     * Faz a atualização da amostra e prepara o ID Boletim para NULO, tornando disponível para inserção em outro boletim.
     * @param int $id_amostra ID da amostra que vai ser deslincada.
     * @access public
     */
    function deslincar_boletim_amostra($id_amostra) {
        $sql = 'UPDATE planta SET Id_boletim = :Id_boletim WHERE Id = :Id';

        try {
            $conn = getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':Id_boletim' => isset($id_amostra) ? $id_boletim : null,
                ':Id' => (int) $id_amostra
            ));
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Função que deleta uma amostra especifica de acordo com o ID informado.
     * @param int $id ID do Planta
     * @access public
     * @return int Retorna 1 caso seje efetuado com sucesso, senão Nulo e mensagem de erro.
     */
    function deletar($id) {
        try {
            if (!is_numeric($id))
                return;
            $sql = "DELETE FROM planta WHERE Id=$id";
            $conn = getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return null;
        }
    }

}
