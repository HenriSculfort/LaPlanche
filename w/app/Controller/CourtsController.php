<?php

namespace Controller;

use \W\Controller\Controller;
use Model\CourtsModel;
use Model\GamesModel;
use Respect\Validation\Validator as v;

class CourtsController extends Controller
{

	/**
	 * Page d'accueil par défaut, listant tous les terrains
	 * @return array findAll avec liste des terrains
	 */
	public function listAllCourts()
	{
		$model = new CourtsModel();
		$findAll = $model->findAll();
		$this->show('default/courts', ['findAll' => $findAll]);
	}



	/**
	* Moteur de recherche des terrains
	* @return 
	*
	*/

	public function searchCourts() {

		$data = [];
		$errors = [];
		$showErrors = '';
		$search = [];

		// Si le formulaire est envoyé
		if(!empty($_GET)) {
			// Je me protège au niveau du POST
			$get = array_map('trim', array_map('strip_tags', $_GET));

			/*********** SI MATCH *************/

			// Si la case match est cochée 
			if(isset($get['has_match'])) { 
				if($get['has_match'] == 'on' ) {
					$gamesModel = new GamesModel;
					$getGames = $gamesModel->jointureCourtsGames();
					if(empty($getGames)) {
						$errors[] = 'Aucun match trouvé.';
					} // Si il y a un résultat
					else {
						
					}
				} // Fermeture if on
			} // Fermeture if isset



			/**********  SI PAS DE MATCH ********/
			else { 

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
					if(!v::date('Y-m-d')->validate($date)) { 
						$errors[] = 'Le format de la date est incorrect';
					} else { 
						$data['date'] = $date;
					}
				}
				// S'il n'y a pas d'erreur 
				if(count($errors) === 0) {

					$model = new CourtsModel();
					$search = $model->search($data);
					if(!empty($search)) {
						$searchResult = true;
						
					} else { 
						$searchResult = false;
						
					}

				} // Fin if count errors == 0
				else { 
					$showErrors = implode('<br>', $errors);
				}	

				$params = [ 
					'searchResults' => isset($searchResult) ? $searchResult : null,
					'showErrors' => $showErrors,
					'search' => $search,
				];
				$this->show('default/courts', $params);
			}
		} // Fin du if !empty GET
	} // Fin fonction searchCourts





}
