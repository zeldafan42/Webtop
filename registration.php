
<form action="registrationHandler.php" method="POST" id="registrationForm" enctype="multipart/form-data">
	<fieldset>
		<input type="text" name="forename" placeholder="Forename"/>
		<input type="text" name="surname" placeholder="Surname"/>
		<input type="text" name="username" placeholder="Nickname"/>
		<input type="password" name="password" placeholder="Password"/>
		<label>Your Picture:
			<input type="file" name="picture"/>
		</label>
		<input type="text" name="email" placeholder="E-mail adress"/>

		<input type="submit" name="login" value="Register" id="registrationButton"/>
	</fieldset>
</form>
