
<?php
  if (isset($_GET["connected"])) {
    if ($_GET["connected"] = true) {
      require('views/disconnections_template.php');
    }
  }else {
    require('views/connection_template.php');
  }


if (isset($_GET['action'])) {

}else {
  require("controllers/HomeController.php");
  $navbar = index();
  require('views\template.php');

}





?>
