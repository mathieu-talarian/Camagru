<?php

namespace App\Model;

use Core\Model\Model;

class ImageModel extends Model
{
    public function FindImagesWithId($id) {
        return ($this->query("
        SELECT contenu, date from {$this->table}
        where id = ?
        ", [$id], true));
    }
}