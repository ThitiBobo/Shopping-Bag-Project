<?php

    use models\Model;
    use models\Utilisateur;
    use DAO\UtilisateurManager;
    use DAO\AdresseManager;
    use persistent\Bdd;

    include_once('../persistent/Bdd.php');
    include_once('../models/Utilisateur.php');
    include_once('../DAO/UtilisateurManager.php');
    include_once('../DAO/AdresseManager.php');


    $obj = new Utilisateur;
    $obj->identifiant = "titi";
    $obj->motDePasse = "toto";
    $obj->nom = "Thibaut";
    $obj->prenom = "depl";
    $obj->telephone = "06 123";
    $obj->email = "thiti@toto.cc";
    $obj->admin = "T";


    $manager = new UtilisateurManager(Bdd::getInstance());
    $managerAdr = new AdresseManager(Bdd::getInstance());

    $adr = $managerAdr->get(33);
    print_r($adr);
    $obj->adresse = $adr;

    echo("camarche");
    $obj = $manager->add($obj);
    $obj->identifiant = "titi".$obj->id;
    $obj->motDePasse = "toto".$obj->id;

    print_r($obj);
    echo("camarche");
    $manager->update($obj);
    echo("camarche");
    print_r($manager->get($obj->id));

    $liste = $manager->getList();
    print_r($liste);

    foreach ($liste as $var) {
      //$manager->delete($var);
    }
 ?>
