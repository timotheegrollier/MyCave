  <div
      class="bottleCard container d-flex flex-column align-items-center justify-content-center h-50  col-6 col-sm-3 position-relative">
      <?php
    if (isset($_SESSION['pseudo'])) {
      if ($_SESSION['pseudo'] == "LeCaviste") { ?>
      <a href="?action=delete_bottle&id=<?= $bottle['id'] ?>"><i class="fas fa-times cross position-absolute"></i></a>
      <?php
      }
    } ?>
      <img class="img-fluid rounded" src="public/img/noBg/<?= $bottle['picture'] ?>" alt="<?= $bottle['name'] ?>">
      <h2><?= $bottle['name'] ?></h2>
      <h5><?= $bottle['year'] ?></h5>

      <a href="?action=bottle&id=<?= $bottle['id'] ?>" class="btn btn-dark">Voir
      </a>
  </div>