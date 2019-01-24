<?php
  namespace DAO;
  use models\Model;
  use models\Utilisateur;
  use persistent\Bdd;
  use PDO;
  include_once('../persistent/Bdd.php');
  include_once('../models/Utilisateur.php');
  include_once('DAOBase.php');
  include_once('AdresseManager.php');
  /**
   *
   */
  class UtilisateurManager extends DAOBase
  {

    function __construct(Bdd $db){
      parent::__construct($db);
    }

    public function add(Model $obj){
      $query = $this->db->preparation('
        INSERT INTO utilisateur(identifiant, mot_de_Passe, nom, prenom, telephone, email, admin, id_adresse)
        VALUES(:identifiant, :motDePasse, :nom, :prenom, :telephone, :email, :admin, :idAdresse)');
      $query->bindValue(':identifiant', $obj->identifiant, PDO::PARAM_STR);
      $query->bindValue(':motDePasse', $obj->motDePasse, PDO::PARAM_STR);
      $query->bindValue(':nom', $obj->nom, PDO::PARAM_STR);
      $query->bindValue(':prenom', $obj->prenom, PDO::PARAM_STR);
      $query->bindValue(':telephone', $obj->telephone, PDO::PARAM_STR);
      $query->bindValue(':email', $obj->email, PDO::PARAM_STR);
      $query->bindValue(':admin', $obj->admin, PDO::PARAM_STR);
      $query->bindValue(':idAdresse', $obj->adresse->id, PDO::PARAM_INT);

      $this->db->execution($query);
      $obj->id = $this->db->dernierIndex();
      return $obj;
    }

    public function delete(Model $obj){
       $q = $this->db->requete('DELETE FROM utilisateur WHERE id_utilisateur = '.$obj->id);
       $this->db->execution($q);
    }

    public function get($id){
      $id = (int) $id;
      $q = $this->db->requete('
        SELECT * FROM utilisateur WHERE id_utilisateur = '.$id);
      $donnees = $q->fetch(PDO::FETCH_ASSOC);
      $utilisateur = new Utilisateur();
      $utilisateur->hydrate($donnees);
      $manager = new AdresseManager($this->db);
      $utilisateur->adresse = $manager->get($donnees['id_adresse']);
      return $utilisateur;
    }

    public function getList(){
      $utilisateurs = [];
      $q = $this->db->requete('
        SELECT * FROM utilisateur ORDER BY id_utilisateur');
      $manager = new AdresseManager($this->db);

      while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
      {
        $util = new Utilisateur();
        $util->hydrate($donnees);
        $util->adresse = $manager->get($donnees['id_adresse']);
        $utilisateurs[] = $util;
      }
      return $utilisateurs;
    }

    public function update(Model $obj){
      $q = $this->db->preparation('
        UPDATE utilisateur SET identifiant = :identifiant, mot_de_Passe = :motDePasse,
        nom = :nom, prenom = :prenom, telephone = :telephone, email = :email,
        admin = :admin, id_adresse = :idAdresse
        WHERE id_utilisateur = :id');

      $q->bindValue(':identifiant', $obj->identifiant, PDO::PARAM_STR);
      $q->bindValue(':motDePasse', $obj->motDePasse, PDO::PARAM_STR);
      $q->bindValue(':nom', $obj->nom, PDO::PARAM_STR);
      $q->bindValue(':prenom', $obj->prenom, PDO::PARAM_STR);
      $q->bindValue(':telephone', $obj->telephone, PDO::PARAM_STR);
      $q->bindValue(':email', $obj->email, PDO::PARAM_STR);
      $q->bindValue(':admin', $obj->admin, PDO::PARAM_STR);
      $q->bindValue(':idAdresse', $obj->adresse->id, PDO::PARAM_INT);
      $q->bindValue(':id', $obj->id, PDO::PARAM_INT);


      print_r($q);
      $this->db->execution($q);
    }
  }
?>
