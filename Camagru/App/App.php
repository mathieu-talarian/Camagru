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

    private static $_AppController;

    private static $_db_instance;

    /**
     * @param $name
     * @return mixed
     * Factory pour creer les instances des classes Table (pour recherhes dans db)
     * comme le constructeur de la class Table prend un \App\Database en parametre,
     * on peut lui passer directement depuis la class comme getDB est instancié ici
     */
    public function getModel($name)
    {
        $class_name = 'App\\Model\\' . ucfirst($name) . 'Model';
        return new $class_name($this->getDB());
    }

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
       // error_reporting(-1);
        require (ROOT . '/App/Autoloader.php');
        App\autoloader::register();
        require (ROOT . '/Core/Autoloader.php');
        Core\autoloader::register();
        self::getInstance()->getDB()->InstallDB();
        Core\Install::getInstance(self::getInstance()->getDB())->all();
    }

    public static function getController() {
        if (is_null(self::$_AppController)) {
            self::$_AppController = new App\Controller\AppController();
        }
        return self::$_AppController;
    }
}