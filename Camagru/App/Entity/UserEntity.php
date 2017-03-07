<?php


namespace App\Entity;

use Core\Debug\Debug;

class UserEntity extends \Core\Entity\Entity
{

    public function check_pseudo($pseudo) {
        if ($this->pseudo === $pseudo) {
            return 1;
        }
        return 0;
    }

    public function check_mail($mail) {
        if ($this->mail === $mail) {
            return 1;
        }
        return 0;
    }
}