
<form method="POST" action="register.php">
	<h1>Login</h1>
	<fieldset>
		<legend for="login-input-email">E-mail</legend>
		<input type="email" name="email" id="login-input-email" class="form-control" placeholder="Your email address">
	</fieldset>
	<fieldset>
		<legend for="login-input-password">Password</legend>
		<input type="password" name="password" id="login-input-password" class="form-control" placeholder="Your password">
	</fieldset>
	<fieldset>
		<legend for="login-input-password">Repeat Password</legend>
		<input type="password" name="repeat-password" id="login-input-repeat-password" class="form-control" placeholder="Repeat Password">
	</fieldset>

	<?php if (isset($_POST['message'])) { ?>
		<p><?php echo $_POST['message']; ?></p>
	<?php } ?>

	<button type="submit">Register</button>
</form>