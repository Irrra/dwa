<!DOCTYPE html>
<html>
<head>
	<title><?=@$title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
	<!-- JS -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
				
	<!-- Controller Specific JS/CSS -->
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Eater"> 
	<?=@$client_files; ?>
	
</head>

<body>	
	<div id="mainContent">
	<header>
	<a href="/index"><div id="logo"><p>Welcome to Shmitter!</p></div></a>
	<nav>
	<div id="menu">
		<!-- Menu for users who are logged in -->
		<? if($user): ?>
			
			<a href='/users/logout'>Logout</a>
			<a href='/posts/users/'>Shmitter-Buddies</a>
			<a href='/users/directory'>All Users Directory</a>
			<a href='/posts/'>View shmitts</a>
			<a href='/posts/add'>Add a shmitt</a>
		
		<!-- Menu options for users who are not logged in -->	
		<? else: ?>
		
			<a href='/users/signup'>Sign up</a>
			<a href='/users/login'>Log in</a>
		
		<? endif; ?>
		</div>
	</nav>
	</header>
	
		<h1><?=@$title; ?></h1>
		<?=$content;?> 
	</div>

</body>
</html>