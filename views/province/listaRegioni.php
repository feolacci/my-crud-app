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
            echo "<td><a href='province.controller.php?r=RegioneDetail&regione=" . $listaRegioni[$i]['regione'] . "'><i class='fa fa-eye'></i></a></td>";
            echo "</tr>";
          }
          ?>

        </tbody>
      </table>
    </div>
  </div>
  
</div>
