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
    public function pseudo($pseudo) {
        return $this->query("
        SELECT pseudo from {$this->table}
        Where pseudo = ?
        ", [$pseudo], true);
    }

    public function FindPseudoWithId($id) {
        return $this->query("
        SELECT pseudo , id from {$this->table}
        Where id = ?
        ", [$id], true);
    }

    public function mail($mail) {
        return $this->query("
        SELECT mail from {$this->table}
        WHERE mail =?", [$mail], true);
    }

    public function SelectTokenByPseudo($pseudo) {
        return $this->query("
        SELECT register_token, registered from user
        WHERE pseudo = ?", [$pseudo], true);
    }

    public function UpdadeRegistered($pseudo) {
        $table[] = 1;
        $table[] = $pseudo;
        return $this->query("UPDATE 
        user SET registered= ? where
        pseudo = ?
        ", $table);
    }

    public function CheckRegistered($pseudo) {
        return $this->query("SELECT registered FROM user WHERE pseudo = ?", [$pseudo], true);
    }

    public function CheckAdmin($var) {
        $req = $this->query("SELECT * FROM USER WHERE pseudo = ?", [$var['pseudo']], true);
        if ($var['pseudo'] === $req->pseudo) {
            if (hash('whirlpool', $var['passwd']) === $req->passwd) {
                if ($req->admin === '1')
                    return true;
            }
        }
        return false;
    }
}