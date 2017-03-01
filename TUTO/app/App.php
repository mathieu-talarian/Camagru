<?php


/*
 * class factory pour l'application
 * Fonction a tout faire
 */

use Core\Config;
use Core\Database\MysqlDatabase;

class App
{
    /*
     * variable qui contient l'instance
     */
    private static $_instance;

    /*
     * Intance privée pour l'instance de la db
     */
    private static $_db_instance;

    /*
     * gestion du titre du site
     */
    public $title = 'Camagru';

    /*
     * fonction qui récupere l'instance
     * On peut maintenant modifier directement les variables publiques grace a l'instance
     */
    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    /*
     * fonction load qui servira a charger tout le programme
     * Autoload des fichiers et session start;
     *
     */
    Public static function load() {
        session_start();
        error_reporting(-1);
        require (ROOT . '/app/Autoloader.php');
        App\autoloader::register();
        require (ROOT . '/Core/Autoloader.php');
        Core\autoloader::register();
    }

    /*
     * Factory pour creer les instances des classes Table (pour recherhes dans db)
     * comme le constructeur de la class Table prend un \App\Database en parametre,
     * on peur lui passer directement depuis la class comme getDB est instancié ici
     */
    public function getTable($name) {
        $class_name = 'App\\Table\\' . ucfirst($name) . 'Table';
        return new $class_name($this->getDB());
    }

    /*
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

    public static function notFound() {
        header("HTTP/1.0 404 Not Found");
        header("Location:index.php?p=404");
        die ('Page Introuvable');
    }

    public static function forbidden() {
        header('HTTP/1.0 403 Forbidden');
        die ('Acces Intedit');
    }

    public static function home() {
        echo '<div><a href="index.php">Go Back Home</a></div>';
    }

    public function install_admin () {
            echo '<div><a href="index.php?p=install.admin">Install admin once</a></div>';
    }
}