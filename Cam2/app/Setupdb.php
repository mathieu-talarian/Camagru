<?php
namespace App;

class Setupdb {

  private $dbh;
  private $user = "mmoullec";
  private $pass = "";

 public function createdb ($user, $pass) {
    try {
      $this->dbh = new \PDO('mysql:host=localhost', $user, $pass);
}
      catch (\PDOException $e) {
  print "Erreur !: " . $e->getMessage() . "<br/>";
  die();
    }
    if (isset($this->dbh)) {
      $this->dbh->query('CREATE database if not exists camagru_db');
    }
  }

  public function get_dbh() {
    return ($this->dbh);
  }
}

 ?>
