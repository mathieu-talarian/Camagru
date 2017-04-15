<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 03/03/2017
 * Time: 01:27
 */
namespace App\Controller;

use Core\Controller\Controller;

class AppController extends Controller
{
    /**
     * AppController constructor.
     */
    public function __construct() {
        $this->template = 'default';
        $this->viewPath = ROOT . '/App/Views/';
    }

    /**
     * @param $model_name
     */
    protected function loadModel($model_name) {
        $this->$model_name = \App::getInstance()->getModel($model_name);
    }

    /**
     * @return int
     */
    public function loggued() {
        if (isset($_SESSION['auth'])) {
            if (isset($_SESSION['admin'])) {
                return 2;
            }
            return 1;
        }
        return 0;
    }

    /**
     * @param $page
     */
    public function URL($page)
    {
        $page = explode('.', $page);
        if (isset($page[1])) {
            $action = $page[1];
        }
        $class = ucfirst($page[0]);
        if ($class === 'Home' || $class === 'User' || $class === 'Error' || $class === 'Admin' || $class === 'Register' || $class === 'Restore') {
            $controller = '\App\Controller\\' . $class . 'Controller';
            $controller = new $controller;
            if (method_exists($controller, $action)) {
                return $controller->$action();
            }
        }
        return $this->notFound();
    }

    /**
     * @param array $variables
     * @return string
     */
    protected function header($variables = []) {
        ob_start();
        extract($variables);
        require($this->viewPath . '/template/header.php');
        return (ob_get_clean());
    }

    /**
     * @param array $variables
     * @return string
     */
    public function footer($variables = []) {
        ob_start();
        extract($variables);
        require($this->viewPath . '/template/footer.php');
        return (ob_get_clean());
    }

    /**
     * @param $view
     * @param array $variables
     */
    protected function render($view, $variables = []) {
        ob_start();
        extract($variables);
        require($this->viewPath . str_replace('.', '/', $view) . '.php');
        $content = ob_get_clean();
        $header = $this->header($variables);
        $footer = $this->footer($variables);
        require($this->viewPath . 'template/' . $this->template . '.php');
    }
}