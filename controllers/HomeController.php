<?php

  use models\Categorie;
  use DAO\CategorieManager;
  use persistent\Bdd;

  include_once('persistent\Bdd.php');
  include_once("DAO\CategorieManager.php");
  include_once("models\Categorie.php");

  function index()
  {
    $manager = new CategorieManager(Bdd::getInstance());
    $categories = $manager->getList();
    ob_start();

    ?>
    <ul class="nav flex-column h6 text-white">
      <?php foreach ($categories as $cate){ ?>
      <li class="nav-item">
        <a class="nav-link" href= "<?php  echo 'Categorie/'.$cate->nom ?>"> <?php ($cate->nom) ?></a>
      </li>
      <?php } ?>
    </ul>
    <?=
    $navbar = ob_get_clean();
    return $navbar;
  }


?>
