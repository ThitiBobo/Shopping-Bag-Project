<?php
  namespace DAO;
  use models\Model;
  use models\Produit;
  use persistent\Bdd;
  use PDO;
  include_once('../persistent/Bdd.php');
  include_once('../models/Produit.php');
  include_once('DAOBase.php');
  include_once('CategorieManager.php');
  /**
   *
   */
  class ProduitManager extends DAOBase
  {

    function __construct(Bdd $db){
      parent::__construct($db);
    }

    public function add(Model $obj){
      $query = $this->db->preparation('
        INSERT INTO produit(nom, description, image, prix, id_categorie)
        VALUES(:nom, :description, :image, :prix, :idCategorie)');
      $query->bindValue(':nom', $obj->nom, PDO::PARAM_STR);
      $query->bindValue(':description', $obj->description, PDO::PARAM_STR);
      $query->bindValue(':image', $obj->image, PDO::PARAM_STR);
      $query->bindValue(':prix', $obj->prix, PDO::PARAM_STR);
      $query->bindValue(':idCategorie', $obj->categorie->id, PDO::PARAM_INT);

      $this->db->execution($query);
      $obj->id = $this->db->dernierIndex();
      return $obj;
    }

    public function delete(Model $obj){
       $q = $this->db->requete('DELETE FROM produit WHERE id_produit = '.$obj->id);
       $this->db->execution($q);
    }

    public function get($id){
      $id = (int) $id;
      $q = $this->db->requete('
        SELECT * FROM produit WHERE id_produit = '.$id);
      $donnees = $q->fetch(PDO::FETCH_ASSOC);
      $produit = new Produit();
      $produit->hydrate($donnees);
      $manager = new CategorieManager($this->db);
      $produit->categorie = $manager->get($donnees['id_categorie']);
      return $produit;
    }

    public function getList(){
      $produits = [];
      $q = $this->db->requete('
        SELECT * FROM produit ORDER BY id_produit');
      $manager = new CategorieManager($this->db);

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $pro = new Produit();
      $pro->hydrate($donnees);
      $pro->categorie = $manager->get($donnees['id_categorie']);
      $produits[] = $pro;
    }
    return $produits;
    }

    public function update(Model $obj){
      $q = $this->db->preparation('
        UPDATE produit SET nom = :nom, description = :description,
        image = :image, prix = :prix, id_categorie = :idCategorie
        WHERE id_produit = :id');

      $q->bindValue(':nom', $obj->nom, PDO::PARAM_STR);
      $q->bindValue(':description', $obj->description, PDO::PARAM_STR);
      $q->bindValue(':image', $obj->image, PDO::PARAM_STR);
      $q->bindValue(':prix', $obj->prix, PDO::PARAM_STR);
      $q->bindValue(':idCategorie', $obj->categorie->id, PDO::PARAM_STR);
      $q->bindValue(':id', $obj->id, PDO::PARAM_INT);

      $this->db->execution($q);
    }
  }
?>
