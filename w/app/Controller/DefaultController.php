<?php

namespace Controller;

use \W\Controller\Controller;

class DefaultController extends Controller
{
    
    /**
	 * Page d'accueil 
	 */
	public function home()
	{
		$this->show('default/index');
	}

}