<?php
/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 28/02/2017
 * Time: 14:24
 */

namespace App;


class Config
{
    /*
     * variable qui contient l'instance
     */
    private static $_instance;
    /*
     * Enregister les settings dans l'instance
     *
     * le but est d'instancier la class dans une fonction statique qui appelera le constructeur de facon a pouvoir
     * renvoyer des datas
     */
    private $settings = [];

    /*
     * fonction statique qui cree l'instance
     */
    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new Config();
        }
        return self::$_instance;
    }
    /*
     * constructeur;
     */
    public function __construct()
    {
        $this->settings = require dirname(__DIR__) . '/config/config.php';
    }
    /*
     * fonction pour retourner une clé
     */
    public function get($key) {
        if (!isset($this->settings[$key])) {
            return null;
        }
        return $this->settings[$key];

}
}