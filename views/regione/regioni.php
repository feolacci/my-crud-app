<div class= "container">

  <div class="card shadow">
    <div class="card-header">
      <h4 class= "titolo">Lista delle regioni</h4>
      <a href="regione.controller.php?r=aggiungiRegione" class="btn btn-sm btn-success"><i class="fa fa-plus"></i>Aggiungi regione</a>
    </div>
    <div class="card-body">
      <table class= "table table-hover table-bordered">
        <thead>
          <tr>
            <th>Codice</th>
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
              <a class='detail' href='regione.controller.php?r=regione&id=" . $regioni[$i]['regione'] . "' data-toggle='tooltip' data-placement='top' title='Dettaglio'><i class='fa fa-eye'></i></a>
              <a class='detail' href='regione.controller.php?r=modificaRegione&id=" . $regioni[$i]['regione'] . "' data-toggle='tooltip' data-placement='top' title='Modifica'><i class='fa fa-pencil'></i></a>
              <a class='delete' href='regione.controller.php?r=deleteRegione&id=" . $regioni[$i]['regione'] . "' data-toggle='tooltip' data-placement='top' title='Elimina'><i class='fa fa-times'></i></a>
            </td>";
            echo "</tr>";
          }
          ?>

        </tbody>
      </table>
    </div>
  </div>
  
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Conferma eliminazione</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Sei sicuro?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
        <button type="button" class="btn btn-danger">Conferma</button>
      </div>
    </div>
  </div>
</div>