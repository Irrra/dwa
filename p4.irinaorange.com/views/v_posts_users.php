
<div id="clients">
<form method='POST' action='/posts/p_follow'>
	
<ul>	

	<? foreach($users as $user): ?>
	<li>
		<!-- Print this user's name -->
		<?=$user['first_name']?> <?=$user['last_name']?> <br>
		
		<!-- If there exists a connection with this user, show a unfollow link -->
		<? if(isset($connections[$user['user_id']])): ?>
			<a href='/posts/unfollow/<?=$user['user_id']?>'>Delete Customer</a>
		
		<!-- Otherwise, show the follow link -->
		<? else: ?>
			<a href='/posts/follow/<?=$user['user_id']?>'>Shmitt</a>
		<? endif; ?>
	
	</li>
	<? endforeach; ?>
	
	</ul>
</form>
</div>