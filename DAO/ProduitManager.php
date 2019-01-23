<?php
  namespace DAO;
  use models\Model;
  use persistent\Bdd;
  include_once 'DAOBase.php';
  /**
   *
   */
  class ProduitManager extends DAOBase
  {

    function __construct(Bdd $db){
      parent::__construct($db);
    }

    public function add(Model $obj){
      $query = $this->db->prepare('
        INSERT INTO produit(nom,description,prix,image,id_categorie)
        VALUES(:nom, :description, :prix, :image, :id_categorie)');

      $query->bindValue(':nom', $obj->nom, PDO::PARAM_STR);
      $query->bindValue(':description', $obj->description, PDO::PARAM_STR);
      $query->bindValue(':prix', $obj->prix, PDO::PARAM_STR);
      $query->bindValue(':image', $obj->image, PDO::PARAM_STR);
      $query->bindValue(':id_categorie', $obj->categorie->id, PDO::PARAM_INT);
      $query->execute();
      $obj->id = $this->db->dernierIndex();
      return $obj;
    }

    public function delete(Model $obj){}
    public function get($id){

    }
    public function getList(){}
    public function update(Model $obj){}
  }
?>
