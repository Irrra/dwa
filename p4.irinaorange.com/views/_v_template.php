<!DOCTYPE html>

<!-- This template will be used by customers. 
 Their part of the site will have a different structure than the admin's.-->
<html>
<head>
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<![endif]-->
	
	<title><?=@$title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
	<!-- JS -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
				
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	
	<!-- Controller Specific JS/CSS -->
	<?=@$client_files; ?>

</head>

<body>	
	<div id="mainContent">
	<header>
	<a href="/index"><img src="<?php echo $logosource; ?>" alt="irina" width="162" height="183" border="0" class="floatLeft" /></a>
	<nav>
	<div id="menu">
		<!-- Menu for users who are logged in -->
		<? if($user): ?>
			
			<a href='/users/logout'>Logout</a>
			<a href='/posts/users/'>Projects</a>
			
		<? endif; ?>
		</div>
	</nav>
	</header>
	
		<h1><?=@$title; ?></h1>
		<?=$content;?> 
	</div>

</body>
</html>