<?php
  namespace models;
  include_once 'Model.php';
  include_once 'Categorie.php';
  /**
   *
   */
  class Produit extends Model
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

    public function hydrate($donnees){
      $this->id = $donnees['id_produit'];
      $this->nom = $donnees['nom'];
      $this->description = $donnees['description'];
      $this->image = $donnees['image'];
      $this->prix = $donnees['prix'];
    }
  }
 ?>
