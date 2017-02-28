<?php
namespace App\Table;

Use App\App;

class Article {

    /*
     * recupere les derniers articles
     */

    public static function getLast() {
        return (App::getDB()->query('SELECT * from articles', __CLASS__));
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

    public function get_url() {
        return 'index.php?p=article&id='. $this->id;
    }

    public function get_extrait() {
        $html = '<p>' . substr($this->contenu, 0, 50) . '</p>';
        $html .= '<p><a href="' . $this->get_url() . '">Voir la suite</a></p>';
        return $html;
    }
}

 ?>