  <div class="bottleCard container d-flex flex-column align-items-center justify-content-center h-50  col-6 col-sm-3">
      <img class="img-fluid rounded" src="public/img/noBg/<?= $bottle['picture'] ?>" alt="">
      <h2><?= $bottle['name'] ?></h2>
      <h5><?= $bottle['year'] ?></h5>

      <a href="?action=bottle&id=<?= $bottle['id'] ?>" class="btn">Voir
      </a>
  </div>