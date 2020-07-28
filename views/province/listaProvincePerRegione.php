<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../index.php">Homepage</a></li>
    <li class="breadcrumb-item"><a href="province.controller.php?r=ListaRegioni">Lista delle regioni</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?= $arrListaProvince[0]['regione']; ?></li>
  </ol>
</nav>

<div class= "container">
  
  <div class="card shadow">
    <div class="card-header">
      <h4 class="titolo">Dettaglio della regione: <span class="text-primary"><?= $arrListaProvince[0]['regione']; ?></span></h4>
    </div>
    <div class="card-body">
      <h5 class="titolo">Province <span class="badge badge-primary"><?= $arrCount['conteggio']; ?></span></h5>

      <table class= "table table-hover table-bordered">
        <thead>
          <tr>
            <th>Sigla</th>
            <th>Provincia</th>
          </tr>
        </thead>
        <tbody>

          <?php
          // print_r($arrListaProvince);
          // print_r($arrCount);
          for($i = 0; $i < count($arrListaProvince); $i++) {
            echo "<tr>";
            echo "<td>" . $arrListaProvince[$i]['provincia_sigla'] . "</td>";
            echo "<td>" . $arrListaProvince[$i]['provincia'] . "</td>";
            echo "</tr>";
          }
          ?>

        </tbody>
      </table>
    </div>
  </div>

</div>
