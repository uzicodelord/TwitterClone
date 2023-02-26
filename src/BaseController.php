<?php

namespace App;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class BaseController {

    protected \Twig\Environment $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('Resources/views');
        $this->twig = new \Twig\Environment($loader);
        $this->twig->addFunction(new \Twig\TwigFunction('path', function($path) {
            return '/' . trim($path, '/');
        }));


    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function view($filename, $vars) {
        $template = $this->twig->load($filename);
        echo $template->render($vars);
    }

    public function returnJSON($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
