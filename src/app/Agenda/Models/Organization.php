<?php
/**
 * Luan Einhardt
 * Contato: ldseinhardt@gmail.com
 */

namespace Agenda\Models;

use App\MySQL;

/**
 * Classe Model de Organizações/Empresas
 */
class Organization
{
    private $mysql;

    /**
     * Cria a conexão com o banco de dados
     */
    function __construct($app)
    {
        $this->mysql = new MySQL($app->get('database'));
    }

    /**
     * Retorna todos as organizações
     */
    public function all($q = null, $l = null)
    {
        $search = '';

        if ($q) {
            $q = $this->mysql->scape($q);

            $q = "%{$q}%";

            $search = "
                WHERE (
                    `name` LIKE '{$q}' OR
                    `phone` LIKE '{$q}'
                )
            ";
        }

        $limit = '';

        if ($l) {
            $l = $this->mysql->scape($l);

            $limit = "
                LIMIT {$l}
            ";
        }

        $query = $this->mysql->query("
            SELECT
                `id`,
                `name`,
                `phone`
            FROM
                `organizations`
            {$search}
            ORDER BY `id` DESC
            {$limit}
        ");

        $data = [];

        if (!($query && $query->num_rows)) {
            return $data;
        }

        while ($row = $query->fetch_object()) {
            $data[] = $row;
        }

        return $data;
    }

    public function get($id)
    {
        $id = $this->mysql->scape($id);

        $query = $this->mysql->query("
            SELECT
                `id`,
                `name`,
                `phone`
            FROM
                `organizations`
            WHERE
                `id` = {$id}
        ");

        return $query && $query->num_rows
            ? $query->fetch_object()
            : null;
    }

    public function add($data)
    {
        $name = $this->mysql->scape(isset($data['name']) ? $data['name'] : '');
        $phone = $this->mysql->scape(isset($data['phone']) ? $data['phone'] : '');

        $this->mysql->query("
            INSERT INTO `organizations` (`name`, `phone`) VALUE
                ('{$name}', '$phone')
        ");

        return $this->mysql->insert_id();
    }

    public function update($id, $data)
    {
        $id = $this->mysql->scape($id);

        $sets = [];
        foreach ($data as $key => $value) {
            $value = $this->mysql->scape($value);
            $sets[] = "`{$key}` = '{$value}'";
        }
        $sets = implode(', ', $sets);

        $this->mysql->query("
            UPDATE `organizations` SET
                {$sets}
            WHERE
                `id` = {$id}
        ");

        return $this->mysql->affected_rows() !== -1;
    }

    public function delete($id)
    {
        $id = $this->mysql->scape($id);

        $this->mysql->query("
            DELETE FROM
                `organizations`
            WHERE
                `id` = {$id}
        ");

        return $this->mysql->affected_rows() !== -1;
    }
}
