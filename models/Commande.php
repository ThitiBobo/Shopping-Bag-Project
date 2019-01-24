<?php
  namespace models;
  include_once 'Model.php';
  include_once 'Utilisateur.php';
  /**
   *
   */
  class Commande extends Model
  {
    private $id;
    private $dateCommande;
    private $statut;
    private $session;
    private $total;
    private $typePaiement;
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

    public function hydrate($donnees){
      $this->id = $donnees['id_commande'];
      $this->dateCommande = $donnees['date_commande'];
      $this->statut = $donnees['statut'];
      $this->session = $donnees['session'];
      $this->total = $donnees['total'];
      $this->typePaiement = $donnees['type_paiement'];
      $this->utilisateurEnregistre = $donnees['utilisateur_enregistre'];
    }
  }

 ?>
