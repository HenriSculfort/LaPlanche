<?php

namespace Controller;

use \W\Controller\Controller;

class DefaultController extends Controller
{
    
    /**
	 * Page d'accueil 
	 */
	public function listWhereCourts()
	{
		$this->show('default/index');
	}

}