<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  </head>
  <body>

    <head class="blog-header py-3">
      <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
          <div class="container-fluid">
            <div class="col-4"></div>
            <div class="col-4 text-center">
              <a class="blog-header-logo text-white h1" href="#">Shopping Bag</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
              <?= $connected ?>
            </div>
          </div>
      </nav>
    </head>

    <div class="row">

      <nav class="col-lg-2 col-md-2 bg-secondary">
        <h4 class="text-white text-center"> Nos offre </h4>
        <?= $navbar ?>
      </nav>

      <section class="col-lg-10 col-md-10">
        <?= $content ?>
      </section>

    </div>

  </body>
</html>
