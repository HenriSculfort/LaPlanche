<?php

namespace Controller;

use \W\Controller\Controller;
use Respect\Validation\Validator as v;

class TerrainsController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function listAllCourts()
	{
		$this->show('default/terrains');
	}


	public function searchCourts() {

		$data = [];
		$errors = [];
		// Je me protège au niveau du POST
		$get = array_map('trim', array_map('strip_tags', $_GET));
		
		// Si le formulaire est envoyé
		if(!empty($_GET)) {

			if(!v::notEmpty()->length(2, null)->validate($get['searchWhere'])) {
				$errors[] = 'Le lieu ou le département doit être renseigné';
			} else {
				$data['city'] = $get['searchWhere'];
				$data['postal_code'] = $get['searchWhere'];
			}

			$date = $get['year'] . '-' . $get['month'] . '-' . $get['day'];
			if(!v::alpha()->date('Y-m-d')->validate($date)) { 
				$errors[] = 'Le format de la date est incorrect';
			} else { 
				$data['date'] = $date;
			}

			if(count($errors)== 0) {
				$Model = new Model();
				$search = $Model->search($data);
				if($search) {
										
				}

			} 
			else { 

			}


			
		} // Fin du if !empty GET
	} // Fin fonction searchCourts
		
}
    