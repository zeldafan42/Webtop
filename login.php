<!--<h1>Please Log in</h1>-->
<form action="index.php" method="POST" id="loginForm">
	<fieldset>
		<div class=loginIcon><img src="res/zombie-icon.png" alt="Zombie-Icon damit man daneben den Benutzernamen eingibt"></div>
		<input type="text" name="username" placeholder="Username"/>
		<div class=loginIcon><img src="res/lock-icon.png" alt="Schloss-Icon damit man daneben das Passwort eingibt"></div>
		<input type="password" name="password" placeholder="Password"/>
		<label>	Angemeldet bleiben<input type="checkbox" name="stillAlive" value="true"/></label>
		<p>Noch keinen Account? <a href="index.php?registration=true">Hier Registrieren</a> </p>
		<p><a href="index.php?forgotPassword=true">Passwort vergessen?</a></p>
		<input type="submit" name="login" value="Login" id="loginButton"/>
	</fieldset>
</form>