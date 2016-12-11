<?php
/**
 * Luan Einhardt
 * Contato: ldseinhardt@gmail.com
 */

namespace App;

/**
 * Classe com métodos básicos para tratar requisições
 */
class Request
{
    private $method;
    private $uri;
    private $accept;
    private $params;
    private $data;

    /**
     * Captura os dados da requisição a partir das váriaveis globais
     */
    function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = explode('?', $_SERVER['REQUEST_URI'])[0];
        $this->origin = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
        $this->accept = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : '';
        $this->params = isset($_GET) ? $_GET : [];
        $this->data = isset($_POST) ? $_POST : [];
    }

    /**
     * Retorna o método (GET, POST, ...)
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Verifica se é uma requisição do tipo GET
     */
    public function isGet()
    {
        return $this->method === 'GET';
    }

    /**
     * Verifica se é uma requisição do tipo POST
     */
    public function isPost()
    {
        return $this->method === 'POST';
    }

    /**
     * Retorna a url (path)
     */
    public function getUrl()
    {
        return $this->uri;
    }

    /**
     * Retorna a url de origem da requisição
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Retorna os formatos aceitos pelo navegador
     */
    public function getAccept()
    {
        return $this->accept;
    }

    /**
     * Verifica se a requisição aceita json (Ajax)
     */
    public function isJson()
    {
        return preg_match('/^application\/json/', $this->accept, $matches);
    }

    /**
     * Retorna os parâmetros GET
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Retorna um parâmetro GET pelo nome ou então seu valor default
     */
    public function getParam($param, $default = null)
    {
        return isset($this->params[$param])
            ? $this->params[$param]
            : $default;
    }

    /**
     * Retorna os parâmetros POST
     */
    public function getData()
    {
        return $this->data;
    }
}
