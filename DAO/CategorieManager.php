<?php
  namespace DAO;
  use models\Model;
  use models\Categorie;
  use persistent\Bdd;
  use PDO;
  include_once('../persistent/Bdd.php');
  include_once('../models/Categorie.php');
  include_once('DAOBase.php');
  /**
   *
   */
  class CategorieManager extends DAOBase
  {

    function __construct(Bdd $db){
      parent::__construct($db);
    }

    public function add(Model $obj){
      $query = $this->db->preparation('
        INSERT INTO categorie(nom) VALUES(:nom)');
      $query->bindValue(':nom', $obj->nom, PDO::PARAM_STR);

      $this->db->execution($query);
      $obj->id = $this->db->dernierIndex();
      return $obj;
    }

    public function delete(Model $obj){
       $q = $this->db->requete('DELETE FROM categorie WHERE id_categorie = '.$obj->id);
       $this->db->execution($q);
    }

    public function get($id){
      $id = (int) $id;
      $q = $this->db->requete('
        SELECT * FROM categorie WHERE id_categorie = '.$id);
      $donnees = $q->fetch(PDO::FETCH_ASSOC);
      $categorie = new Categorie();
      $categorie->hydrate($donnees);
      return $categorie;
    }

    public function getList(){
      $categories = [];
      $q = $this->db->requete('
        SELECT * FROM categorie ORDER BY id_categorie');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $cate = new Categorie();
      $cate->hydrate($donnees);
      $categories[] = $cate;
    }
    return $categories;
    }

    public function update(Model $obj){
      $q = $this->db->preparation('
      UPDATE categorie SET nom = :nom WHERE id_categorie = :id');

      $q->bindValue(':nom', $obj->nom, PDO::PARAM_STR);
      $q->bindValue(':id', $obj->id, PDO::PARAM_INT);
      $this->db->execution($q);
    }
  }
?>
