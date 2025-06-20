<?php

require_once 'core/Controller.php';

class Login extends Controller {

	/**
	*@return void
	*/
    public function index() :void{		
	    $this->view('login/index');
    }
    
    public function verify() :void{
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];
			$username = strtolower($username);

			// Failed attempt counter.
			if(isset($_SESSION['failedAuth'])){
				if($_SESSION['failedAuth'] < 3){
					$_SESSION['failedAuth'] ++; // +1 to the failed attempt counter.
					print("Failed attempts: " . $_SESSION['failedAuth'] );
				}
					// If failed attempts are 3 or more, lockout for 60 seconds.
				else if ($_SESSION['failedAuth'] >= 3)
					print("Failed attempts: " . $_SESSION['failedAuth'] . " - You are locked out from signing in. Please wait after 60 seconds.");
				// Lockout for 60 seconds.
					sleep(60);
			}
			if(isset($_SESSION['auth']) == 1){
				// If user is already signed in, redirect to home page.
				// As a bonus, print out the number of failed attempts it took to sign in. This is stored in the session.
				print("Welcome back " + $_SESSION['username'] + "! It took you " + $_SESSION['failedAuth'] + "to sign in.");
				header('Location: /home');
			}
			$user = $this->model('User');
			$user->authenticate($username, $password); 
    }

}
