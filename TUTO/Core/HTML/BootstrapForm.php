<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 01/03/2017
 * Time: 02:00
 */

namespace Core\HTML;

class BootstrapForm extends Form {

    /**
     * entoure la sortie
     * @param $html
     * @return string
     */
    protected function surround($html) {
        return "<div class=\"form-group\">{$html}</div>";
    }

    /**
     * creation input
     * @param $name
     * @return string
     */
    public function input($name) {
        return $this->surround(
            '<label>' . $name . '</label>' .
            '<input type="text"
              name="' . $name . '"
              value="' . $this->getValue($name) . '"
              class="form-control"
              >'
        );
    }

    /**
     * creation Boutton
     * @return string
     */
    public function submit() {
        return $this->surround('<button type="submit" class="btn btn-primary">Envoyer</button>');
    }
}