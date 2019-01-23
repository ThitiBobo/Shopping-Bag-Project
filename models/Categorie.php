<?php
  namespace models;
  include_once 'Model.php';
  /**
   *
   */
  class Categorie extends Model
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

    public function __construct(){
      $this->id = 0;
    }

    public function hydrate($donnees){
      $this->id = $donnees['id_categorie'];
      $this->nom = $donnees['nom'];
    }
  }
?>
