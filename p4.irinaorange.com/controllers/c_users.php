<?php
class users_controller extends base_controller {

	public function __construct() {
		parent::__construct();
	} 
	
	public function index() {
		echo "Welcome to your projects page!";
	}
	
	
public function signup() {
		
	# Setup view
		$this->template->content = View::instance('v_users_signup');
		$this->template->title   = "Signup";
			
	# Load CSS / JS
		$client_files = Array("/css/main.css");
		$this->template->client_files = Utils::load_client_files($client_files); 
			
	# Render template
		echo $this->template;
		
}

	
public function p_signup() {
	
	# Encrypt the password	
	$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		
	# More data we want stored with the user	
	$_POST['created']  = Time::now();
	$_POST['modified'] = Time::now();
	$_POST['token']    = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
		
	# Insert this user into the database 
	$user_id = DB::instance(DB_NAME)->insert("users", $_POST);
	Router::redirect("/users/clients");
}
	
# This is client's side of portal. Users can open their galleries, pick pictures,
# and send messages to admin.
	public function projectsadmin($user_name = NULL) {

	# The user can be either a regular one or an admin.
	# So, he is redirected either to a customer zone, or to an admin zone.
	# Setup view
	#admin section: list of users and their projects
	
    if($user_name=="Admin") {
		Router::redirect("/users/clients");
	}
	
	else {
		# user section: list of user's albums
		# retrieve the list of projects
		
		$q = "SELECT *  FROM projects WHERE user_id = ".$user_name;
		
		# if no projects created yet, create a notice
		# else, procede with displaying
		
		$projectlist = DB::instance(DB_NAME)->select_rows($q);
		# add a form for new project creation
		
		# Logo, styles and user name are used by both parts, admin and user's
		$this->template->content = View::instance('v_users_projects');
		$this->template->content->projects = $projectlist;
		$this->template->content->subview = View::instance('v_project_setup');
		# Logo, styles and user name are used by both parts, admin and user's
		# Load CSS / JS
	
		$client_files = Array("/css/main.css");
		$this->template->client_files = Utils::load_client_files($client_files);   
		$this->template->logosource = "../../images/boy.gif";
	} 

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
		
	$q2 = "SELECT first_name 
		FROM users 
		WHERE email = '".$_POST['email']."' 
		AND password = '".$_POST['password']."'";
	
	$token = DB::instance(DB_NAME)->select_field($q);	
	$name = DB::instance(DB_NAME)->select_field($q2);	
	
					
	# If we didn't get a token back, login failed
	# Login failed
	if($token == "") {
		Router::redirect("/index/index/error"); 
	}
	# Login passed
	else {
		setcookie("token", $token, strtotime('+2 weeks'), '/');
		Router::redirect("/users/projectsadmin/$name");
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

public function clients() {

	$this->template->content = View::instance("v_users_info");
	$this->template->title   = "Existing Idealcapture customers: <br>";
	
	# Build a query of the users
	$q = "SELECT * FROM users ORDER BY last_name";
	# Execute our query, storing the results 
	$directory = DB::instance(DB_NAME)->select_rows($q);
	$this->template->content->users = $directory;
	
	# Logo, styles and user name are used by both parts, admin and user's
    $this->template->content->subview = View::instance('v_users_signup');
	
	# Load CSS / JS
	$client_files = Array("/css/main.css");
    $this->template->client_files = Utils::load_client_files($client_files);   
	$this->template->logosource = "../images/boy.gif";   
	
	# Set up the view
	echo $this->template;
}


public function deleteCustomer($user_id) {
	# Delete this connection
	$where_condition = 'WHERE user_id = '.$user_id;
	DB::instance(DB_NAME)->delete('users', $where_condition);

	# Send them back 
	Router::redirect("/users/clients");
}
	
		
} # end of the class