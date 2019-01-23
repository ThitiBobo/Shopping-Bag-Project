<?php
  namespace models;
  include_once 'Adresse.php'
  /**
   *
   */
  class Utilisateur
  {
    private $id;
    private $identifiant;
    private $motDePasse;
    private $nom;
    private $prenom;
    private $telephone;
    private $email;
    private $admin;
    private $adresse;

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
      $this->admin = "f";
      $this->Adresse = new Adresse();
    }
  }

?>
