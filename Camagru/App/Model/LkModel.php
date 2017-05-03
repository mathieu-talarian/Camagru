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

    public function likes_by_photo($p_id) {
        return $this->json_query("SELECT *, user.pseudo from {$this->table}
        left join user on lk.user_id = user.id where image_id = ?", [$p_id], false, true);
    }

    public function if_user_like_photo ($p, $u) {
        $tab[] = $u;
        $tab[] = $p;
        return $this->json_query("SELECT * from {$this->table} WHERE user_id = ? and image_id = ?", $tab, false, true);
    }

    public function new_like($p, $u) {
        return $this->query("INSERT into {$this->table} set user_id = ". $u .", image_id = " . $p);
    }

    public function delete_like($p, $u) {
        return $this->query("DELETE from {$this->table} where user_id = " . $u . " and image_id = " . $p);
    }
}