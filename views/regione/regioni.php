<section id="regioni">

  <div class="container">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="titolo">Lista delle regioni</h4>
        <a href="regione.controller.php?r=aggiungiRegione" class="btn btn-sm btn-success"><i class="fa fa-plus"></i>Aggiungi regione</a>
      </div>
      <div class="card-body">
        <div class="d-flex align-items-end pb-3">
          <div class="w-100">Trovati <span><?= $regioniCount ?></span> risultati<?php if(isset($_POST['search']) && $_POST['search']) {echo " per <span>" . $_POST['search'] . "</span>";} ?>.</div>
          <div class="flex-shrink-0">

            <form action="regione.controller.php?r=regioni" method="POST">
              <div class="input-group">
                <input name="search" type="search" class="form-control" value="<?php if(isset($_POST['search'])) {echo $_POST['search'];} ?>" placeholder="Cerca...">
                <div class="input-group-append">
                  <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </form>

          </div>
        </div>

        <?php if(!isset($regioni['message'])) { ?>
        <table class= "table table-hover table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Regione</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            for($i = 0; $i < count($regioni); $i++) {
              echo "<tr>";
              echo "<td>" . $regioni[$i]['id_regione'] . "</td>";
              echo "<td>" . $regioni[$i]['regione'] . "</td>";
              echo "<td>
                <a class='btn btn-primary btn-sm' href='regione.controller.php?r=regione&id=" . $regioni[$i]['regione'] . "' data-toggle='tooltip' title='Dettaglio regione'><i class='fa fa-eye'></i></a>
                <a class='btn btn-primary btn-sm' href='regione.controller.php?r=modificaRegione&id=" . $regioni[$i]['regione'] . "' data-toggle='tooltip' title='Modifica regione'><i class='fa fa-pencil'></i></a>
                <a class='deleteRegioneTrigger btn btn-danger btn-sm' href='regione.controller.php?r=deleteRegione&id=" . $regioni[$i]['regione'] . "' data-toggle='tooltip' title='Rimuovi regione'><i class='fa fa-times'></i></a>
              </td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
        <?php
        } else {
          echo $regioni['message'];
        }
        ?>
      </div>
    </div>
  </div>

</section>