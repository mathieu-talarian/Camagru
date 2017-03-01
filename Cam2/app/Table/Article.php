<?php
namespace App\Table;

Use App\App;

class Article extends Table{

    protected static $table = 'articles';

    /*
     * recupere les derniers articles
     * pour ne pas avoir a recopier tous les articles a chaque fois
     */

    public static function getLast() {
        return self::query("
        SELECT articles.id, articles.titre, articles.contenu, categories.titre as categorie
        from articles 
        left join categories 
        on categorie_id = categories.id");
    }


    public function get_url() {
        return 'index.php?p=article&id='. $this->id;
    }

    public function get_extrait() {
        $html = '<p>' . substr($this->contenu, 0, 50) . '</p>';
        $html .= '<p><a href="' . $this->get_url() . '">Voir la suite</a></p>';
        return $html;
    }

    public static function LastbyCategory($categorie_id) {
        return self::query("
        SELECT articles.id, articles.titre, articles.contenu, categories.titre as categorie
        from articles 
        left join categories 
        on categorie_id = categories.id
        Where categorie_id = ?
        ", [$categorie_id]);
    }

    public static function find($id) {
        return self::query("
        SELECT articles.id, articles.titre, articles.contenu, categories.titre as categorie
        from articles 
        left join categories 
        on categorie_id = categories.id
        Where articles.id = ?
        ", [$id], true);
    }
}

 ?>