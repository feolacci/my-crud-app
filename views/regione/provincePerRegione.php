<section id="regione">

  <div class="container">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="titolo">Dettaglio della regione: <span class="text-primary"><?= $_GET['id'] ?></span></h4>
        <a href="regione.controller.php?r=deleteRegione&id=<?= $_GET['id'] ?>" class="deleteRegioneTrigger btn btn-sm btn-danger"><i class="fa fa-times"></i>Rimuovi regione</a>
        <a href="regione.controller.php?r=modificaRegione&id=<?= $_GET['id'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i>Modifica regione</a>
      </div>
      <div class="card-body">
        <div class="d-flex align-items-end pb-3">
          <div class="w-100">
            <h5 class="titolo">Province <span class="badge badge-primary"><?= $provinceCount['conteggio']; ?></span></h5>
          </div>
          <div class="flex-shrink-0">
            <a href="#" class="addProvinciaTrigger btn btn-sm btn-success"><i class="fa fa-plus"></i>Aggiungi provincia</a>
          </div>
        </div>

        <div id="wrapper"></div>
      </div>
    </div>
  </div>

</section>