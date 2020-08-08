<section id="regione">

  <div class="container">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="titolo">Dettaglio della regione: <span class="text-primary"><?= $_GET['id'] ?></span></h4>
        <a href="regione.controller.php?r=deleteRegione&id=<?= $_GET['id'] ?>" class="delete btn btn-sm btn-danger"><i class="fa fa-times"></i>Rimuovi regione</a>
        <a href="regione.controller.php?r=modificaRegione&id=<?= $_GET['id'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i>Modifica regione</a>
      </div>
      <div class="card-body">

        <div class="d-flex align-items-end pb-3">
          <div class="w-100">
            <h5 class="titolo">Province <span class="badge badge-primary"><?= $provinceCount['conteggio']; ?></span></h5>
          </div>
          <div class="flex-shrink-0">
            <a href="#" class="btn btn-sm btn-success addProvincia"><i class="fa fa-plus"></i>Aggiungi provincia</a>
          </div>
        </div>        

        <?php if(!isset($province['message'])) { ?>
        <table class= "table table-hover table-bordered">
          <thead>
            <tr>
              <th>Sigla</th>
              <th>Provincia</th>              
              <th></th>              
            </tr>
          </thead>
          <tbody>
            <?php
              for($i = 0; $i < count($province); $i++) {
                echo "<tr>";
                echo "<td>" . $province[$i]['provincia_sigla'] . "</td>";
                echo "<td>" . $province[$i]['provincia'] . "</td>";
                echo "<td>
                  <a class='btn btn-primary btn-sm update' href='#' data-toggle='tooltip' title='Modifica regione'><i class='fa fa-pencil'></i></a>
                </td>";
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

  <div id="addProvinciaModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Aggiungi provincia</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <form action="" method="POST">
          <div class="modal-body">
            <div class="form-group">
              <label for="nameProvincia">Nome provincia</label>
              <input id="nameProvincia" name="nameProvincia" placeholder="Inserisci nome provincia" type="text" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="siglaProvincia">Sigla provincia</label>
              <input id="siglaProvincia" name="siglaProvincia" placeholder="Inserisci sigla provincia" type="text" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
            <button type="submit" class="btn btn-success">Aggiungi</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</section>