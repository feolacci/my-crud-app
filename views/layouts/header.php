<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My CRUD application</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  
  <?php if(isset($stylesheet)) { ?>
  <?php for($i = 0; $i < count($stylesheet); $i++) { ?>
  <link rel="stylesheet" href="<?= $stylesheet[$i] ?>" type="text/css">
  <?php }} ?>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/index.php">
      <img src="/assets/images/flag-of-italy-xs.png" height="30" class="d-inline-block align-top" alt="" loading="lazy">
      <span class="ml-3">My CRUD</span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="/index.php" class="nav-link">Homepage</a>
        </li>
        <li class="nav-item">
          <a href="/controllers/regione.controller.php?r=regioni" class="nav-link">Regioni italiane</a>
        </li>
        <?php if(!isset($_SESSION["email"])) { ?>
          <li class="nav-item">
            <a href="/controllers/auth.controller.php?r=login" class="nav-link">Accedi</a>
          </li>
          <li class="nav-item">
            <a href="/controllers/auth.controller.php?r=signup" class="nav-link">Registrati</a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a href="/controllers/auth.controller.php?r=logout" class="nav-link">Esci (<?= $_SESSION["email"] ?>)</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </nav>

  <?php if(isset($breadcrumb)) { ?>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
      <?php
        for($i = 0; $i < count($breadcrumb); $i++) {
        if($i == count($breadcrumb) - 1) {
      ?>
        <li class="breadcrumb-item active"><?= $breadcrumb[$i]['label'] ?></li>
      <?php } else { ?>
        <li class="breadcrumb-item"><a href="<?= $breadcrumb[$i]['url'] ?>"><?= $breadcrumb[$i]['label'] ?></a></li>
      <?php }} ?>
      </ol>
    </nav>
  <?php } ?>