
<form method="POST" action="login.php">
	<h1>Login</h1>
	<fieldset>
		<legend for="login-input-email">E-mail</legend>
		<input type="email" name="email" id="login-input-email" class="form-control" placeholder="Your email address">
	</fieldset>
	<fieldset>
		<legend for="login-input-password">Password</legend>
		<input type="password" name="password" id="login-input-password" class="form-control" placeholder="Your password">
	</fieldset>

	<?php if (isset($_POST['message'])) { ?>
		<p><?php echo $_POST['message']; ?></p>
	<?php } ?>

	<button type="submit">Login</button>
</form>