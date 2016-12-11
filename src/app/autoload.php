<?php
/**
 * Luan Einhardt
 * Contato: ldseinhardt@gmail.com
 */

/**
 * Carrega todas as classes a partir do namespace
 */
spl_autoload_register(function($class) {
    require_once __DIR__ . '/' . str_replace('\\', '/', $class . '.php');
});
