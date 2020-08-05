<section id="aggiungiRegione">

  <div class="container">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="titolo">Aggiungi regione</h4>
        <a href="regione.controller.php?r=regioni" class="btn btn-sm btn-secondary"><i class="fa fa-chevron-left"></i>Torna indietro</a>
      </div>
      <div class="card-body">
        <?php
          $action = "regione.controller.php?r=addRegione";
          include "_form.php";
        ?>
      </div>
    </div>
  </div>

</section>