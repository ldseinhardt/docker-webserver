<?php
/**
 * Luan Einhardt
 * Contato: ldseinhardt@gmail.com
 */

namespace App;

use MySQLi;

/**
 * Classe para criar uma conexão MySQL
 */
class MySQL
{
    private $mysqli;

    /**
     * Conecta ao banco de dados
     */
    function __construct($db)
    {
        $this->mysqli = new \MySQLi(
            $db['host'], $db['username'], $db['password'], $db['database']
        );
        if (mysqli_connect_errno()) {
            echo '<h1>Erro ao conectar ao banco de dados.</h1>';
            exit();
        }
        $this->mysqli->set_charset($db['charset']);
    }

    /**
     * Desconecta do banco de dados
     */
    function __destruct()
    {
        $this->mysqli->close();
    }

    /**
     * Executa uma consulta
     */
    public function query($sql)
    {
        return $this->mysqli->query($sql);
    }

    /**
     * Executa várias consultas
     */
    public function multi_query($sql)
    {
        return $this->mysqli->multi_query($sql);
    }

    /**
     * Retorna o id da última inserção (auto_incremento)
     */
    public function insert_id()
    {
        return $this->mysqli->insert_id;
    }

    /**
     * Retorna o número de items que foram modificados
     */
    public function affected_rows()
    {
        return $this->mysqli->affected_rows;
    }

    /**
     * Remove possíveis valores que resultariam em um mysql injection
     */
    public function scape($value)
    {
        return $this->mysqli->escape_string($value);
    }
}
