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
			
			
		
			$user = $this->model('User');
			$user->authenticate($username, $password); 
    }

}
