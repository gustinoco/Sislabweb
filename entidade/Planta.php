<?php

include __DIR__ . '/../conf/conexao.php';

class Planta {

    public $Id;
    public $Fator;
    public $Vol_gasto;
    public $P;
    public $K;
    public $Ca;
    public $Mg;
    public $S;
    public $Cu;
    public $Fe;
    public $Mn;
    public $Zn;
    public $B;
    public $Data_cadastro;

    function mapear($args) {
        if (is_array($args)) {
            $this->Id = $args['Id'];
            $this->Fator = $args['Fator'];
            $this->Vol_gasto = $args['Vol_gasto'];
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
            $this->Data_cadastro = $args->$args['Data_cadastro'];
        }
        if ($args instanceof stdClass) {
            $this->Id = $args->Id;
            $this->Fator = $args->Fator;
            $this->Vol_gasto = $args->Vol_gasto;
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
            $this->Data_cadastro = $args->Data_cadastro;
        }
    }

    function salvar($planta) {
        try {
            $conn = getConexao();
            $sql = "INSERT INTO PLANTA (Fator, Vol_gasto, P, K, Ca, Mg, S, Cu, Fe, Mn, Zn, B, Data_cadastro)
					       VALUES (:Fator, :Vol_gasto, :P, :K, :Ca, :Mg, :S, :Cu, :Fe, :Mn, :Zn, :B, :Data_cadastro)";

            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':Fator' => $planta->Fator,
                ':Vol_gasto' => $planta->Vol_gasto,
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
                ':Data_cadastro' => $planta->Data_cadastro
            ));
            //retorna id da inserção
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            echo 'alert("Não foi possível salvar a leitura da planta, Tente novamente!  ")';
        }
    }

}
?>
