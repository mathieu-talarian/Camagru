<?php
/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 28/02/2017
 * Time: 14:57
 *
 * class pour recuperer les post dans la DB
 */

namespace App\Table;

use Core\Table\Table;


class PostTable extends Table
{
    /*
     * répupere les derniers post;
     * retourne un tableau
     */
    public function last() {
        return $this->query ("
        SELECT post.id, post.titre, post.contenu, post.date, category.titre as categorie
        FROM post
        LEFT JOIN category ON categorie_id = category.id
        ORDER BY post.date DESC
        ");
    }


    /*
     * recupere un article en liant la categorie associee
     * @return array
     */
    public function find($id) {
        return $this->query("
        SELECT post.id, post.titre, post.contenu, category.titre as categorie
        from post
        left join category
        on categorie_id = category.id
        Where post.id = ?
        ", [$id], true);
    }

    /*
     * recupere les deriners posts de la categorie
     * @param $id int
     * @return array
     */
    public function LastbyCategory($categorie_id) {
        return $this->query("
        SELECT post.id, post.titre, post.contenu, category.titre as categorie
        from post 
        left join category
        on categorie_id = category.id
        Where categorie_id = ?
        ORDER by post.date DESC
        ", [$categorie_id]);
    }


}