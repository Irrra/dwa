<form method='POST' action='/users/p_login'>

	<p class="forminput"><label>Email: <br>
	<input type='text' name='email' required></label></p>
	<p class="forminput"><label>Password: <br>
	<input type='password' name='password' required></label></p>
	<input type='submit' value='Submit'>	
	<input type='reset' value='Reset'>

</form>

<div id="error"><?=$errormessage;?></div>