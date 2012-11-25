<!DOCTYPE html>
<html>
<head>
	<title><?=@$title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<!-- Google Fonts -->
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Eater"> 

<body>	
	<div id="mainContent">
	<header>
	<div id="logo"><p>Welcome to Shmitter!</p></div>
	<nav>
	
		<!-- Menu for users who are logged in -->
		<? if($user): ?>
			
			<a href='/users/logout'>Logout</a>
			<a href='/posts/users/'>Shmitter-Buddies</a>
			<a href='/posts/'>View shmitts</a>
			<a href='/posts/add'>Add a shmitt</a>
		
		<!-- Menu options for users who are not logged in -->	
		<? else: ?>
		
			<a href='/users/signup'>Sign up</a>
			<a href='/users/login'>Log in</a>
		
		<? endif; ?>
	
	</nav>
	</header>
	<div id="indexcontent">
		<?=$content;?> 
	</div>
	</div>

</body>
</html>