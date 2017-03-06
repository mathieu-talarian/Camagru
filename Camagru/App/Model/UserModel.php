<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 04/03/2017
 * Time: 17:50
 */

namespace App\Model;


use Core\Debug\Debug;
use Core\Model\Model;

class UserModel extends Model
{

    public function pseudo() {
        return $this->query("
        SELECT pseudo from {$this->table}
        ");
    }

    public function findpseudowithid($id) {
        return $this->query("
        SELECT pseudo , id from {$this->table}
        Where id = ?
        ", [$id]);
    }
}