<?php
  namespace DAO;
  use models\Model;
  use models\Adresse;
  use persistent\Bdd;
  use PDO;
  include_once('../persistent/Bdd.php');
  include_once('../models/Adresse.php');
  include_once('DAOBase.php');
  /**
   *
   */
  class AdresseManager extends DAOBase
  {

    function __construct(Bdd $db){
      parent::__construct($db);
    }

    public function add(Model $obj){
      $query = $this->db->preparation('
        INSERT INTO adresse(adresse, complement_adresse, code_postal, ville)
        VALUES(:adresse, :complementAdresse, :codePostal, :ville)');
      $query->bindValue(':adresse', $obj->adresse, PDO::PARAM_STR);
      $query->bindValue(':complementAdresse', $obj->complementAdresse, PDO::PARAM_STR);
      $query->bindValue(':codePostal', $obj->codePostal, PDO::PARAM_STR);
      $query->bindValue(':ville', $obj->ville, PDO::PARAM_STR);

      $this->db->execution($query);
      $obj->id = $this->db->dernierIndex();
      return $obj;
    }

    public function delete(Model $obj){
       $q = $this->db->requete('DELETE FROM adresse WHERE id_adresse = '.$obj->id);
       $this->db->execution($q);
    }

    public function get($id){
      $id = (int) $id;
      $q = $this->db->requete('
        SELECT * FROM adresse WHERE id_adresse = '.$id);
      $donnees = $q->fetch(PDO::FETCH_ASSOC);
      $adresse = new Adresse();
      $adresse->hydrate($donnees);
      return $adresse;
    }

    public function getList(){
      $adresses = [];
      $q = $this->db->requete('
        SELECT * FROM adresse ORDER BY id_adresse');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $adr = new Adresse();
      $adr->hydrate($donnees);
      $adresses[] = $adr;
    }
    return $adresses;
    }

    public function update(Model $obj){
      $q = $this->db->preparation('
        UPDATE adresse SET adresse = :adresse, complement_adresse = :complementAdresse,
        code_postal = :codePostal, ville = :ville  WHERE id_adresse = :id');

      $q->bindValue(':adresse', $obj->adresse, PDO::PARAM_STR);
      $q->bindValue(':complementAdresse', $obj->complementAdresse, PDO::PARAM_STR);
      $q->bindValue(':codePostal', $obj->codePostal, PDO::PARAM_STR);
      $q->bindValue(':ville', $obj->ville, PDO::PARAM_STR);
      $q->bindValue(':id', $obj->id, PDO::PARAM_INT);

      $this->db->execution($q);
    }
  }
?>
