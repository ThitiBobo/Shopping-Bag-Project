<?php
    namespace persistent;
    use PDO;
    /**
    * Définition de la classe Base qui crée les liens vers la base de données
    * La classe sera appelée à chaque fois qu'une donnée de la base de données sera nécessaire
    */
    class Bdd
    {
        //----------------------------------------
        //SINGLETON
        //----------------------------------------
        private static $connect = null;
        private $bdd;

        private function __construct()
        {
            $srvName = "localhost";
            $login = "root";
            $password = "";
            $dbName = "shopping_bag_bd";


            //Création d'un lien à la base de données de type PDO
            try{
                $this->bdd = new PDO('mysql:host='.$srvName.';dbname='.$dbName,$login,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e){
                die('Erreur : '.$e->getMessage());
            }
        }

        public static function getInstance() {
            if(is_null(self::$connect)) {
                self::$connect = new Bdd();
            }
            return self::$connect;
        }

        //----------------------------------------
        //FONCTIONS
        //----------------------------------------

        // Permet d'effectuer une requête SQL. Retourne le résultat (s'il y en a un) de la requête sous forme d'objet
        public function requete($req){
            $query = $this->bdd->query($req);
            return $query;
        }

        // Permet de préparer une requête SQL. Retourne la requête préparée sous forme d'objet
        public function preparation($req){
            $query = $this->bdd->prepare($req);
            return $query;
        }

        // Permet d'exécuter une requête SQL préparée. Retourne le résultat (s'il y en a un) de la requête sous forme d'objet
        public function execution($query){
            $req = $query->execute();
            return $req;
        }

        // Retourne l'id de la dernière insertion par auto-incrément dans la base de données
        public function dernierIndex(){
            return $this->bdd->lastInsertId();
        }
    }
?>
