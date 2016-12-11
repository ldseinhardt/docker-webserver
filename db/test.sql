-- Luan Einhardt <ldseinhardt@gmail.com>
-- mysql > source test.sql

INSERT INTO `organizations` (`id`, `phone`, `name`) VALUES
  (1, '+555332710001', 'Empresa A'),
  (2, '+555332710002', 'Empresa B'),
  (3, '+555332710003', 'Empresa C'),
  (4, '+555332710004', 'Empresa D'),
  (5, '+555332710005', 'Organização X'),
  (6, '+555332710006', 'Organização Y'),
  (7, '+555332710007', 'Organização Z');

INSERT INTO `contacts` (`id`, `first_name`, `organization_id`, `created`, `modified`) VALUES
  (1, 'Usuário_A', 7, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
  (2, 'Usuário_B', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
  (3, 'Usuário_C', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
  (4, 'Usuário_D', 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
  (5, 'Usuário_E', 7, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
  (6, 'Usuário_F', 6, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
  (7, 'Usuário_G', 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

UPDATE `contacts` SET
  `last_name` = 'LastName'
WHERE `id` = 3;

INSERT INTO `address` (`contact_id`, `address`, `zip_code`, `district`, `city`) VALUES
  (4, 'Rua X, n 4', '96040007', '', 'Pelotas/RS'),
  (7, 'Rua Y, n 7', '96040007', '', 'Pelotas/RS');

INSERT INTO `emails` (`contact_id`, `id`, `email`) VALUES
  (3, 1, 'user+test1@gmail.com'),
  (3, 2, 'user+test2@gmail.com'),
  (6, 1, 'user+test3@gmail.com'),
  (6, 2, 'user+test4@gmail.com'),
  (6, 3, 'user+test5@gmail.com');

INSERT INTO `phones` (`contact_id`, `id`, `type_id`, `phone`) VALUES
  (3, 1, 1, '+555332710001'),
  (3, 2, 2, '+5553984470101'),
  (6, 1, 1, '+555332710002'),
  (6, 2, 2, '+5553984470102');

UPDATE `contacts` SET
  `primary_email_id` = 1,
  `primary_phone_id` = 2
WHERE `id` = 3;

UPDATE `contacts` SET
  `primary_email_id` = 3,
  `primary_phone_id` = 1
WHERE `id` = 6;

SELECT
  *
FROM
  `organizations`;

SELECT
  `contacts`.`id`,
  `contacts`.`first_name`,
  `contacts`.`last_name`,
  `emails`.`email` AS `email`,
  `phones`.`phone` AS `phone`,
  `organizations`.`name` AS `organization`,
  `contacts`.`created`,
  `contacts`.`modified`
FROM
  `contacts`
  LEFT JOIN `emails` ON (`contacts`.`id` = `emails`.`contact_id` AND `contacts`.`primary_email_id` = `emails`.`id`)
  LEFT JOIN `phones` ON (`contacts`.`id` = `phones`.`contact_id` AND `contacts`.`primary_phone_id` = `phones`.`id`)
  LEFT JOIN `organizations` ON (`contacts`.`organization_id` = `organizations`.`id`);

UPDATE `contacts` SET
  `primary_email_id` = NULL
WHERE `id` = 6;

DELETE FROM `emails` WHERE `contact_id` = 6 AND `id` = 3;
