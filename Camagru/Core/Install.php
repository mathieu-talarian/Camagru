<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 28/02/2017
 * Time: 23:32
 */
namespace Core;

use App\Model\UserModel;
use Core\Database\MysqlDatabase;
use Core\Debug\Debug;

class Install
{
    /**
     * @var
     * contiendra les tableaux  de ../config/setup.php;
     */
    private static $_tables;

    /**
     * @var
     * instance
     */
    private static $_instance;

    /** @var
     * recupere une conexion a la DB
     */
    private static $_db;

    /**
     * @return Install
     * retourne l'intance
     * initialise le $_table egalement
     */
    public static function getInstance(MysqlDatabase $db)
    {
        if (self::$_tables === null) {
            $table = require(ROOT . '/Config/setup.php');
            if ($table) {
                self::$_tables = $table;
            }
        }
        if (self::$_db === null) {
            if ($db) {
                self::$_db = $db;
            }
        }
        if (self::$_instance === null) {
            self::$_instance = new Install();
        }return self::$_instance;
    }

    /**
     * mysql =>creation de la DB
     */
    public function database() {
        $req = 'CREATE DATABASE IF NOT EXISTS camagru;';
    }

    /**
     * @param $table_name
     * @param array $colonnes
     * @return string
     * mysql =>creation d'une requete mysql a partir d'un fichier de conf
     */
    protected function create_table($table_name, $colonnes = [])
    {
        if ($table_name) {
            $req = 'CREATE TABLE IF NOT EXISTS '
                . $table_name .
                ' (';
            if (isset($colonnes)) {
                foreach ($colonnes as $k => $v) {
                    $req .= $k . ' ' . $v;
                    if (end($colonnes) !== $v) {
                        $req .= ' , ';
                    }
                }
            }
        }
        $req .= ' );';
        return $req;
    }

    /**
     * @param $array
     * prend en parametre un tableau et en retourne un requete mysql
     */
    protected function Setup($array = [], MysqlDatabase $db) {
        if ($array) {
        if (!isset($_SESSION['setup'])) {
                foreach ($array as $k =>$v) {
                    $setup = $this->create_table($k, $v);
                    $db->exec($setup);
                    $_SESSION['setup'] = 'ok';
                    }
            }
        }
    }

    /**
     * Install l'admin dans la table admin
     */
    protected function Install_admin(MysqlDatabase $db) {
        if (!isset($_SESSION['install_admin'])) {
            $model = new UserModel($db);
            return $model->create(
                [
                    'pseudo' => 'root',
                    'passwd' => hash('whirlpool', 'root'),
                    'mail' => 'root',
                    'registered' => 1,
                    'admin' => 1
                ]
            );

        }
            $_SESSION['install_admin'] = 'ok';
    }

    protected function Install_user(MysqlDatabase $db) {
        if (!isset($_SESSION['install_user'])) {
            $model = new UserModel($db);
            return $model->create(
                [
                    'pseudo' => 'mathmoul',
                    'passwd' => hash('whirlpool', 'flanbis'),
                    'mail' => 'mathieu.moullec@gmail.com',
                    'registered' => 1,
                    'admin' => 0
                ]
            );

        }
    }

    /**
     * A Enlever
     * Installation de all
     */
    public function all() {
        $this->Setup(self::$_tables, self::$_db);
        $this->Install_admin(self::$_db);
        $this->Install_user(self::$_db);
        $_SESSION['install_user'] = 'ok';
        $_SESSION['install_admin'] = 'ok';
    }
}