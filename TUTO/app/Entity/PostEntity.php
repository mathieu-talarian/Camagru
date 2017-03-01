<?php

/*
 * fais les enregistrements
 * Les tables recuperent les tables entieres,
 * Les entités recuperent les "cases" de la DB en particulier
 *
 */

namespace App\Entity;

use Core\Entity\Entity;

class PostEntity extends Entity{

    public function getUrl() {
        return 'index.php?p=posts.single&id=' . $this->id;
    }

    public function getDate() {
        if (!isset($this->date)) {
            return null;
        }
        $ret = '<p><em>' . $this->date . '</em></p>';
        return $ret;
    }

    public function getExtrait() {
        $html = '<p>' . substr($this->contenu, 0, 50) . '...</p>';
        $html .= '<p><a  href="' . $this->getUrl() . '">Voir la suite</a></p>';
        $html .= $this->getDate();
        return $html;
    }
}