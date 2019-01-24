<?php
  namespace models;
  include_once 'Model.php';
  include_once 'Utilisateur.php';
  /**
   *
   */
  class Adresse extends Model
  {
    private $id;
    private $adresse;
    private $complementAdresse;
    private $codePostal;
    private $ville;

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
      $this->id = $donnees['id_adresse'];
      $this->adresse = $donnees['adresse'];
      $this->complementAdresse = $donnees['complement_adresse'];
      $this->codePostal = $donnees['code_postal'];
      $this->ville = $donnees['ville'];
    }
  }

?>
