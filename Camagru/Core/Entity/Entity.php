<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 28/02/2017
 * Time: 20:41
 */

namespace Core\Entity;

use Core\Debug\Debug;

class Entity
{
    public function __get($key) {
        $method = 'get' . ucfirst($key);
        $this->key = $this->$method();
        return $this->key;
    }
}