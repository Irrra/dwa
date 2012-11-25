<h1>Hi, <?=$user->first_name?>!</h1>

<div id="profileContainer">
<div id="userinfo"><p>Here will be your avatar and profile headliner options once the feature is implemented. Stay tuned!</p></div>
<div id="randompost">
<div class="shmitter">
	<h2> Shmitt of the moment: </h2>
		<div id="author"><p><?=$firstname?> <?=$lastname?> <br>
		Last modified on: 
		<?=Time::display($modified, 'M/d/Y - H:i')?>
		</div>
		<div id="post"><?=$content?></div>
	</div>	
</div>

</div>