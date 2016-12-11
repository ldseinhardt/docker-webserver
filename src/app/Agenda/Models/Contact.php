<?php
/**
 * Luan Einhardt
 * Contato: ldseinhardt@gmail.com
 */

namespace Agenda\Models;

use App\MySQL;

/**
 * Classe Model de Contatos
 */
class Contact
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
     * Retorna todos os contatos
     */
    public function all($q = null)
    {
        $search = '';

        if ($q) {
            $q = $this->mysql->scape($q);

            $q = "%{$q}%";

            $search = "
                WHERE (
                    `contacts`.`first_name` LIKE '{$q}' OR
                    `contacts`.`last_name` LIKE '{$q}' OR
                    `emails`.`email` LIKE '{$q}' OR
                    `phones`.`phone` LIKE '{$q}' OR
                    `phone_types`.`label` LIKE '{$q}' OR
                    `organizations`.`name` LIKE '{$q}'
                )
            ";
        }

        $query = $this->mysql->query("
            SELECT
                `contacts`.`id`,
                `contacts`.`first_name`,
                `contacts`.`last_name`,
                CONCAT_WS(' ', `contacts`.`first_name`, `contacts`.`last_name`) as `name`,
                `emails`.`email` AS `email`,
                `phones`.`phone` AS `phone`,
                `phone_types`.`label` AS `phone_label`,
                `organizations`.`name` AS `organization`
            FROM
                `contacts`
                LEFT JOIN `emails` ON (`contacts`.`id` = `emails`.`contact_id` AND `contacts`.`primary_email_id` = `emails`.`id`)
                LEFT JOIN `phones` ON (`contacts`.`id` = `phones`.`contact_id` AND `contacts`.`primary_phone_id` = `phones`.`id`)
                LEFT JOIN `phone_types` ON (`phones`.`type_id` = `phone_types`.`id`)
                LEFT JOIN `organizations` ON (`contacts`.`organization_id` = `organizations`.`id`)
            {$search}
            ORDER BY `id` DESC
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
                `contacts`.`id`,
                `contacts`.`first_name`,
                `contacts`.`last_name`,
                CONCAT_WS(' ', `contacts`.`first_name`, `contacts`.`last_name`) as `name`,
                `contacts`.`primary_email_id`,
                `emails`.`email` AS `email`,
                `contacts`.`primary_phone_id`,
                `phones`.`phone` AS `phone`,
                `phones`.`type_id` AS `phone_type_id`,
                `phone_types`.`label` AS `phone_label`,
                `organizations`.`id` AS `organization_id`,
                `organizations`.`name` AS `organization`,
                `organizations`.`phone` AS `organization_phone`,
                `address`.`address` AS `address`,
                `address`.`zip_code` AS `zip_code`,
                `address`.`district` AS `district`,
                `address`.`city` AS `city`,
                `contacts`.`created`,
                `contacts`.`modified`
            FROM
                `contacts`
                LEFT JOIN `emails` ON (`contacts`.`id` = `emails`.`contact_id` AND `contacts`.`primary_email_id` = `emails`.`id`)
                LEFT JOIN `phones` ON (`contacts`.`id` = `phones`.`contact_id` AND `contacts`.`primary_phone_id` = `phones`.`id`)
                LEFT JOIN `phone_types` ON (`phones`.`type_id` = `phone_types`.`id`)
                LEFT JOIN `organizations` ON (`contacts`.`organization_id` = `organizations`.`id`)
                LEFT JOIN `address` ON (`contacts`.`id` = `address`.`contact_id`)
            WHERE
                `contacts`.`id` = '{$id}'
        ");

        if (!($query && $query->num_rows)) {
            return null;
        }

        $data = $query->fetch_object();

        $data->emails = [];
        $query = $this->mysql->query("
            SELECT
                `emails`.`id`,
                `emails`.`email`
            FROM
                `emails`
                LEFT JOIN `contacts` ON (`emails`.`contact_id` = `contacts`.`id`)
            WHERE
                `emails`.`contact_id` = '{$id}' AND (
                    `contacts`.`primary_email_id` != `emails`.`id` || `contacts`.`primary_email_id` IS NULL
                )
        ");

        if ($query && $query->num_rows) {
            while ($row = $query->fetch_object()) {
                $data->emails[] = $row;
            }
        }

        $data->phones = [];
        $query = $this->mysql->query("
            SELECT
                `phones`.`id`,
                `phones`.`phone`,
                `phones`.`type_id`,
                `phone_types`.`label` AS `phone_label`
            FROM
                `phones`
                LEFT JOIN `contacts` ON (`phones`.`contact_id` = `contacts`.`id`)
                LEFT JOIN `phone_types` ON (`phones`.`type_id` = `phone_types`.`id`)
            WHERE
                `phones`.`contact_id` = '{$id}' AND (
                    `contacts`.`primary_phone_id` != `phones`.`id` || `contacts`.`primary_phone_id` IS NULL
                )
        ");

        if ($query && $query->num_rows) {
            while ($row = $query->fetch_object()) {
                $data->phones[] = $row;
            }
        }

        return $data;
    }

    public function add($data)
    {
        $first_name = $this->mysql->scape(isset($data['first_name']) ? $data['first_name'] : '');
        $last_name = $this->mysql->scape(isset($data['last_name']) ? $data['last_name'] : '');
        $datetime = date('Y-m-d H:i:s');

        $this->mysql->query("
            INSERT INTO `contacts` (`first_name`, `last_name`, `created`, `modified`) VALUE
                ('{$first_name}', '{$last_name}', '{$datetime}', '{$datetime}')
        ");

        $id = $this->mysql->insert_id();

        $this->add_info($id, $data);

        return $id;
    }

    public function update($id, $data)
    {
        $id = $this->mysql->scape($id);

        $first_name = $this->mysql->scape(isset($data['first_name']) ? $data['first_name'] : '');
        $last_name = $this->mysql->scape(isset($data['last_name']) ? $data['last_name'] : '');
        $datetime = date('Y-m-d H:i:s');

        $this->mysql->query("
            UPDATE `contacts` SET
                `first_name` = '{$first_name}',
                `last_name` = '{$last_name}',
                `primary_email_id` = NULL,
                `primary_phone_id` = NULL,
                `organization_id` = NULL,
                `modified` = '{$datetime}'
            WHERE
                `id` = {$id}
        ");

        $this->mysql->query("
            DELETE FROM
                `emails`
            WHERE
                `contact_id` = {$id}
        ");

        $this->mysql->query("
            DELETE FROM
                `phones`
            WHERE
                `contact_id` = {$id}
        ");

        $this->mysql->query("
            DELETE FROM
                `address`
            WHERE
                `contact_id` = {$id}
        ");

        $this->add_info($id, $data);

        return $this->mysql->affected_rows() !== -1;
    }

    public function delete($id)
    {
        $id = $this->mysql->scape($id);

        $this->mysql->multi_query("
            UPDATE `contacts` SET
                `primary_email_id` = NULL,
                `primary_phone_id` = NULL
            WHERE `id` = {$id};

            DELETE FROM
                `emails`
            WHERE
                `contact_id` = {$id};

            DELETE FROM
                `phones`
            WHERE
                `contact_id` = {$id};

            DELETE FROM
                `address`
            WHERE
                `contact_id` = {$id};

            DELETE FROM
                `contacts`
            WHERE
                `id` = {$id}
        ");

        return $this->mysql->affected_rows() !== -1;
    }

    private function add_info($id, $data)
    {
        $organization_id = $this->mysql->scape(isset($data['organization_id']) ? $data['organization_id'] : '');

        if ($organization_id) {
            $this->mysql->query("
                UPDATE `contacts` SET
                    `organization_id` = '{$organization_id}'
                WHERE
                    `id` = {$id}
            ");
        }

        $address = $this->mysql->scape(isset($data['address']) ? $data['address'] : '');
        $zip_code = $this->mysql->scape(isset($data['zip_code']) ? $data['zip_code'] : '');
        $district = $this->mysql->scape(isset($data['district']) ? $data['district'] : '');
        $city = $this->mysql->scape(isset($data['city']) ? $data['city'] : '');

        if ($address || $zip_code || $district || $city) {
            $this->mysql->query("
                INSERT INTO `address` (`contact_id`, `address`, `zip_code`, `district`, `city`) VALUE
                    ({$id}, '{$address}', '{$zip_code}', '{$district}', '{$city}')
            ");
        }

        $length = count(isset($data['phone']) ? $data['phone'] : []);
        if ($length) {
            for ($i = 0; $i < $length; $i++) {
                $index = $i + 1;
                $phone = $this->mysql->scape($data['phone'][$i]);
                $type_id = $this->mysql->scape($data['phone_type_id'][$i]);
                if ($type_id < 1 || $type_id > 3) {
                    $type_id = 1;
                }
                $this->mysql->query("
                    INSERT INTO `phones` (`contact_id`, `id`, `type_id`, `phone`) VALUE
                        ('{$id}', '{$index}', '{$type_id}', '{$phone}')
                ");
            }

            $primary_phone_id = $this->mysql->scape(isset($data['primary_phone_id']) ? $data['primary_phone_id'] : 1);
            if ($primary_phone_id > $length) {
                $primary_phone_id = 1;
            }
            $this->mysql->query("
                UPDATE `contacts` SET
                    `primary_phone_id` = '{$primary_phone_id}'
                WHERE
                    `id` = {$id}
            ");
        }

        $length = count(isset($data['email']) ? $data['email'] : []);
        if ($length) {
            for ($i = 0; $i < $length; $i++) {
                $index = $i + 1;
                $email = $this->mysql->scape($data['email'][$i]);
                $this->mysql->query("
                    INSERT INTO `emails` (`contact_id`, `id`, `email`) VALUE
                        ('{$id}', '{$index}', '{$email}')
                ");
            }

            $primary_email_id = $this->mysql->scape(isset($data['primary_email_id']) ? $data['primary_email_id'] : 1);
            if ($primary_email_id > $length) {
                $primary_email_id = 1;
            }
            $this->mysql->query("
                UPDATE `contacts` SET
                    `primary_email_id` = '{$primary_email_id}'
                WHERE
                    `id` = {$id}
            ");
        }
    }
}
