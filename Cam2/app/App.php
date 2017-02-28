<?php

namespace App;


class App
{
    /*
     * creation de constantes pour la methode statique
     */
    const DB_NAME = 'camagru';
    const DB_USER = 'root';
    const DB_PASS = 'root';
    const DB_HOST = 'localhost';

    /*
     * variable pour sauvegarder la connection a la DB
     */
    private static $database;

    /*
     * gestion du titre du site
     */
    private static $title = 'Camagru';

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