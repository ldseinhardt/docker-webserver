<?php
/**
 * Luan Einhardt
 * Contato: ldseinhardt@gmail.com
 */

namespace App;

/**
 * Classe com métodos básicos para uma aplicação MVC
 */
class App
{
    private $options;

    /**
     * Adiciona as rotas e seta as configurações padrões
     */
    function __construct($classes)
    {
        foreach ($classes as $class) {
            $class::addRoutes(Router::class);
        }
        $this->options = [
            'views' => '',
            'database' => [
                'host' => 'localhost',
                'username' => '',
                'password' => '',
                'database' => '',
                'charset' => 'utf8'
            ],
            'mimetypes' => []
        ];
    }

    /**
     * Seta alguma configuração da aplicação
     */
    public function set($key, $value)
    {
        $this->options[$key] = $value;
    }

    /**
     * Retorna alguma configuração da aplicação
     */
    public function get($key)
    {
        return $this->options[$key];
    }

    /**
     * Verifica qual controller deve ser executado
     */
    public function router()
    {
        Router::dispatch($this);
    }

    /**
     * Adiciona uma rota estática
     */
    public function on($route, $bases)
    {
        Router::get($route, function($prefix, $filename, $app) use($bases) {
            try {
                $matches = explode('.', $filename);
                if (count($matches) > 1) {
                    foreach ($this->options['mimetypes'] as $ext => $mime_type) {
                        if ($ext === $matches[count($matches) - 1]) {
                            header("Content-Type: {$mime_type}; charset=utf-8");
                            break;
                        }
                    }
                }
                readfile($bases[$prefix] . $filename);
            } catch (Exception $e) {
                $app->view();
            }
        });
    }

    /**
     * Renderiza textos (imprime na saída)
     */
    public function render($text)
    {
        echo $text;
        exit();
    }

    /**
     * Renderiza uma view
     */
    public function view($view = 'error', $args = [])
    {
        try {
            (new View($this->options['views'], $args))->load($view);
            exit();
        } catch (Exception $e) {
            $app->view();
        }
    }


    /**
     * Renderiza um json
     */
    public function json($data)
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit();
    }

    /**
     * Redireciona para alguma rota ou url
     */
    public function redirect($uri)
    {
        header('Location: ' . $uri);
        exit();
    }
}
