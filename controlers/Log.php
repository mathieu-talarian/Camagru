<?php
class Log {

  public $array = array();

  public function __construct($array = NULL) {
      $this->array = $array;
  }


  public function login() {
    $form = new Formulaire('login', null, 'post', $this->array, 'p');
    $form->form();
  }


}
 ?>
