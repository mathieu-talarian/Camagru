<?php
/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 28/02/2017
 * Time: 14:24
 */

namespace Core;


class Config
{
    /**
     * variable qui contient l'instance
     */
    private static $_instance;

    /**
     * Enregister les settings dans l'instance
     *
     * le but est d'instancier la class dans une fonction statique qui appelera le constructeur de facon a pouvoir
     * renvoyer des datas
     */
    private $settings = [];

    /**
     * fonction statique qui cree l'instance
     */
    public static function getInstance($file) {
        if (self::$_instance === null) {
            self::$_instance = new Config($file);
        }
        return self::$_instance;
    }

    /**
     * constructeur récupere le path;
     */
    public function __construct($file)
    {
        $this->settings = require $file;
    }

    /**
     * fonction pour retourner une clé
     */
    public function get($key) {
        if (!isset($this->settings[$key])) {
            return null;
        }
        return $this->settings[$key];
    }
}