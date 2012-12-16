<?php

class index_controller extends base_controller {

	public function __construct() {
		parent::__construct();
	} 
	
	/*-------------------------------------------------------------------------------------------------
	Access via http://yourapp.com/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index($error = NULL) {
		
		# Any method that loads a view will commonly start with this
		# First, set the content of the template with a view file
			$this->template = View::instance('_v_template');
			$this->template->content = View::instance('v_index_index');
			$this->template->content->subview = View::instance('v_users_login');
			
		# Now set the <title> tag
			$this->template->title = "Welcome to Idealcapture Customer Portal!";
			$this->template->logosource = "../images/boy.gif";
			
			if ($error != NULL) {
				$this->template->content->subview->errormessage="Login Failed.Try again.";
				$client_files = Array("../../css/main.css");
				$this->template->logosource = "../../images/boy.gif";
				
			}
			else {
				$this->template->content->subview->errormessage="";
				$client_files = Array("../css/main.css");
				
			}
		
			$this->template->client_files=Utils::load_client_files($client_files);
		# Render the view
			echo $this->template;
	}	
} // end class

