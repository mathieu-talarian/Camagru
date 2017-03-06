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
    public function __construct() {
        $this->template = 'default';
        $this->viewPath = ROOT . '/App/Views/';
    }

    protected function loadModel($model_name) {
        $this->$model_name = \App::getInstance()->getModel($model_name);
    }

    public function loggued() {
        return (isset($_SESSION['auth']));
    }
}