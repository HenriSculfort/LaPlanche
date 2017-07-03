<?php

namespace Controller;

use \W\Controller\Controller;

class ContactController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function sendForm()
	{
		$this->show('default/contact');
	}
	
}