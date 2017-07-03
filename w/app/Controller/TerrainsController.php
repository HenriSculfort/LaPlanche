<?php

namespace Controller;

use \W\Controller\Controller;

class TerrainsController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function listAllCourts()
	{
		$this->show('default/terrains');
	}
    
}