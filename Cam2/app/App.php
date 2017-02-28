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
     * fonction getter DB
     */
    public static function getDB() {
        if (self::$database === null) {
            self::$database = new Database(self::DB_NAME, self::DB_USER, self::DB_PASS, self::DB_HOST);
        }
        return self::$database;
    }
}