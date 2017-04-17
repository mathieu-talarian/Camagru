<?php

namespace App\Entity;

Class ImageEntity extends \Core\Entity\Entity {
    public function to_json() {
        retrun (json_encode($this));
    }
}