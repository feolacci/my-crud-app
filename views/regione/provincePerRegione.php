<section id="regione">

  <div class="container">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="titolo">Dettaglio della regione: <span class="text-primary"><?= $_GET['id'] ?></span></h4>
        <a href="regione.controller.php?r=deleteRegione&id=<?= $_GET['id'] ?>" class="delete btn btn-sm btn-danger"><i class="fa fa-times"></i>Rimuovi regione</a>
        <a href="regione.controller.php?r=modificaRegione&id=<?= $_GET['id'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i>Modifica regione</a>
      </div>
      <div class="card-body">
        <h5 class="titolo">Province <span class="badge badge-primary"><?= $provinceCount['conteggio']; ?></span></h5>

        <?php if(!isset($province['message'])) { ?>
        <table class= "table table-hover table-bordered">
          <thead>
            <tr>
              <th>Sigla</th>
              <th>Provincia</th>
            </tr>
          </thead>
          <tbody>
            <?php
              for($i = 0; $i < count($province); $i++) {
                echo "<tr>";
                echo "<td>" . $province[$i]['provincia_sigla'] . "</td>";
                echo "<td>" . $province[$i]['provincia'] . "</td>";
                echo "</tr>";
              }
            ?>
          </tbody>
        </table>
        <?php
        } else {
          echo $province['message'];
        }
        ?>
      </div>
    </div>
  </div>

  <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Rimuovi regione</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Sei sicuro di voler rimuovere la regione selezionata?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
          <button type="button" class="btn btn-danger">Rimuovi</button>
        </div>
      </div>
    </div>
  </div>

</section>