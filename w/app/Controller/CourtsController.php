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

		// Si le formulaire est envoyé
		if(!empty($_GET)) {
			// Je me protège au niveau du POST
			$get = array_map('trim', array_map('strip_tags', $_GET));


			// On vérifie que le lieu a bien été renseigné. 
			if(!v::notEmpty()->length(2, null)->validate($get['searchWhere'])) {
				$errors[] = 'Le lieu ou le département doit être renseigné';
			} else {
				$data['city'] = $get['searchWhere'];
				$data['postal_code'] = $get['searchWhere'];
			}

			// Si la date est renseignée 
			if(!empty($get['year']) && !empty($get['month']) && !empty($get['day'])) { 
				$date = '' . $get['year'] . '-' . $get['month'] . '-' . $get['day'];
				if(!v::date('Y-m-d')->validate($date)) { 
					$errors[] = 'Le format de la date est incorrect';
				}
			}
	
			// S'IL N'Y A PAS D'ERREUR 
			if(count($errors) === 0) {

				// Si l'utilisateur ne veut pas de filtre match 
				if($get['has_match'] == 'both') { 
					$model = new CourtsModel();
					$search = $model->search($data);
					if(!empty($search)) {
						$searchResult = true;
					} else { 
						$searchResult = false;
					}
				} // S'il veut des matchs 
				elseif ($get['has_match'] == 'has_match') { 

					$gamesModel = new GamesModel;
					$getGames = $gamesModel->jointureCourtsGames($date);
					if(empty($getGames)) {
						$searchResult = false;
						$errors[] = 'Aucun match trouvé.';
					} // Si il y a un résultat
					else {
						$searchResult = true;
					}
				// S'il ne veut pas de match 
				} elseif ($get['has_match'] == 'has_no_match') {
					$has_match = false;
					$gamesModel = new CourtsModel;
					$getNoGames = $gamesModel->leftJoinCourtsGames($date);
					if(empty($getNoGames)) {
						$searchResult = false;
						$errors[] = 'Aucun match trouvé.';
					} // Si il y a un résultat
					else {
						$searchResult = true;
					}
				}

			
				} /// S'IL Y A DES ERREURS 
				else { 
					$showErrors = implode('<br>', $errors);
				}	

				$params = [ 
				'searchResults' => isset($searchResult) ? $searchResult : null,
				'showErrors' => isset($showErrors) ? $showErrors : null,
				'search' => isset($search) ? $search : null,
				'getGames' => isset($getGames) ? $getGames : null ,
				'getNoGames' =>isset($getNoGames) ? $getNoGames : null ,
				];
				echo '<pre>';
				var_dump($params);
				echo '</pre>',
				$this->show('default/courts', $params);

		} // Fin du if !empty GET
		else {
			$this->show('w_errors/403');			
		}
	} // Fin fonction searchCourts





}
