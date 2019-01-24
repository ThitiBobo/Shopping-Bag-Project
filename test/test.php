<?php

    use models\Model;
    use models\Categorie;
    use DAO\CategorieManager;
    use persistent\Bdd;

    include_once('../persistent/Bdd.php');
    include_once('../models/Categorie.php');
    include_once('../DAO/CategorieManager.php');


    $categorie = new Categorie;
    $categorie->nom = "sedzefrgrttggrgrtrt";
    $categorie->id = "9";

    $obj = new CategorieManager(Bdd::getInstance());
    $obj->add($categorie);

    //print_r($obj->get(14));



    $liste = $obj->getList();
    print_r($liste);
    foreach ($liste as $var) {
      //$obj->delete($var);
    }



 ?>
