<?php

class Header {
  private $name;

  private function set_name() {
    if (isset($_SESSION['name'])) {
      $this->$name = $_SESSION['name'];
      echo 'Bonjour ' . $this->name;
      echo '<a href="mon compte">Mon compte</a>';
    }
    else {
      echo '<a href="connexion">Connectez vous</a>';
    }

  }
  public function afficher() {
    return ($this->set_name());
  }
}
