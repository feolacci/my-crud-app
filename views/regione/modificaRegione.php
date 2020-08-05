<section id="modificaRegione">

  <div class="container">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="titolo">Modifica regione</h4>
        <a href="regione.controller.php?r=regione&id=<?= $_GET['id'] ?>" class="btn btn-sm btn-secondary"><i class="fa fa-chevron-left"></i>Torna indietro</a>
      </div>
      <div class="card-body">
        <?php
          $action = "regione.controller.php?r=editRegione&id=" . $nomeRegione["regione"];
          include "_form.php";
        ?>
      </div>
    </div>
  </div>

</section>