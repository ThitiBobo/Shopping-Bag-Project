<?php
  namespace DAO;
  use models\Model;
  use models\Commande;
  use persistent\Bdd;
  use PDO;
  include_once('../persistent/Bdd.php');
  include_once('../models/Commande.php');
  include_once('DAOBase.php');
  include_once('UtilisateurManager.php');
  /**
   *
   */
  class CommandeManager extends DAOBase
  {

    function __construct(Bdd $db){
      parent::__construct($db);
    }

    public function add(Model $obj){
      $query = $this->db->preparation('
        INSERT INTO commande(date_commande, statut, session, total, type_paiement, utilisateur_enregistre, id_utilisateur)
        VALUES(:dateCommande, :statut, :session, :total, :typePaiement, :utilisateurEnregistre, :idUtilisateur)');
      $query->bindValue(':dateCommande', $obj->dateCommande, PDO::PARAM_STR);
      $query->bindValue(':statut', $obj->statut, PDO::PARAM_STR);
      $query->bindValue(':session', $obj->session, PDO::PARAM_STR);
      $query->bindValue(':total', $obj->total, PDO::PARAM_STR);
      $query->bindValue(':typePaiement', $obj->typePaiement, PDO::PARAM_STR);
      $query->bindValue(':utilisateurEnregistre', $obj->utilisateurEnregistre, PDO::PARAM_STR);
      $query->bindValue(':idUtilisateur', $obj->utilisateur->id, PDO::PARAM_INT);

      $this->db->execution($query);
      $obj->id = $this->db->dernierIndex();
      return $obj;
    }

    public function delete(Model $obj){
       $q = $this->db->requete('DELETE FROM commande WHERE id_commande = '.$obj->id);
       $this->db->execution($q);
    }

    public function get($id){
      $id = (int) $id;
      $q = $this->db->requete('
        SELECT * FROM commande WHERE id_commande = '.$id);
      $donnees = $q->fetch(PDO::FETCH_ASSOC);
      $commande = new Commande();
      $commande->hydrate($donnees);
      $manager = new UtilisateurManager($this->db);
      $commande->utilisateur = $manager->get($donnees['id_utilisateur']);
      return $commande;
    }

    public function getList(){
      $commandes = [];
      $q = $this->db->requete('
        SELECT * FROM commande ORDER BY id_commande');
      $manager = new UtilisateurManager($this->db);

      while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
      {
        $com = new Commande();
        $com->hydrate($donnees);
        $com->utilisateur = $manager->get($donnees['id_utilisateur']);
        $commandes[] = $com;
      }
      return $commandes;
    }

    public function update(Model $obj){
      $q = $this->db->preparation('
        UPDATE commande SET date_commande = :dateCommande, statut = :statut,
        session = :session, total = :total, type_paiement = :typePaiement,
        utilisateur_enregistre = :utilisateurEnregistre, id_utilisateur = :idUtilisateur
        WHERE id_utilisateur = :id');

      $q->bindValue(':dateCommande', $obj->dateCommande, PDO::PARAM_STR);
      $q->bindValue(':statut', $obj->statut, PDO::PARAM_STR);
      $q->bindValue(':session', $obj->session, PDO::PARAM_STR);
      $q->bindValue(':total', $obj->total, PDO::PARAM_STR);
      $q->bindValue(':typePaiement', $obj->typePaiement, PDO::PARAM_STR);
      $q->bindValue(':utilisateurEnregistre', $obj->utilisateurEnregistre, PDO::PARAM_STR);
      $q->bindValue(':idUtilisateur', $obj->utilisateur->id, PDO::PARAM_INT);
      $q->bindValue(':id', $obj->id, PDO::PARAM_INT);

      $this->db->execution($q);
    }
  }
?>
