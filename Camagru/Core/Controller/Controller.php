<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 02/03/2017
 * Time: 18:12
 */

namespace Core\Controller;

class Controller
{
    protected $viewPath;
    protected $template;

    protected static $_regexp_mail = '#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#';

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
  //      header("Location:index.php?p=Error.notFound");
        die ('Page Introuvable');
    }

    /**
     * Header Forbidden
     */
    protected static function forbidden() {
        header('HTTP/1.0 403 Forbidden');
 //       header('Location: index.php?p=Error.forbidden');
        die ('Acces Intedit');
    }

    public function keys_filled($var) {
        foreach ($var as $k => $v) {
            if ($v === '')
                return 0;
        }
        return 1;
    }

    public function protectform($form) {
        return htmlspecialchars($form);
    }

    public function protect_hash($form) {
        return hash('whirlpool', $this->protectform($form));
    }

//    public function e404() {
//        $error = 'Error 404 not found';
//        return $this->render('errors', compact('error'));
//    }
//
//    public function e403() {
//        $error = 'Error 403 Forbidden';
//        return $this->render('errors', compact('error'));
//    }
}