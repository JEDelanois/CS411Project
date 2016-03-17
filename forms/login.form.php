<div id="loginForm">
	<p> 
	<?php 
		if(isset($_GET["invalidUserCombination"]) && $_GET["invalidUserCombination"])
			echo 'Invalid email and password combination<br>';
	?>
	</p>
	<form method="POST" action="inc/loginUserProcess.php">
		<div id="loginFormEmailGroup">
			<label for="loginFormEmailTextField" id="loginFormEmailLabel">Email: </label>
			<input type="text" name="loginFormEmailTextField" id="loginFormEmailTextField"> 
		</div>
		<div id="loginFormPasswordGroup">
			<label for="loginFormPasswordTextField" id="loginFormPasswordLabel">Password: </label>
			<input type="password" name="loginFormPasswordTextField" id="loginFormPasswordTextField"> 
		</div>
		<div id="loginFormSubmitGroup">
			<input type="submit" value="Login">
		</div>
	</form>
</div>