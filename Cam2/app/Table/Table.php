<?php


namespace App\Table;


use App\App;

class Table
{

    /*
     * recupere tout dans une DB
     */
    public static function all() {
        return static::query("
        SELECT * from " . static::$table . "
        ");
    }

    /*
     * methode magique pour appeler directement $post->url et $post->extrait
     * retourne la fonction
     */
    public function __get($key)
    {
        $method = 'get_' . $key;
        $this->$key = $this->$method();
        return $this->$key;
    }

    public static function find($id) {
        return static::query("
        SELECT * from " . static::$table . " 
        WHERE id = ?
        ", [$id], true);
    }

    /*
     * requete SQL pour alleger le code dans les enfants
     */
    public static function query($statement, $attributes = null, $one = false){
        if ($attributes) {
            return App::getDB()->prepare($statement, $attributes, get_called_class(), $one);
        }
        else {
            return App::getDB()->query($statement, get_called_class(), $one);
        }
    }

}