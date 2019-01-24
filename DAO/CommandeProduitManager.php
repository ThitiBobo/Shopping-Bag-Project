<?php
  namespace DAO;
  use models\Model;
  use models\CommandeProduit;
  use persistent\Bdd;
  use PDO;
  include_once('../persistent/Bdd.php');
  include_once('../models/CommandeProduit.php');
  include_once('DAOBase.php');
  include_once('CommandeManager.php');
  include_once('ProduitManager.php');
  /**
   *
   */
  class CommandeProduitManager extends DAOBase
  {

    function __construct(Bdd $db){
      parent::__construct($db);
    }

    public function add(Model $obj){
      for ($i = 0; $i < sizeof($obj->produits); $i++) {
        $query = $this->db->preparation('
          INSERT INTO commande(id_commande, id_produit, quantite)
          VALUES(:idCommande, :idProduit, :quantite)');
        $query->bindValue(':idCommande', $obj->commande->id, PDO::PARAM_STR);
        $query->bindValue(':idProduit', $obj->produits[i]->id, PDO::PARAM_STR);
        $query->bindValue(':quantite', $obj->quantitees[i]->id, PDO::PARAM_STR);
        $this->db->execution($query);
      }
      return $obj;
    }

    public function delete(Model $obj){
      $q = $this->db->requete('DELETE FROM commande_produit WHERE id_commande = '.$obj->id);
      $this->db->execution($q);
    }

    public function get($id){
      $id = (int) $id;
      $q = $this->db->requete('
        SELECT * FROM commande_produit WHERE id_commande = '.$id);
      $commandeProduit = new CommandeProduit();
      $managerCommande = new CommandeManager($this->db);
      $managerProduit = new ProduitManager($this->db);

      while ($donnees = $q->fetch(PDO::FETCH_ASSOC)){
        array_push($commandeProduit->produits,$managerProduit->get($donnees['id_produit']));
      }

      foreach ($commandeProduit->produits as $pro) {
        echo "produit: " . $pro->id;
      }
      //print_r($commandeProduit);

      return $commandeProduit;
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


  $obj = new CommandeProduitManager(Bdd::getInstance());
  $obj->get(36);
?>
