<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\MessageModel;

class DefaultController extends Controller
{
    
    /**
	 * Page d'accueil 
	 */
	public function home()
	{
	
		$this->show('default/index', $json);
	}

}