<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 01/03/2017
 * Time: 02:00
 */

namespace  Core\HTML;

class Form
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var string
     */
    protected $surround = 'p';

    /**
     * BootstrapForm constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * @param $html
     * @return string
     */
    protected function surround($html) {
        return "<{$this->surround}>{$html}</{$this->surround}>";
    }

    /**
     * @param $key
     * @return mixed|null
     */
    protected function getValue($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    /**
     * @param $name
     * @return string
     */
    public function input($name) {
        return $this->surround('<input type="text" 
        name="' . $name . '"
        value="' . $this->getValue($name) . '"
        >');
    }

    /**
     * @return string
     */
    public function submit() {
        return $this->surround('<button type="submit">Envoyer</button>');
    }
}