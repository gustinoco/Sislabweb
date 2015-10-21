<?php

include_once __DIR__ . '/../conf/conexao.php';

class Solo {

    public $Id;
    public $Phcacl2;
    public $Al;
    public $Ca;
    public $Mg;
    public $Hal3;
    public $Kmgdm3;
    public $Fator;
    public $Pmehl;
    public $Presin;
    public $Cu;
    public $Fe;
    public $Mn;
    public $Zb;
    public $B;
    public $Normalidade;
    public $Massa;
    public $Vol_gasto;
    public $Dicromato;
    public $Toc;
    public $Leitura1;
    public $Temp1;
    public $Leitura2;
    public $Temp2;
    public $Data_cadastro;
    public $Pesquisador;
    public $Identificacao;
    public $Rotina;
    public $Mo;
    public $Micro;
    public $Textura;
    public $Id_boletim;

    function mapear($args) {
        if (is_array($args)) {
            $this->Id = $args['Id'];
            $this->Phcacl2 = $args['Phcacl2'];
            $this->Al = $args['Al'];
            $this->Ca = $args['Ca'];
            $this->Mg = $args['Mg'];
            $this->Hal3 = $args['Hal3'];
            $this->Kmgdm3 = $args['Kmgdm3'];
            $this->Fator = $args['Fator'];
            $this->Pmehl = $args['Pmehl'];
            $this->Presin = $args['Presin'];
            $this->Cu = $args['Cu'];
            $this->Fe = $args['Fe'];
            $this->Mn = $args['Mn'];
            $this->Zn = $args['Zn'];
            $this->B = $args['B'];
            $this->Normalidade = $args['Normalidade'];
            $this->Massa = $args['Massa'];
            $this->Vol_gasto = $args['Vol_gasto'];
            $this->Dicromato = $args['Dicromato'];
            $this->Toc = $args['Toc'];
            $this->Leitura1 = $args['Leitura1'];
            $this->Temp1 = $args['Temp1'];
            $this->Leitura2 = $args['Leitura2'];
            $this->Temp2 = $args['Temp2'];
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
            $this->Kmgdm3 = $args->Kmgdm3;
            $this->Fator = $args->Fator;
            $this->Pmehl = $args->Pmehl;
            $this->Presin = $args->Presin;
            $this->Cu = $args->Cu;
            $this->Fe = $args->Fe;
            $this->Mn = $args->Mn;
            $this->Zn = $args->Zn;
            $this->B = $args->B;
            $this->Normalidade = $args->Normalidade;
            $this->Massa = $args->Massa;
            $this->Vol_gasto = $args->Vol_gasto;
            $this->Dicromato = $args->Dicromato;
            $this->Toc = $args->Toc;
            $this->Leitura1 = $args->Leitura1;
            $this->Temp1 = $args->Temp1;
            $this->Leitura2 = $args->Leitura2;
            $this->Temp2 = $args->Temp2;
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

    function contador_amostra($id) {

        $conn = getConexao();
        $sql = "SELECT count(id) FROM Solo where Id_boletim = " . $id;
        $result = $conn->prepare($sql);
        $result->execute();
        $boletim = $result->fetch(PDO::FETCH_ASSOC);

        return (int) $boletim;
    }
    
    
    function salvar_nulo($id,$Pesquisador,$id_boletim) {
        try {
            $conn = getConexao();
            $sql = "INSERT INTO SOLO (Id, Pesquisador, Data_cadastro, Id_boletim)
					       VALUES (:Id, :Pesquisador, :Data_cadastro, :Id_boletim)";

            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':Id' => (int) $id,
                ':Pesquisador' => $Pesquisador,
                ':Id_boletim' => (int) $id_boletim,
                ':Data_cadastro' => date("Y-m-d H:i:s")
            ));
            //retorna id da inserção
        } catch (PDOException $e) {
            echo '<i>Não foi possível salvar a leitura do Solo, Tente novamente!</i>';
            echo 'Error: ' . $e->getMessage();
        }
    }

    function salvar($solo) {
        try {
            $conn = getConexao();
            $sql = "INSERT INTO SOLO (Phcacl2, Al, Ca, Mg, Hal3, Kmgdm3, Fator, Pmehl, Presin, Cu, Fe, Mn, Zn, B, Normalidade, Massa, Vol_gasto, Dicromato, Toc, Leitura1, Temp1, Leitura2, Temp2, Data_cadastro, Pesquisador)
					       VALUES (:Phcacl2, :Al, :Ca, :Mg, :Hal3, :Kmgdm3, :Fator, :Pmehl, :Presin, :Cu, :Fe, :Mn, :Zn, :B, :Normalidade, :Massa, :Vol_gasto, :Dicromato, :Toc, :Leitura1, :Temp1, :Leitura2, :Temp2, :Data_cadastro, :Pesquisador)";

            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':Phcacl2' => $solo->Phcacl2,
                ':Al' => $solo->Al,
                ':Ca' => $solo->Ca,
                ':Mg' => $solo->Mg,
                ':Hal3' => $solo->Hal3,
                ':Kmgdm3' => $solo->Kmgdm3,
                ':Fator' => $solo->Fator,
                ':Pmehl' => $solo->Pmehl,
                ':Presin' => $solo->Presin,
                ':Cu' => $solo->Cu,
                ':Fe' => $solo->Fe,
                ':Mn' => $solo->Mn,
                ':Zn' => $solo->Zn,
                ':B' => $solo->B,
                ':Normalidade' => $solo->Normalidade,
                ':Massa' => $solo->Massa,
                ':Vol_gasto' => $solo->Vol_gasto,
                ':Dicromato' => $solo->Dicromato,
                ':Toc' => $solo->Toc,
                ':Leitura1' => $solo->Leitura1,
                ':Temp1' => $solo->Temp1,
                ':Leitura2' => $solo->Leitura2,
                ':Temp2' => $solo->Temp2,
                ':Pesquisador' => $solo->Pesquisador,
                ':Data_cadastro' => date("Y-m-d H:i:s")
            ));
            //retorna id da inserção
        } catch (PDOException $e) {
            echo '<i>Não foi possível salvar a leitura do Solo, Tente novamente!</i>';
            echo 'Error: ' . $e->getMessage();
        }
    }

    function salvar_boletins($solo, $id_boletim) {
        $sql = 'UPDATE Solo 
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

    function listar_solo_com_id_boletim_usuario($idBoletim, $usuario) {
        $conn = getConexao();
        $sql = "SELECT * FROM SOLO WHERE Id_Boletim = $idBoletim";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Solo();
            $p->mapear($row);
            $solos[] = $p;
        }
        return $solos;
    }

    function listar_solo_idboletim($idBoletim) {
        $conn = getConexao();
        $sql = "SELECT Id, Data_cadastro, Pesquisador, Identificao, Rotina, Mo, Micro, Textura FROM SOLO WHERE Id_Boletim = " . $idBoletim;
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Solo();
            $p->mapear($row);
            $solos[] = $p;
        }
        return $solos;
    }

    function listar_solo($usuario) {
        $conn = getConexao();
        $sql = "SELECT * FROM SOLO WHERE Pesquisador = '$usuario'";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Solo();
            $p->mapear($row);
            $solos[] = $p;
        }
        return $solos;
    }

    function listar_boletins($a) {
        $conn = getConexao();
        $sql = "SELECT Id, Pesquisador FROM SOLO WHERE Id_boletim = '$a'";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Solo();
            $p->mapear($row);
            $solos[] = $p;
        }
        return $solos;
    }

    function lista_ultimo_id() {

        $conn = getConexao();
        $sql = "SELECT MAX(Id) AS MaximoId FROM SOLO";
        $result = $conn->prepare($sql);
        $result->execute();
        $solo = $result->fetch(PDO::FETCH_ASSOC);

        return $solo;
    }
    
    

    function listar_basico_solo() {
        $conn = getConexao();
        $sql = "SELECT * FROM SOLO WHERE Id_boletim IS NULL and Pesquisador IS NOT NULL ORDER BY Id DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Solo();
            $p->mapear($row);
            $solos[] = $p;
        }
        return $solos;
    }
    
     function listar_todos_solo() {
        $conn = getConexao();
        $sql = "SELECT * FROM SOLO ORDER BY Id DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Solo();
            $p->mapear($row);
            $solos[] = $p;
        }
        return $solos;
    }


    function editar($solo) {
        $sql = 'UPDATE SOLO 
				SET 
					Phcacl2 = :Phcacl2,
					Al = :Al,
					Ca = :Ca,
					Mg = :Mg,
					Hal3 = :Hal3,
					Kmgdm3 = :Kmgdm3,
					Fator = :Fator,
					Pmehl = :Pmehl,
					Presin = :Presin,
					Cu = :Cu,
					Fe= :Fe,
                                        Mn= :Mn,
                                        Zn= :Zn,
                                        B = :B,
                                        Normalidade = :Normalidade,
                                        Massa = :Massa,
                                        Vol_gasto = :Vol_gasto,
                                        Dicromato = :Dicromato,
                                        Toc = :Toc,                                     
                                        Leitura1 = :Leitura1,
                                        Temp1 = :Temp1,
                                        Leitura2 = :Leitura2,
                                        Temp2 = :Temp2,
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
                ':Kmgdm3' => $solo->Kmgdm3,
                ':Fator' => $solo->Fator,
                ':Pmehl' => $solo->Pmehl,
                ':Presin' => $solo->Presin,
                ':Cu' => $solo->Cu,
                ':Fe' => $solo->Fe,
                ':Mn' => $solo->Mn,
                ':Zn' => $solo->Zn,
                ':B' => $solo->B,
                ':Normalidade' => $solo->Normalidade,
                ':Massa' => $solo->Massa,
                ':Vol_gasto' => $solo->Vol_gasto,
                ':Dicromato' => $solo->Dicromato,
                ':Toc' => $solo->Toc,
                ':Leitura1' => $solo->Leitura1,
                ':Temp1' => $solo->Temp1,
                ':Leitura2' => $solo->Leitura2,
                ':Temp2' => $solo->Temp2,
                ':Data_cadastro' => date("Y-m-d H:i:s"),
                ':Id' => (int) $solo->Id
            ));
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function deslincar_boletim_amostra($id_amostra) {
        $sql = 'UPDATE SOLO SET Id_boletim = :Id_boletim WHERE Id = :Id';
        
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

    function deletar($id) {
        try {
            if (!is_numeric($id))
                return;
            $sql = "DELETE FROM SOLO WHERE Id=$id";
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
