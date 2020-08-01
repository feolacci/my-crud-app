<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../index.php">Homepage</a></li>
    <li class="breadcrumb-item"><a href="regione.controller.php?r=regioni">Lista delle regioni</a></li>
    <li class="breadcrumb-item active" aria-current="page">Aggiungi regione</li>
  </ol>
</nav>

<div class= "container">

  <div class="card shadow">
    <div class="card-header">
      <h4 class= "titolo">Aggiungi regione</h4>
    </div>
    <div class="card-body">
      <?php
        $action = "regione.controller.php?r=addRegione";
        include "_form.php";
      ?>
    </div>
  </div>
  
</div>
