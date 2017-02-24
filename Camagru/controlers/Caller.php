<?php

class Caller {
  public function __construct() {
    $uri = null;
    $uri = $_SERVER['REQUEST_URI'];
    return ($uri);
  }

  static function get_uri() {
    $uri = null;
    $uri = $_SERVER['REQUEST_URI'];
    return ($uri);
  }
}
