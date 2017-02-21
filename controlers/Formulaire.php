<?php
class Formulaire {
    private $method;
    private $id;
    private $action;
    private $p;
    private $array = array();


    public function __construct($id, $action, $method, $array = array(), $p = 'p') {
      $this->id = $id;
      $this->action = $action;
      $this->method = $method;
      $this->array = $array;
      $this->p = $p;
    }

    static function submit() {
      echo '<button type="submit">ENVOYER</button>';
    }

  public function rangement($tag) {

      echo ('<' . $this->p . '>' . $tag . '</' . $this->p . '>');
    }

    public function form() {
      $this::rangement('<form id="' . $this->id . '" action="' . $this->action .'" method="' . $this->method . '">');
      foreach ($this->array as $key => $value)
      {
        $this::rangement($key);
        $this::rangement('<input type="text" id="' . $value . '" name="' . $value .'" value="">');
    }
      $this::submit();
    }
}

 ?>
