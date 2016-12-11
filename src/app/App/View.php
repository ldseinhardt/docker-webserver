<?php
/**
 * Luan Einhardt
 * Contato: ldseinhardt@gmail.com
 */

namespace App;

/**
 * Classe com métodos básicos para renderizar uma view em seu próprio contexto
 */
class View
{
    private $protocol;
    private $host;
    private $base;
    private $views_path;

    /**
     * Adiciona ao contexto da view seus parâmetros
     */
    function __construct($path, $args)
    {
        $this->views_path = $path;
        foreach ($args as $key => $value) {
            $this->{$key} = $value;
        }

        $this->protocol = 'http';

        if ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
            $this->protocol = 'https';
        }

        $this->host = $_SERVER['HTTP_HOST'];

        $this->base = "{$this->protocol}://{$this->host}/";
    }

    /**
     * Carrega a view (arquivo)
     */
    public function load($filename)
    {
        $matches = explode('.', $filename);
        if (count($matches) === 1) {
            $filename .= '.php';
        }
        require_once $this->views_path . $filename;
    }
}
