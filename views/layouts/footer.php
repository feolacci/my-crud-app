  <footer class="container">
    <div class="card border-top rounded-0">
      <div class="card-body">
        <div class="d-flex align-items-baseline">
          <div class="w-100">© 2020 My CRUD application</div>
          <div class="flex-shrink-0">
            <a href="https://github.com/feolacci/my-crud-app">GitHub Repository<img src="/assets/images/github.png"></a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>
  
  <?php if(isset($script)) { ?>
  <?php for($i = 0; $i < count($script); $i++) { ?>
  <script src="<?= $script[$i] ?>"></script>
  <?php }} ?>
</body>
</html>