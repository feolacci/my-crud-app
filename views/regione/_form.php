<form action="<?= $action ?>" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="nameRegione">Nome regione</label>
    <input id="nameRegione" name="nameRegione" value="<?php if(isset($nomeRegione)) {echo $nomeRegione["regione"];} ?>" placeholder="Inserisci il nome della regione" type="text" class="form-control" required>
  </div>

  <div class="form-group">
    <label for="descRegione">Descrizione regione</label>
    <textarea id="descRegione" name="descRegione" placeholder="Inserisci la descrizione della regione" rows="3" class="form-control"><?php if(isset($nomeRegione)) {echo $nomeRegione["descrizione"];} ?></textarea>
  </div>

  <div class="form-group">
    <label for="imgRegione">Immagine</label>
    <input id="imgRegione" name="imgRegione" type="file" class="form-control-file">
    
    <?php if(isset($nomeRegione)) { ?>
    <input id="imgRegione" name="imgRegione" value="<?= $nomeRegione["img"] ?>" type="text" class="form-control d-none" hidden>
    <?php } ?>
  </div>

  <button type="submit" class="btn <?= isset($nomeRegione) ? "btn-primary" : "btn-success" ?>"><?= isset($nomeRegione) ? "Modifica" : "Aggiungi" ?></button>
</form>