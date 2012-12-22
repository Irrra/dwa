<div id="newclient">
<h2>Fill fields below to add a new client.</h2>
<form method='POST' action='/users/p_signup'>

	<p class="forminput"><label>First Name: <br>
	<input type='text' name='first_name' required></label></p>
	
	<p class="forminput"><label>Last Name: <br>
	<input type='text' name='last_name' required></label></p>

	<p class="forminput">Email: <br>
	<input type='text' name='email' required></label></p>
	
	<p class="forminput">Password: <br>
	<input type='password' name='password' required></label></p>
	
	<input type='submit' value="Add new customer"><input type='reset' value='Reset'>
</form> 
</div>