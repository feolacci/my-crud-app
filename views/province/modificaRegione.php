<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../index.php">Homepage</a></li>
    <li class="breadcrumb-item"><a href="province.controller.php?r=ListaRegioni">Lista delle regioni</a></li>
    <li class="breadcrumb-item active" aria-current="page">Modifica regione</li>
  </ol>
</nav>

<div class= "container">

  <div class="card shadow">
    <div class="card-header">
      <h4 class= "titolo">Modifica regione</h4>
    </div>
    <div class="card-body">
      <?php
        $action = "province.controller.php?r=RegioneEdit&regione=" . $nomeRegione["regione"];
        include "_form.php";
      ?>
    </div>
  </div>
  
</div>