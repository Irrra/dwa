<!-- This view displays links to all the Idealcapture customers -->

<p>Click on client's name to go to his projects page.</p>

<ul class="fancyList">
<? foreach($users as $user): ?>
	<li><em>
		<a href='/users/projectsadmin/<?=$user['user_id']?>' class="custproj"><?=$user['last_name']?>, <?=$user['first_name']?></a><br/>
		<a href='/users/deleteCustomer/<?=$user['user_id']?>' class="delcust">delete</a>
	</li>	
<? endforeach; ?>
</ul>

 <?=$subview;?> 


