<?php

namespace App\Model;

use Core\Debug\Debug;
use Core\Model\Model;

class ImageModel extends Model
{
    public function FindImagesWithId($id) {
        return
        $this->json_query("
        SELECT contenu, date from {$this->table}
        where user_id = ?
        ", [$id]);
    }

    public function json_all() {
        return $this->json_query("
        SELECT contenu, date, user_id, user.pseudo from {$this->table}
        LEFT JOIN user on image.user_id = user.id;");
    }
}