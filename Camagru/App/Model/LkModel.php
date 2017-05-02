<?php
/**
 * Created by PhpStorm.
 * User: mmoullec
 * Date: 5/2/17
 * Time: 4:44 PM
 */

namespace App\Model;

use Core\Model\Model;
class LkModel extends Model
{
    public function getlikesbyphoto($photo_id) {
        return $this->query ("
        SELECT * from {$this->table} where image_id = ?", [$photo_id]);
    }

    public function userlikeimage($u, $im)
    {
        $tab[] = $u;
        $tab[] = $im;
        return $this->json_query("SELECT * from {$this->table} where user_id = ? and image_id = ?", $tab, false, true);
    }
}