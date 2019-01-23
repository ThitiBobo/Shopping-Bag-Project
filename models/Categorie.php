<?php
  namespace models;
  /**
   *
   */
  class Categorie
  {
    private $id;
    private $nom;

    public function __get($property) {
      if (property_exists($this, $property)) {
        return $this->$property;
      }
    }

    public function __set($property, $value) {
      if (property_exists($this, $property)) {
        $this->$property = $value;
      }
      return $this;
    }

    function __construct(){
      $this->id = 0;
    }
  }

?>
