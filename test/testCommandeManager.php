<?php

    use models\Model;
    use models\Commande;
    use DAO\CommandeManager;
    use DAO\UtilisateurManager;
    use persistent\Bdd;

    include_once('../persistent/Bdd.php');
    include_once('../models/Commande.php');
    include_once('../DAO/CommandeManager.php');
    include_once('../DAO/UtilisateurManager.php');


    $obj = new Commande;
    $obj->dateCommande = "2018-12-4";
    $obj->statut = "livraison en cours";
    $obj->session = "01F43G24F345F";
    $obj->total = 392.3;
    $obj->typePaiement = "CB";
    $obj->utilisateurEnregistre = "F";

    $manager = new CommandeManager(Bdd::getInstance());
    $managerUtil = new UtilisateurManager(Bdd::getInstance());

    $util = $managerUtil->get(40);
    $obj->utilisateur = $util;

    $manager->add($obj);
    echo("camarche");

    $obj->typePaiement = "CK".$obj->id;
    $manager->update($obj);
    echo("camarche");
    print_r($manager->get($obj->id));

    echo("<p>liste</p>");
    $liste = $manager->getList();
    print_r($liste);

    echo("<p>delete</p>");
    foreach ($liste as $var) {
      //$manager->delete($var);
    }
 ?>
