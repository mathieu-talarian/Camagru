<?php

class Inscription {

  public $array = array();

  public function __construct($array = NULL) {
    $this->array = $array;
  }

  public function inscription() {
    $form = new Formulaire('inscription', null, 'post', $this->array, 'p');
    $form->form();
  }
}

 ?>
