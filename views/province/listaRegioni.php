<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../index.php">Homepage</a></li>
    <li class="breadcrumb-item active" aria-current="page">Lista delle regioni</li>
  </ol>
</nav>

<div class= "container">

  <div class="card shadow">
    <div class="card-header">
      <h4 class= "titolo">Lista delle regioni</h4>
    </div>
    <div class="card-body">
      <div class="alert alert-success d-none" role="alert">
        Cancellazione avvenuta
      </div>
      <div class="alert alert-danger d-none" role="alert">
        Attenzione! Cancellazione NON avvenuta
      </div>
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
          for($i = 0; $i < count($listaRegioni); $i++) {
            echo "<tr>";
            echo "<td>" . $listaRegioni[$i]['id_regione'] . "</td>";
            echo "<td>" . $listaRegioni[$i]['regione'] . "</td>";
            echo "<td>
              <a class='detail' href='province.controller.php?r=RegioneDetail&regione=" . $listaRegioni[$i]['regione'] . "'><i class='fa fa-eye'></i></a>
              <a class='delete' href='province.controller.php?r=RegioneDelete&regione=" . $listaRegioni[$i]['regione'] . "'><i class='fa fa-times'></i></a>
            </td>";
            echo "</tr>";
          }
          ?>

        </tbody>
      </table>
    </div>
  </div>
  
</div>
