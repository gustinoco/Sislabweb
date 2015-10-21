<?php

class Sistema {

    public $Nome;

    function mapear($args) {
        if (is_array($args)) {
            $this->Nome = $args['Nome'];
        }
        if ($args instanceof stdClass) {
            $this->Nome = $args->Nome;
        }
    }

    
     function listar_sistemas() {
        $conn = getConexao();
        $sql = "SELECT * FROM SISTEMA";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Sistema();
            $p->mapear($row);
            $sistemas[] = $p;
        }
        return $sistemas;
    }
}

?>