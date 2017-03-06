<?php


namespace App\Entity;

class UserEntity extends \Core\Entity\Entity
{
    public function check_pseudo($pseudo) {
        if ($this->pseudo === $pseudo) {
            return 1;
        }
        return 0;
    }
}