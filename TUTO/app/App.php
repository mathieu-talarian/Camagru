<?php


/**
 * class factory pour l'application
 * Fonction a tout faire
 */

use Core\Debug\Debug;
use Core\Config;
use Core\Database\MysqlDatabase;

class App
{
    /**
     * @var
     * variable qui contient l'instance
     */
    private static $_instance;

    /**
     * @var
     * Intance privée pour l'instance de la db
     */
    private static $_db_instance;

    /**
     * @var string
     * gestion du titre du site
     */
    public $title = 'Camagru';

    /**
     * @return App
     * fonction qui récupere l'instance
     * On peut maintenant modifier directement les variables publiques grace a l'instance
     */
    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    /**
     * fonction load qui servira a charger tout le programme
     * Autoload des fichiers et session start;
     */
    Public static function load() {
        session_start();
        error_reporting(-1);
        require (ROOT . '/app/Autoloader.php');
        App\autoloader::register();
        require (ROOT . '/Core/Autoloader.php');
        Core\autoloader::register();
        Core\Install::getInstance(self::getInstance()->getDB())->all();
    }

    /**
     * @param $array
     * Setup la DB si n'existe pas
     * install l'admin pour le pas avoir a appeler l'admin une autre fois
     */


    /**
     * @param $name
     * @return mixed
     * Factory pour creer les instances des classes Table (pour recherhes dans db)
     * comme le constructeur de la class Table prend un \App\Database en parametre,
     * on peut lui passer directement depuis la class comme getDB est instancié ici
     */
    public function getTable($name) {
        $class_name = 'App\\Table\\' . ucfirst($name) . 'Table';
        return new $class_name($this->getDB());
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
     * Load un boutton pour retourner a la page home
     */
    public static function home() {
        echo '<div><a href="index.php">Go Back Home</a></div>';
    }

    /**
     * Load un boutton pour retourner a la page home admin
     */
    public static function admin_home() {
        echo '<div><a href="admin.php">Page admin</a></div>';
    }

    public static function login()
    {
        if (!isset($_SESSION['auth'])) {
            echo '<div><a href="index.php?p=login">Login</a></div>';
        }
    }

    public static function logout() {
        if (isset($_SESSION['auth'])) {
            echo '<div><a href="index.php?p=logout">Logout</a></div>';
        }
    }
}