<?php

class posts_controller extends base_controller {

	public function __construct() {
		parent::__construct();
		
		# Make sure user is logged in if they want to use anything in this controller
		if(!$this->user) {
			die("Members only. <a href='/users/login'>Login</a>");
		}	
	}

	/* Add project to the projects database */
	public function p_add() {	
		# Associate this post with this user
		$_POST['user_id']  = $this->user->user_id;
		
		# Insert
		# Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us
		DB::instance(DB_NAME)->insert('projects', $_POST);
		
		# Send them back to the main landing page
		Router::redirect("/users/projectsadmin");	
	}
}