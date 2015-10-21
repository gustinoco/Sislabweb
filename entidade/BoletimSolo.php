<?php

include_once __DIR__ . '/../conf/conexao.php';

class BoletimSolo {

    public $Id;
    public $Pesquisa;
    public $Data_entrada;
    public $Id_cliente;
    public $Valor;
    public $Cultura;
    public $Sistema;
    public $Observacao;
    public $Pesquisador;
    public $Propriedade;
    
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

    
    function lista_boletim() {
        $conn = getConexao();
        $sql = "SELECT * FROM BOLETIM_SOLO";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new BoletimSolo();
            $p->mapear($row);
            $boletim[] = $p;
        }
        return $boletim;
    }
    
      function lista_boletim_edicao($id) {
        $conn = getConexao();
        $sql = "SELECT * FROM BOLETIM_SOLO where Id =". $id;
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new BoletimSolo();
            $p->mapear($row);
            $boletim = $p;
        }
        return $boletim;
    }
    
    
     function listar_boletins($usuario) {
        $conn = getConexao();
        $sql = "SELECT * FROM BOLETIM_SOLO where Pesquisador = '$usuario'";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new BoletimSolo();
            $p->mapear($row);
            $boletins[] = $p;
        }
        return $boletins;
    }
    
    
         function listar_boletim_todos() {
        $conn = getConexao();
        $sql = "SELECT * FROM BOLETIM_SOLO";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new BoletimSolo();
            $p->mapear($row);
            $boletins[] = $p;
        }
        return $boletins;
    }
    function deletar($id_boletim){
		try{
			if(!is_numeric($id_boletim))
				return;
			$conn=getConexao();
			$sql = 'DELETE FROM BOLETIM_SOLO WHERE Id=:boletim_id';
			$stmt = $conn->prepare($sql);
			$stmt->execute(array(':boletim_id'=>$id_boletim));
		}catch(PDOException $e){
			if($e->getCode()==23000){
				echo '<i>Não foi possível deletar a amostra.</i>';
			}
		}
	}
    
    
     function lista_culturas() {
        $conn = getConexao();
        $sql = "SELECT * FROM Cultura";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new BoletimSolo();
            $p->mapear($row);
            $cultura[] = $p;
        }
        return $cultura;
    }
    
    function lista_sistemas() {
        $conn = getConexao();
        $sql = "SELECT * FROM Sistema";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new BoletimSolo();
            $p->mapear($row);
            $sistema[] = $p;
        }
        return $sistema;
    }
    
    function lista_ultimo_id(){
        
           $conn = getConexao();
        $sql = "select max(id) as MaximoId from BOLETIM_SOLO";
        $result = $conn->prepare($sql);
        $result->execute();
        $boletim = $result->fetch(PDO::FETCH_ASSOC);
        
        return $boletim;
    }
        
    
     function editar($boletim) {
        $sql = 'UPDATE BOLETIM_SOLO
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
    
    
    function salvar($boletim) {
        try {
            $conn = getConexao();
            $sql = "INSERT INTO BOLETIM_SOLO (Pesquisa, Data_entrada, Id_cliente, Valor, Cultura, Sistema, Observacao, Pesquisador, Propriedade)
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
    
    
      function verifica_boletim($id_cliente) {
        try {
            $conn = getConexao();
            $sql = "SELECT * FROM BOLETIM_SOLO where Id_cliente = " . $id_cliente;
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
?>