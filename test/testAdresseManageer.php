<?php

    use models\Model;
    use models\Adresse;
    use DAO\AdresseManager;
    use persistent\Bdd;

    include_once('../persistent/Bdd.php');
    include_once('../models/Adresse.php');
    include_once('../DAO/AdresseManager.php');


    $obj = new Adresse;
    $obj->adresse = "65 rue du test";
    $obj->complementAdresse = "deuxième étage";
    $obj->codePostal = "69008";
    $obj->ville = "Lyon";

    $manager = new AdresseManager(Bdd::getInstance());

    $manager->add($obj);
    $manager->update($obj);
    print_r($manager->get($obj->id));

    $liste = $manager->getList();
    print_r($liste);

    foreach ($liste as $var) {
      //$manager->delete($var);
    }
 ?>
