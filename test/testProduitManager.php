<?php

    use models\Model;
    use models\Produit;
    use DAO\ProduitManager;
    use DAO\CategorieManager;
    use persistent\Bdd;

    include_once('../persistent/Bdd.php');
    include_once('../models/Produit.php');
    include_once('../DAO/ProduitManager.php');
    include_once('../DAO/CategorieManager.php');


    $obj = new Produit;
    $obj->nom = "produit";
    $obj->description = "un produit ";
    $obj->image = "dsfghj";
    $obj->prix = 39.4;


    $manager = new ProduitManager(Bdd::getInstance());
    $managerCate = new CategorieManager(Bdd::getInstance());

    $cate = $managerCate->get(1);
    print_r($cate);
    $obj->categorie = $cate;



    $manager->add($obj);
    $obj->nom = "produit n°".$obj->id;
    $manager->update($obj);
    echo("camarche");
    print_r($manager->get($obj->id));


    $liste = $manager->getList();

    print_r($liste);

    foreach ($liste as $var) {
      //$manager->delete($var);
    }
 ?>
