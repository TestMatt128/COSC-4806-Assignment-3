<?php

require_once 'core/Controller.php';

class Login extends Controller {

    public function index() {		
	    $this->view('login/index');
    }
    
    public function verify(){
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];
			$username = strtolower($username);

			// Failed attempt counter.
			if(isset($_SESSION['failedAuth'])){
				if($_SESSION['failedAuth'] < 3){
					$_SESSION['failedAuth'] ++; // +1 to the failed attempt counter.
					print("Failed attempts: " . $_SESSION['failedAuth'] );
				}
				else if ($_SESSION['failedAuth'] >= 3)
					print("Failed attempts: " . $_SESSION['failedAuth'] . " - You are locked out from signing in. Please wait after 60 seconds.");
				// Lockout for 60 seconds.
					sleep(60);
			}
			if(isset($_SESSION['auth']) == 1){
				header('Location: /home');
			}
			$user = $this->model('User');
			$user->authenticate($username, $password); 
    }

}
