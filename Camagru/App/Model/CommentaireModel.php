<?php
/**
 * Created by PhpStorm.
 * User: mmoullec
 * Date: 4/18/17
 * Time: 3:19 PM
 */

namespace App\Model;


use Core\Model\Model;

class CommentaireModel extends Model
{
    public function commentaire_by_photo($id) {
        echo $this->json_query("SELECT contenu, photo_id, user_id, date, user.pseudo from {$this->table}
        LEFT JOIN user on commentaire.user_id = user.id where photo_id = ?", [$id]);
    }
}