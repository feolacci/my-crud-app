<div class= "container">

  <div class="card shadow">
    <div class="card-header">
      <h4 class="titolo">Dettaglio della regione: <span class="text-primary"><?= $_GET['id']; ?></span></h4>
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
          echo "Nessuna provincia trovata!";
        }
      ?>
    </div>
  </div>

</div>
