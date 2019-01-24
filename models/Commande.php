<?php
  namespace models;
  include_once 'Model.php';
  /**
   *
   */
  class Commande extends Model
  {
    private $id;
    private $date;
    private $status;
    private $session;
    private $total;
    private $typePaiment;
    private $utilisateurEnregistre;
    private $utilisateur;

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
      $this->total = 0;
      $this->utilisateur = new Utilisateur();
    }
  }

 ?>
