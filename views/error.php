<section id="error">

  <div class="container">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="titolo">Errore<?php if(isset($error['code'])) {echo " (" . $error['code'] . ")";} ?></h4>
        <button type="button" class="btn btn-sm btn-secondary" onclick="history.back(-1)"><i class="fa fa-chevron-left"></i>Torna indietro</button>
      </div>
      <div class="card-body">
        <img src="\assets\images\error.gif">
        <h5 class="titolo">Si è verificato un errore inaspettato!</h5>
        <p><?= $error['message'] ?></p>
      </div>
    </div>
  </div>

</section>