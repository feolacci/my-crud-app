<section id="login">
	
	<div class="container">

		<div class="card shadow">
      <div class="card-header">
        <h4 class="titolo">Login</h4>
      </div>
      <div class="card-body">
				<form action="auth.controller.php?r=submitLogin" method="POST">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" name="email" id="email" placeholder="Inserisci email">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Inserisci password">
					</div>
					<button type="submit" class="btn btn-primary">Login</button>
				</form>
			</div>
			<div class="card-footer">
				Non hai un account?
				<a class="btn btn-primary btn-sm" href="auth.controller.php?r=signup" role="button">Registrati</a>
			</div>
		</div>

	</div>

</section>