<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 03/03/2017
 * Time: 01:27
 */
class AppController
{
    public function __construct() {
        $this->template = 'default';
        $this->viewPath = ROOT . '/app/Views/';
    }

    protected function loadModel($model_name) {
        $this->$model_name = \App::getInstance()->getTable($model_name);
    }
}