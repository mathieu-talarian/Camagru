<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 02/03/2017
 * Time: 18:12
 */

namespace Core\Controller;

use Core\Debug\Debug;

class Controller
{
    protected $viewPath;
    protected $template;

    protected function render($view, $variables = []) {
        ob_start();
        extract($variables);
        require($this->viewPath . str_replace('.', '/', $view) . '.php');
        $content = ob_get_clean();
        require($this->viewPath . 'template/' . $this->template . '.php');
    }

    /**
     * Header not found
     */
    protected static function notFound() {
        header("HTTP/1.0 404 Not Found");
        header("Location:index.php?p=404");
        die ('Page Introuvable');
    }

    /**
     * Header Forbidden
     */
    protected static function forbidden() {
        header('HTTP/1.0 403 Forbidden');
        die ('Acces Intedit');
    }
}