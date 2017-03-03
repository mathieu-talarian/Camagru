<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 03/03/2017
 * Time: 01:20
 */

use Core\Config;
use Core\Database\MysqlDatabase;

class App
{
    public $_titre = 'Camagru';

    private static $_instance;

    private static $_db_instance;

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    /**
     * @return MysqlDatabase
     * Factory pour creation et connection a la DB + toutes les fonction query/prepare/exec
     */
    public function getDB() {
        if (is_null(self::$_db_instance)) {
            $config = Config::getInstance(ROOT . '/config/config.php');
            self::$_db_instance = new MysqlDatabase(
                $config->get('db_name'),
                $config->get('db_user'),
                $config->get('db_pass'),
                $config->get('db_host')
            );
        }
        return self::$_db_instance;
    }

    /**
     * fonction load qui servira a charger tout le programme
     * Autoload des fichiers et session start;
     */
    Public static function load() {
        session_start();
        session_destroy();
        session_start();
        error_reporting(-1);
        require (ROOT . '/App/Autoloader.php');
        App\autoloader::register();
        require (ROOT . '/Core/Autoloader.php');
        Core\autoloader::register();
        self::getInstance()->getDB()->getPDO();
        Core\Install::getInstance(self::getInstance()->getDB())->all();
    }
}