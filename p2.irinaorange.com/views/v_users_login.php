<form method='POST' action='/users/p_login'>

	<? if($error): ?>
		<div class='error'>
			<p>Login failed. Please double check your email and password.</p>
		</div>
	<? endif; ?>
	
	<p class="forminput"><label>Email: <br>
	<input type='text' name='email' required></label></p>
	<p class="forminput"><label>Password: <br>
	<input type='password' name='password' required></label></p>
	<input type='submit' value='Submit'>	
	<input type='reset' value='Reset'>

</form>