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

    public function login($pseudo) {
        return $this->query("SELECT passwd from {$this->table} where pseudo = ?", [$pseudo], true);
    }
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

    public function lock_user($mail) {
        $table[] = 1;
        $table[] = $mail;
        return $this->query("UPDATE 
          {$this->table} set locked = ? where mail = ?",
            $table);
    }

    public function unlock($id) {
        return $this->query("UPDATE {$this->table} set locked = 0 where id = ?", [$id]);
    }

    public function locked($mail) {
        return intval($this->query("SELECT locked from user where mail = ?", [$mail], true)->locked);
    }

    public function SelectTokenByPseudo($pseudo) {
        return $this->query("
        SELECT register_token, registered from user
        WHERE pseudo = ?", [$pseudo], true);
    }

    public function TokenWithMail($mail) {
        return $this->query("
        SELECT register_token from {$this->table} where mail = ?", [$mail], true);
    }

    public function allWithMail($mail) {
        return $this->query("
        SELECT * from {$this->table} where mail = ?",
            [$mail], true);
    }

    public function Checklocked($pseudo) {
        return $this->query("
        SELECT locked from {$this->table} where pseudo = ?", [$pseudo], true);
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
        if ($req && $var['pseudo'] === $req->pseudo) {
            if (hash('whirlpool', $var['passwd']) === $req->passwd) {
                if ($req->admin === '1')
                    return true;
            }
        }
        return false;
    }

    public function FindPswdWithId($id) {
        return $this->query("
        SELECT passwd from {$this->table} Where id= ?
        ", [$id], true);
    }

    public function MajPswd ($id, $mdp) {
        $table[] = $mdp;
        $table[] = $id;
        return $this->query ("UPDATE {$this->table} set passwd = ? where id = ?", $table);
    }

    public function all_pseudo($pseudo) {
        return $this->query("SELECT * from {$this->table} where pseudo = ?", [$pseudo], true);
    }

    public function Updatepseudo ($npseudo, $id) {
        $table[0] = $npseudo;
        $table[1] = $id;
        return $this->query("UPDATE {$this->table} set pseudo = ? where id = ?", $table);
    }

    public function Updatename($nnom, $nprenom, $id) {
        $table[0] = $nnom;
        $table[1] = $nprenom;
        $table[2] = $id;
        return $this->query("UPDATE {$this->table} set nom = ?, prenom = ? where id = ?", $table);
    }
}