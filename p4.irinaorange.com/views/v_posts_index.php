<? foreach($posts as $post): ?>
	<div class="shmitter">
		<div id="author"><p><?=$post['first_name']?> <?=$post['last_name']?> <br>
		Last modified on: 
		<?=Time::display($post['modified'], 'M/d/Y - H:i')?>
		</div>
		<div id="post"><?=$post['content']?></div>
	</div>	
<? endforeach; ?>