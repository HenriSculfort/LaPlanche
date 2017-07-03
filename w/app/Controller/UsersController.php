<?php

namespace Controller;

use \W\Controller\Controller;

class UsersController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function add(){
		$this->show('default/connexion');
	}


	public function login()
	{
		$this->show('default/connexion');
	}

	public function logout()
	{
		$this->show('default/connexion');
	}
	

	public function mySpace() 
	{ 
		$this->show('users/user_myspace');

	}
}