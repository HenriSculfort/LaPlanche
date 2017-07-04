<?php

namespace Controller;

use \W\Controller\Controller;
use Model\CourtsModel;
use Respect\Validation\Validator as v;

class CourtsController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function listAllCourts()
	{
		$model = new CourtsModel();
		$findAll = $model->findAll();
		$this->show('default/courts', ['findAll' => $findAll]);
	}


	public function searchCourts() {

		$data = [];
		$errors = [];
		// Je me protège au niveau du POST
		$get = array_map('trim', array_map('strip_tags', $_GET));
		
		// Si le formulaire est envoyé
		if(!empty($_GET)) {

			// On vérifie que le lieu a bien été renseigné. 
			if(!v::notEmpty()->length(2, null)->validate($get['searchWhere'])) {
				$errors[] = 'Le lieu ou le département doit être renseigné';
			} else {
				$data['city'] = $get['searchWhere'];
				$data['postal_code'] = $get['searchWhere'];
			}

			// Si la date est renseignée 
			if(!empty($get['year']) && !empty($get['month']) && !empty($get['day'])) { 
				$date = $get['year'] . '-' . $get['month'] . '-' . $get['day'];
				if(!v::alpha()->date('Y-m-d')->validate($date)) { 
					$errors[] = 'Le format de la date est incorrect';
				} else { 
					$data['date'] = $date;
				}
			}

			if(count($errors)== 0) {
				$Model = new Model();
				$search = $Model->search($data);
				if($search) {

					$this->show('default/courts');
				}

			} 
			else { 

			}


			
		} // Fin du if !empty GET
	} // Fin fonction searchCourts
		
}
    