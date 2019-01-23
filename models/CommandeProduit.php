<?php
  namespace models;
  include_once 'Model.php';
  include_once 'Commande.php';
  include_once 'Produit.php';
  /**
   *
   */
  class CommandeProduit extends Model
  {

    private $commande;
    private $produits;
    private $quantitees;


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
      $this->commande = new Commande();
      $this->produits = array();
      $this->quantite = array();
    }
  }

  new CommandeProduit();
 ?>
