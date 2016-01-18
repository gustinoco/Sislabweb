<?php

/**
 * Arquivo que faz a conexão com o banco de dados
 *
 * @category   Conexão
 * @author Gustavo Tinoco <gustavotinocoo@gmail.com> - Orientador: Edmilson Souza <edmilson.souza@cpao.embrapa.br>
 * @copyright Copyright © 2015, Embrapa - Cpao 
 * @version 1.0
 * @package conf
 * @subpackage conexao
 * @link       http://implementar
 */


// Evita que usuários acesse este arquivo diretamente
//if (!defined('ABSPATH')) exit;
//Constantes para conexão



/**
 * @param Integer $PORT Porta do banco
 * @param String $DB Nome do banco de dados
 * @param String $END Endereço do banco
 * @param String $USER Usuário do BD
 * @param String $PASS Senha do BD
 * @
  */
define("PORT", "3306");
define("DB", "sislabweb");
define("END", "areia.cpao.embrapa.br");
define("USER", "edmilson");
define("PASS", "senha10");

/**
 * Arquivo que faz a conexão com o banco de dados
 *
 * @category   Conexão
 * @author Gustavo Tinoco <gustavotinocoo@gmail.com> - Orientador: Edmilson Souza <edmilson.souza@cpao.embrapa.br>
 * @copyright Copyright © 2015, Embrapa - Agropecuária Oeste 
 * @version 1.0
 * @link       http://implementar
 * @access public
 * @return Connection retorna a conexão com o banco.
 */
function getConexao() {
    $conn = new PDO('mysql:host=' . END . ';port=' . PORT . ';dbname=' . DB . ';charset=utf8', USER, PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

?>