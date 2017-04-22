<?php

namespace App\Model;

use Core\Debug\Debug;
use Core\Model\Model;

class ImageModel extends Model
{
    public function FindImagesWithId($id)
    {
        return
            $this->json_query("
        SELECT id, contenu, date from {$this->table}
        where user_id = ?
        ", [$id]);
    }

    public function json_all()
    {
        return $this->json_query("
        SELECT contenu, date, user_id, user.pseudo from {$this->table}
        LEFT JOIN user on image.user_id = user.id;");
    }

    public function json_all_date()
    {
        return $this->json_query("
        SELECT contenu, date, user_id, user.pseudo from {$this->table}
        LEFT JOIN user on image.user_id = user.id ORDER by date;");
    }

    public function all_date()
    {
        return $this->json_query("
        SELECT image.id, contenu, date, user_id, user.pseudo from {$this->table}
        LEFT JOIN user on image.user_id = user.id ORDER by date;", null, false, false);
    }

    public function get_mail($photo_id)
    {
        return $this->query("SELECT user_id, user.mail from {$this->table} LEFT JOIN user on image.user_id = user.id where image.id = ?;", [$photo_id], true);
    }

    public function getDataByPhoto($id) {
        return $this->query("SELECT * from {$this->table} where id = ?", [$id], true);
    }

    public function deletephoto($id) {
        return $this->query("DELETE from {$this->table} where id = ?", [$id]);
    }
}
