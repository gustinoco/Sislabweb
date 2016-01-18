<?php

/**
 * Header da classe de Solo
 * 
 * Todas funções e configurações de Solo
 * 
 * @package entidade
 * @subpackage Solo
 * @since 1.0
 *  
 */
include_once __DIR__ . '/../conf/conexao.php'; //include do arquivo de configuração

/**
 * Classe Solo
 * 
 * Todas as funções envolvendo Solo. 
 * 
 * @author Gustavo Tinoco <gustavotinocoo@gmail.com> - Orientador: Edmilson Souza <edmilson.souza@cpao.embrapa.br>
 * @version 1.0
 * @category  Solo
 * @copyright Copyright © 2015, Embrapa - Cpao 
 * @package entidade
 * @subpackage Solo
 * @link       http://implementar
 * @access public
 */
class Solo {

    /**
     * Id do solo
     * @param int $Id Identificação do ID do Solo
     */
    public $Id;

    /**
     * Variável de string do campo Al
     * @param String $Al Campo Input de Al do solo
     */
    public $Al = "";

    /**
     * Variável de string do campo K
     * @param String $K Campo Input de K do solo
     */
    public $K;

    /**
     * Variável de string do campo Phcacl2
     * @param String $Phcacl2 Campo Input de Phcacl2 do solo
     */
    public $Phcacl2;

    /**
     * Variável de string do campo Hal3
     * @param String $Hal3 Campo Input de Hal3 do solo
     */
    public $Hal3;

    /**
     * Variável de string do campo Pmehl
     * @param String $Pmehl Campo Input de Pmehl do solo
     */
    public $Pmehl;

    /**
     * Variável de string do campo Ca
     * @param String $Ca Campo Input de Ca do solo
     */
    public $Ca;

    /**
     * Variável de string do campo Mg
     * @param String $Mg Campo Input de Mg do solo
     */
    public $Mg;

    /**
     * Variável de string do campo Cu
     * @param String $Cu Campo Input de Cu do solo
     */
    public $Cu;

    /**
     * Variável de string do campo Fe
     * @param String $Fe Campo Input de Fe do solo
     */
    public $Fe;

    /**
     * Variável de string do campo Mn
     * @param String Mn Campo Input de Mn do solo
     */
    public $Mn;

    /**
     * Variável de string do campo Zn
     * @param String $Zn Campo Input de Zn do solo
     */
    public $Zn;

    /**
     * Variável de string do campo B
     * @param String $B Campo Input de B do solo
     */
    public $B;

    /**
     * Variável de string do campo Argila
     * @param String $Argila Campo Input de Argila do solo
     */
    public $Argila;

    /**
     * Variável de string do campo Silte
     * @param String $Silte Campo Input de Silte do solo
     */
    public $Silte;

    /**
     * Variável de string do campo Areia
     * @param String $Areia Campo Input de Areia do solo
     */
    public $Areia;

    /**
     * Variável de string do campo Materia_organica
     * @param String $Materia_organica Campo Input de Materia_organica do solo
     */
    public $Materia_organica;

    /**
     * Variável de Tempo que foi cadastrada a amostra de Solo
     * @param TIMESTAMP $Data_cadastro Data de cadastro da amostra de Solo.
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
     * Variável de boolean que verifica o checkbox de Rotina
     * @param boolean $Rotina Data de cadastro do pesquisador
     */
    public $Rotina;

    /**
     * Variável de boolean que verifica o checkbox de Mo
     * @param boolean $Mo Data de cadastro do pesquisador
     */
    public $Mo;

    /**
     * Variável de boolean que verifica o checkbox de Micro
     * @param boolean $Micro Data de cadastro do pesquisador
     */
    public $Micro;

    /**
     * Variável de boolean que verifica o checkbox de Textura
     * @param boolean $Textura Data de cadastro do pesquisador
     */
    public $Textura;

    /**
     * Variável que relaciona o Boletim da amostra
     * @param int $Id_boletim ID do boletim que está cadastrada a amostra. 1:1 no Banco de dados
     */
    public $Id_boletim;

    /**
     * Função que mapeia o solo para objeto da classe.
     * @access public
     * @param Solo $args Objeto com as relações do solo
     */
    function mapear($args) {
        if (is_array($args)) {
            $this->Id = $args['Id'];
            $this->Phcacl2 = $args['Phcacl2'];
            $this->Al = $args['Al'];
            $this->Ca = $args['Ca'];
            $this->Mg = $args['Mg'];
            $this->Hal3 = $args['Hal3'];
            $this->K = $args['K'];
            $this->Pmehl = $args['Pmehl'];
            $this->Cu = $args['Cu'];
            $this->Fe = $args['Fe'];
            $this->Mn = $args['Mn'];
            $this->Zn = $args['Zn'];
            $this->B = $args['B'];
            $this->Materia_organica = $args['Materia_organica'];
            $this->Argila = $args['Argila'];
            $this->Silte = $args['Silte'];
            $this->Areia = $args['Areia'];
            $this->Pesquisador = $args['Pesquisador'];
            $this->Data_cadastro = $args->$args['Data_cadastro'];
            $this->Identificao = $args->$args['Identificao'];
            $this->Rotina = $args->$args['Rotina'];
            $this->Mo = $args->$args['Mo'];
            $this->Micro = $args->$args['Micro'];
            $this->Textura = $args->$args['Textura'];
            $this->Id_boletim = $args->$args['Id_boletim'];
        }
        if ($args instanceof stdClass) {
            $this->Id = $args->Id;
            $this->Phcacl2 = $args->Phcacl2;
            $this->Al = $args->Al;
            $this->Ca = $args->Ca;
            $this->Mg = $args->Mg;
            $this->Hal3 = $args->Hal3;
            $this->K = $args->K;
            $this->Pmehl = $args->Pmehl;
            $this->Cu = $args->Cu;
            $this->Fe = $args->Fe;
            $this->Mn = $args->Mn;
            $this->Zn = $args->Zn;
            $this->B = $args->B;
            $this->Materia_organica = $args->Materia_organica;
            $this->Argila = $args->Argila;
            $this->Areia = $args->Areia;
            $this->Silte = $args->Silte;
            $this->Pesquisador = $args->Pesquisador;
            $this->Data_cadastro = $args->Data_cadastro;
            $this->Identificao = $args->Identificao;
            $this->Rotina = $args->Rotina;
            $this->Mo = $args->Mo;
            $this->Micro = $args->Micro;
            $this->Textura = $args->Textura;
            $this->Id_boletim = $args->Id_boletim;
        }
    }

    /**
     * Função que lista o total de solo de acordo com o ID do boletim
     * @param int $id ID do boletim informado
     * @access public
     * @return int Retona o total de amostras de solo de acordo com o boletim que está relacionado a ele no Banco de dados.
     */
    function contador_amostra($id) {

        $conn = getConexao();
        $sql = "SELECT COUNT(Id) FROM solo WHERE Id_boletim = " . $id;
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
    function salvar_nulo($id, $Pesquisador, $id_boletim, $identificacao, $rotina, $mo, $micro, $textura) {
        try {
            $conn = getConexao();
            $sql = "INSERT INTO solo (Id, Pesquisador, Data_cadastro, Id_boletim,Identificao,Rotina,Mo,Micro,Textura)
					       VALUES (:Id, :Pesquisador, :Data_cadastro, :Id_boletim, :Identificao, :Rotina,:Mo,:Micro,:Textura)";

            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':Id' => (int) $id,
                ':Pesquisador' => $Pesquisador,
                ':Id_boletim' => (int) $id_boletim,
                ':Identificao' => $identificacao,
                ':Data_cadastro' => date("Y-m-d H:i:s"),
                ':Rotina' => $rotina,
                ':Mo' => $mo,
                ':Micro' => $micro,
                ':Textura' => $textura
            ));
        } catch (PDOException $e) {
            echo '<i>Não foi possível salvar a leitura do Solo, Tente novamente!</i>';
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Função que faz o salvamento da amostra individual de Solo no banco de dados
     * @param Solo $solo Objeto solo
     * @access public
     */
    function salvar($solo) {
        try {
            $conn = getConexao();
            $sql = "INSERT INTO solo (Phcacl2, Al, Ca, Mg, Hal3, K, Pmehl, Cu, Fe, Mn, Zn, B, Materia_organica, Argila, Silte, Areia, Data_cadastro, Pesquisador)
					       VALUES (:Phcacl2, :Al, :Ca, :Mg, :Hal3, :K, :Pmehl, :Cu, :Fe, :Mn, :Zn, :B, :Materia_organica, :Argila, :Silte, :Areia, :Data_cadastro, :Pesquisador)";

            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':Phcacl2' => $solo->Phcacl2,
                ':Al' => $solo->Al,
                ':Ca' => $solo->Ca,
                ':Mg' => $solo->Mg,
                ':Hal3' => $solo->Hal3,
                ':K' => $solo->K,
                ':Pmehl' => $solo->Pmehl,
                ':Cu' => $solo->Cu,
                ':Fe' => $solo->Fe,
                ':Mn' => $solo->Mn,
                ':Zn' => $solo->Zn,
                ':B' => $solo->B,
                ':Materia_organica' => $solo->Materia_organica,
                ':Argila' => $solo->Argila,
                ':Silte' => $solo->Silte,
                ':Areia' => $solo->Areia,
                ':Pesquisador' => $solo->Pesquisador,
                ':Data_cadastro' => date("Y-m-d H:i:s")
            ));
        } catch (PDOException $e) {
            echo '<i>Não foi possível salvar a leitura do Solo, Tente novamente!</i>';
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Função que faz a atualização de acordo com o checkbox marcado na criação dos boletins. No arquivo de salvar_formulario_solo  faz o desmembramento dos inputs[MyInputs] e
     * e faz a atualização 1 por 1 de cada amostra, de acordo com o ID da amostra.
     * @param Solo $solo Objeto solo
     * @param int $id_boletim Atualiza a amostra para lincar o ID do boletim.
     * @access public
     */
    function salvar_boletins($solo, $id_boletim) {
        $sql = 'UPDATE solo 
				SET 
   
                                        Id_Boletim = :Id_Boletim,
                                        Rotina = :Rotina,
                                        Mo = :Mo,
                                        Micro = :Micro,
                                        Identificao = :Identificao,
                                        Textura = :Textura
				WHERE Id = :Id';
        try {
            $conn = getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':Id_Boletim' => (int) $id_boletim,
                ':Rotina' => $solo->Rotina,
                ':Mo' => $solo->Mo,
                ':Micro' => $solo->Micro,
                ':Identificao' => $solo->Identificao,
                ':Textura' => $solo->Textura,
                ':Id' => (int) $solo->Id
            ));
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Função que lista todos as amostras de acordo com o ID do boletim.
     * @param int $idBoletim Id do boletim informado.
     * @access public
     * @return Solo Retona um array de solos de acordo com o Id do boletim
     */
    function listar_solo_idboletim($idBoletim) {
        $conn = getConexao();
        $sql = "SELECT * FROM solo WHERE Id_boletim = " . $idBoletim;
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Solo();
            $p->mapear($row);
            $solos[] = $p;
        }
        return $solos;
    }

    /**
     * Função que lista todos as amostras de acordo com o pesquisador
     * @param String $pesquisador Login do pesquisador informado.
     * @access public
     * @return Solo Retona um array de solos de acordo com o Pesquisador.
     */
    function listar_solo($pesquisador) {
        $conn = getConexao();
        $sql = "SELECT * FROM solo WHERE Pesquisador = '$pesquisador'";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Solo();
            $p->mapear($row);
            $solos[] = $p;
        }
        return $solos;
    }

    /**
     * Função que lista o último solo inserido
     * @access public
     * @return integer Retona o último ID inserido no Banco de dados.
     */
    function lista_ultimo_id() {
        $conn = getConexao();
        $sql = "SELECT MAX(Id) AS MaximoId FROM solo";
        $result = $conn->prepare($sql);
        $result->execute();
        $solo = $result->fetch(PDO::FETCH_ASSOC);
        return $solo;
    }

    /**
     * Função que lista todos as amostras que não tenham Boletim lincado, e o pesquisador não seje nulo (pois mostrada erro se não fosse inserido isto)
     * @access public
     * @return Solo Retona um array de solos que não tenha boletim e pesquisador seje não nulo.
     */
    function listar_basico_solo() {
        $conn = getConexao();
        $sql = "SELECT * FROM solo WHERE Id_boletim IS NULL AND Pesquisador IS NOT NULL ORDER BY Id DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Solo();
            $p->mapear($row);
            $solos[] = $p;
        }
        return $solos;
    }

    /**
     * Função que lista todos as amostras de solo ordenado por ID descrescente.
     * @access public
     * @return Solo Retona um array de solos.
     */
    function listar_todos_solo() {
        $conn = getConexao();
        $sql = "SELECT * FROM solo ORDER BY Id DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Solo();
            $p->mapear($row);
            $solos[] = $p;
        }
        return $solos;
    }

    /**
     * Função que realiza a edição da amostra do Solo
     * @param Solo $solo Objeto solo
     * @access public
     */
    function editar($solo) {
        $sql = 'UPDATE solo 
				SET 
					Phcacl2 = :Phcacl2,
					Al = :Al,
					Ca = :Ca,
					Mg = :Mg,
					Hal3 = :Hal3,
					K= :K,
					Pmehl = :Pmehl,
					Cu = :Cu,
					Fe= :Fe,
                                        Mn= :Mn,
                                        Zn= :Zn,
                                        B = :B,
                                        Materia_organica = :Materia_organica,
                                        Areia = :Areia,
                                        Silte = :Silte,
                                        Argila = :Argila,
                                        Data_cadastro = :Data_cadastro
				WHERE Id = :Id ';
        try {
            $conn = getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':Phcacl2' => $solo->Phcacl2,
                ':Al' => $solo->Al,
                ':Ca' => $solo->Ca,
                ':Mg' => $solo->Mg,
                ':Hal3' => $solo->Hal3,
                ':K' => $solo->K,
                ':Pmehl' => $solo->Pmehl,
                ':Cu' => $solo->Cu,
                ':Fe' => $solo->Fe,
                ':Mn' => $solo->Mn,
                ':Zn' => $solo->Zn,
                ':B' => $solo->B,
                ':Materia_organica' => $solo->Materia_organica,
                ':Areia' => $solo->Areia,
                ':Silte' => $solo->Silte,
                ':Argila' => $solo->Argila,
                ':Data_cadastro' => date("Y-m-d H:i:s"),
                ':Id' => (int) $solo->Id
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
        $sql = 'UPDATE solo SET Id_boletim = :Id_boletim WHERE Id = :Id';

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
     * @param int $id ID do Solo
     * @access public
     * @return int Retorna 1 caso seje efetuado com sucesso, senão Nulo e mensagem de erro.
     */
    function deletar($id) {
        try {
            if (!is_numeric($id))
                return;
            $sql = "DELETE FROM solo WHERE Id=$id";
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
