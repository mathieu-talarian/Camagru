<?php

namespace App;


class App
{
    /*
     * creation de constantes pour la methode statique
     * const DB_NAME = 'camagru';
     * const DB_USER = 'root';
     * const DB_PASS = 'root';
     * const DB_HOST = 'localhost';
     * maintenant récuperé grace au fichier config.php
     */

    /*
     * variable qui contient l'instance
     */

    private static $_instance;


    /*
     * fonction qui récupere l'instance
     */
    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    /*
     * variable pour sauvegarder la connection a la DB
     */
    private static $database;

    /*
     * gestion du titre du site
     */
    public $title = 'Camera';

    public static function getTitle() {
        return self::$title;
    }
    public static function setTitle($title) {
        self::$title = $title;
    }


    /*
     * fonction getter DB
     * gestion de la portee des variables;
     *
     */
    public static function getDB() {
        if (self::$database === null) {
            self::$database = new Database(self::DB_NAME, self::DB_USER, self::DB_PASS, self::DB_HOST);
        }
        return self::$database;
    }

    public static function notFound() {
        header("HTTP/1.0 404 Not Found");
        header("Location:index.php?p=404");
    }
}