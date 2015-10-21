<?php



class Cultura {

   public $Nome;
    
    function mapear($args) {
        if (is_array($args)) {
            $this->Nome = $args['Nome'];
            
        }
        if ($args instanceof stdClass) {
            $this->Nome = $args->Nome;
            
        }
    }

  
 function listar_culturas() {
        $conn = getConexao();
        $sql = "SELECT * FROM CULTURA";
        $result = $conn->query($sql);
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $p = new Cultura();
            $p->mapear($row);
            $culturas[] = $p;
        }
        return $culturas;
    }
}
?>