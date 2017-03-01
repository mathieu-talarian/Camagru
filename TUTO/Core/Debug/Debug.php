<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 28/02/2017
 * Time: 22:10
 */

namespace Core\Debug;

class Debug
{
    public $key = true;
    private static $_instance;

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new Debug;
        }
        return self::$_instance;
    }

    public function v($name, $var) {
        echo '<pre>';
        var_dump($name, $var);
        echo '</pre>';
    }

    public function vd($var) {
        if ($this->key) {
            echo '<pre>';
            var_dump($var);
            echo '</pre>';
        }
    }

    public function divvd($var) {
        echo '<div id="head">';
        self::vd($var);
        echo '</div>';
    }

    public function where() {
        self::vd(__CLASS__);
        self::vd(__METHOD__);
    }

}