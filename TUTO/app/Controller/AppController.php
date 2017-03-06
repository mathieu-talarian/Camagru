<?php
/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 02/03/2017
 * Time: 18:31
 */

namespace App\Controller;


use Core\Controller\Controller;
use Core\Debug\Debug;

class AppController extends Controller
{
    public function __construct()
    {
        $this->template = 'default';
        $this->viewPath = ROOT . '/app/Views/';
    }

    public function loadModel($model_name) {
        $this->$model_name = \App::getInstance()->getTable($model_name);
    }
}