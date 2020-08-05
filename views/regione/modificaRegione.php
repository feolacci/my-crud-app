<section id="modificaRegione">

  <div class="container">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="titolo">Modifica regione</h4>
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