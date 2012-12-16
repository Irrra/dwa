<?php
class users_controller extends base_controller {

	public function __construct() {
		parent::__construct();
	} 
	
	public function index() {
		echo "Welcome to your projects page!";
	}
	
	public function projects($user_name = NULL) {
	
# Set up view
	# If user is blank, they're not logged in, show message and don't do anything else
	if(!$this->user) {
		echo "Sorry, clients access only. Please, contact administrator if you lost your login information.<br> <a href='/users/login'>Login</a>";
		
		# Return will force this method to exit here so the rest of 
		# the code won't be executed and the profile view won't be displayed.
		return false;
	}
	
	# Setup view
	$this->template->content = View::instance('v_users_projects');
	$this->template->logosource = "../images/boy.gif";

	# Load CSS / JS
	$client_files = Array("/css/main.css");
    $this->template->client_files = Utils::load_client_files($client_files);   

	# Pass information to the view
	$this->template->content->user_name = $user_name;
	
	# Render template 
		echo $this->template;
}


public function login() {
	
	# Set up the view
	$this->template->content = View::instance("v_users_login");
	$this->template->title   = "Login to your Idealcapture projects";

		
	# Pass data to the view
	$this->template->content->error = $error;
	
	# Render the view
	echo $this->template;	
}
	
public function p_login() {

	# Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
	$_POST = DB::instance(DB_NAME)->sanitize($_POST);
	
	# Hash submitted password so we can compare it against one in the db
	$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
	
	# Search the db for this email and password
	# Retrieve the token if it's available
	$q = "SELECT token 
		FROM users 
		WHERE email = '".$_POST['email']."' 
		AND password = '".$_POST['password']."'";
	
	$token = DB::instance(DB_NAME)->select_field($q);	
	
					
	# If we didn't get a token back, login failed
	# Login failed
	if($token == "") {
		Router::redirect("/index/index/error"); 
	}
	# Login passed
	else {
		setcookie("token", $token, strtotime('+2 weeks'), '/');
		Router::redirect("/users/projects");
	}
}

public function logout() {

	# Generate and save a new token for next login
	$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
	
	# Create the data array we'll use with the update method
	# In this case, we're only updating one field, so our array only has one entry
	$data = Array("token" => $new_token);
	
	# Do the update
	DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");
	
	# Delete their token cookie - effectively logging them out
	setcookie("token", "", strtotime('-1 year'), '/');
	
	# Send them back to the main landing page
	Router::redirect("/");

}

public function directory() {

	$this->template->content = View::instance("v_users_info");
	$this->template->title   = "List of all registered Shmitterians";
	
	# Load CSS / JS
	$client_files = Array("/css/main.css");
    $this->template->client_files = Utils::load_client_files($client_files);   
	
	# Build a query of the users
	$q = "SELECT * FROM users ORDER BY last_name";
	# Execute our query, storing the results 
	$directory = DB::instance(DB_NAME)->select_rows($q);
	
	$this->template->content->users = $directory;
	
	# Set up the view
	echo $this->template;

}
		
} # end of the class