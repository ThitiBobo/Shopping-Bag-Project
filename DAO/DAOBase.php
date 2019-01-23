<?php
  namespace DAO;
  use models\Model;
  use persistent\Bdd;
  /**
   *
   */
  abstract class DAOBase
  {

    protected $db; // instacne de PDO

    public function setDb(Bdd $db){
      $this->db = $db;
    }

    public function __construct(Bdd $db){
      $this->setDb($db);
    }

    public abstract function add(Model $obj);
    public abstract function delete(Model $obj);
    public abstract function get($id);
    public abstract function getList();
    public abstract function update(Model $obj);

  }


?>
