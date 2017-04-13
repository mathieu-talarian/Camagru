<?php

namespace App\Model;

use Core\Debug\Debug;
use Core\Model\Model;

class ImageModel extends Model
{
    public function FindImagesWithId($id) {
        $dt = $this->query("
        SELECT contenu, date from {$this->table}
        where id = ?
        ", [$id], true);
        Debug::getInstance()->vd($dt);
    }
}