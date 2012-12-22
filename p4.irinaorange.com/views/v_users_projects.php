<? if(isset($project['title']) && isset($project['url'])): ?>
<ul class="fancyList">
<? foreach($project as $project): ?>
	<li><em>
		<?=$project['title']?> (Pics folder: <?=$project['url']?>)	
	</li>	
<? endforeach; ?>
</ul>
	<? else: ?>
		<p>This customer doesn't have any projects yet. Use a form below to create some.</p>
<? endif; ?>
	
<?=$subview;?>