<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 01/03/2017
 * Time: 02:00
 */

namespace Core\HTML;

class BootstrapForm extends Form
{

    /**
     * creation input
     * @param $name
     * @return string
     */
    public function input($name, $label, $options = [])
    {
        $type = isset($options['type']) ? $options['type'] : 'text';
        $label = '<label>' . $label . '</label>';
        if ($type === 'textarea') {
            $input = '<textarea type="' . $type . '"
              name="' . $name . '"
              class="form-control">'
                . $this->getValue($name) .
              '</textarea>';
        }
        else {
            $input = '<input type="' . $type . '"
              name="' . $name . '"
              value="' . $this->getValue($name) . '"
              class="form-control"
              >';
        }
        return $this->surround($label . $input);
    }

    public function input_required($name, $label, $options = [])
    {
        $type = isset($options['type']) ? $options['type'] : 'text';
        $label = '<label>' . $label . '</label>';
        if ($type === 'textarea') {
            $input = '<textarea type="' . $type . '"
              name="' . $name . '"
              class="form-control" required>'
                . $this->getValue($name) .
                '</textarea>';
        }
        else {
            $input = '<input type="' . $type . '"
              name="' . $name . '"
              value="' . $this->getValue($name) . '"
              class="form-control"
              required>';
        }
        return $this->surround($label . $input);
    }

    public function select($name, $label, $options) {
        $label = '<label>' . $label . '</label>';
        $input = '<select class="form-control" name="' . $name . '">';
        foreach ($options as $k => $v) {
            $attributes = '';
            if($k == $this->getValue($name))
                $attributes = 'selected';
            $input .= "<option value='$k'$attributes>$v</option>";
        }
        $input .= '</select>';
        return $this->surround($label . $input);
    }

    /**
     * entoure la sortie
     * @param $html
     * @return string
     */
    protected function surround($html)
    {
        return "<div class=\"form-group\">{$html}</div>";
    }

    /**
     * creation Boutton
     * @return string
     */
    public function submit()
    {
        return $this->surround('<button type="submit" class="btn btn-primary">Envoyer</button>');
    }
}