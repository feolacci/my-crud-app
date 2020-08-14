<form action="<?= $action ?>" method="POST">
  <div class="form-group">
    <label for="nameRegione">Nome regione</label>
    <input id="nameRegione" name="nameRegione" value="<?php if(isset($nomeRegione)) {echo $nomeRegione["regione"];} ?>" placeholder="Inserisci nome regione" type="text" class="form-control" required>
  </div>

  <button type="submit" class="btn <?= isset($nomeRegione) ? "btn-primary" : "btn-success" ?>"><?= isset($nomeRegione) ? "Modifica" : "Aggiungi" ?></button>
</form>