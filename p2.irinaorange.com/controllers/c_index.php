<?php

class index_controller extends base_controller {

	public function __construct() {
		parent::__construct();
	} 
	
	/*-------------------------------------------------------------------------------------------------
	Access via http://yourapp.com/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index() {
		
		# Any method that loads a view will commonly start with this
		# First, set the content of the template with a view file
			$template = View::instance('_v_shmitter_home');
			$template->content = View::instance('v_index_index');
			
		# Now set the <title> tag
			$template->title = "Shmitter";
	      		
		# Render the view
			echo $template;

	}	
} // end class
