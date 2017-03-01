<?php
/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 28/02/2017
 * Time: 20:37
 */

namespace App\Entity;


use Core\Entity\Entity;

class CategoryEntity extends Entity
{
    public function getUrl() {
        return 'index.php?p=posts.category&id=' . $this->id;
    }

}