<?php
/**
 * Luan Einhardt
 * Contato: ldseinhardt@gmail.com
 */

namespace App;

/**
 * Classe com métodos básicos para tratar as rotas
 */
class Router
{
    public static $routes = [];

    /**
     * Adiciona uma rota do tipo GET
     */
    public static function get($route, $callback)
    {
        self::add($route, $callback, 'GET');
    }

    /**
     * Adiciona uma rota do tipo POST
     */
    public static function post($route, $callback)
    {
        self::add($route, $callback, 'POST');
    }

    /**
     * Adiciona uma rota
     */
    public static function add($route, $callback, $methods)
    {
        foreach (preg_split('/\s?\|\s?/', $methods) as $method) {
            self::$routes[] = (object) [
                'route' => $route,
                'method' => $method,
                'callback' => $callback
            ];
        }
    }

    /**
     * Verifica qual rota é requisitada e dispara o seu controller
     */
    public static function dispatch($app)
    {
        $request = new Request();
        foreach (self::$routes as $entry) {
            if ($request->getMethod() === strtoupper($entry->method)
                && preg_match($entry->route, $request->getUrl(), $matches)) {
                $args = array_slice($matches, 1);
                $args[] = $app;
                $args[] = $request;
                call_user_func_array($entry->callback, $args);
                return;
            }
        }
        return $app->view();
    }
}
