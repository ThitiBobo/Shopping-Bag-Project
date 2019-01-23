<?php
  namespace models;
  include_once 'Categorie.php';

  /**
   *
   */
  class Produit
  {
    private $id;
    private $nom;
    private $description;
    private $image;
    private $prix;
    private $categorie;

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

    public function __construct(){
      $this->id = 0;
      $this->prix = 0;
      $this->categorie = new Categorie();
    }
  }
 ?>
