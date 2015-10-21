<?php

class Propriedade {

    public $Id;
    public $Nome;
    public $Area;
    public $Localidade;
    public $Municipio;
    public $Estado;
    public $Cliente_id;

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

    function editar($propriedade) {
        $sql = 'UPDATE PROPRIEDADE 
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

    function salvar_propriedades($propriedade, $id_cliente) {
        try {
            $conn = getConexao();
            $sql = "INSERT INTO PROPRIEDADE (Nome, Area, Localidade, Municipio, Estado, Cliente_id)
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

    function contador_propriedade($id) {

        $conn = getConexao();
        $sql = "SELECT count(id) FROM PROPRIEDADE where Cliente_id = " . $id;
        $result = $conn->prepare($sql);
        $result->execute();
        $propriedade = $result->fetch(PDO::FETCH_ASSOC);

        return (int) $propriedade;
    }

function listar_propriedades_cliente($idCliente) {
        $conn = getConexao();
        $sql = "SELECT * FROM PROPRIEDADE WHERE Cliente_id = " . $idCliente;
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Propriedade();
            $p->mapear($row);
            $propriedades[] = $p;
        }
        return $propriedades;
    }
    
    
    function listar_propriedade_especifica($id) {
        $conn = getConexao();
        $sql = "SELECT * FROM PROPRIEDADE WHERE Id = " . $id;
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Propriedade();
            $p->mapear($row);
            $propriedade = $p;
        }
        return $propriedade;
    }

    function contador_amostra($id) {

        $conn = getConexao();
        $sql = "SELECT COUNT(Id) FROM Propriedade WHERE Cliente_id = " . $id;
        $result = $conn->prepare($sql);
        $result->execute();
        $propriedade = $result->fetch(PDO::FETCH_ASSOC);

        return (int) $propriedade;
    }

}
