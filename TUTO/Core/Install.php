<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 28/02/2017
 * Time: 23:32
 */
namespace Core;

class Install {



    private static $_instance;

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new Install();
        }
        return self::$_instance;
    }

    public function admin() {
        $req = 'Insert into admin SET name="root", passwd="' . hash('whirlpool', 'root') . '";';

        return ($req);
    }
}