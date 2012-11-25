
<ul>
<? foreach($users as $user): ?>
	<li><em>
		<?=$user['last_name']?>, <?=$user['first_name']?><em> (<a href="mailto: <?=$user['email']?>"><?=$user['email']?></a>)
	</li>	
<? endforeach; ?>
</ul>

