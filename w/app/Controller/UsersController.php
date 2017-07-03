<?php

namespace Controller;

use \W\Controller\Controller;

class UsersController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function add(){
		$this->show('users/connexion');
	}


	public function login()
	{
		$this->show('users/connexion');
	}

	public function logout()
	{
		$this->show('users/connexion');
	}
	

	public function mySpace() 
	{ 
		// En attendant qu'une connexion soit possible, pour pouvoir travailler dessus
		//if(empty($_SESSION)) { 
		//	$this->show('w_errors/403');
		//} else { 
			$this->show('users/user_myspace');
		//}
	}
}