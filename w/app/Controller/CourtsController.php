<?php

namespace Controller;

use \W\Controller\Controller;
use Model\CourtsModel;
use Respect\Validation\Validator as v;
use Intervention\Image\ImageManagerStatic as Image;

use Model\GamesModel;



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
        $search = [];

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
				$date = $get['year'] . '-' . $get['month'] . '-' . $get['day'];

                if(!v::date('Y-m-d')->validate($date)) { 
					$errors[] = 'Le format de la date est incorrect';
				} else { 
					$data['date'] = $date;
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
					$getGames = $gamesModel->jointureCourtsGames();
					if(empty($getGames)) {
						$searchResult = false;
						$errors[] = 'Aucun match trouvé.';
					} // Si il y a un résultat
					else {
						$searchResult = true;
					}
				// S'il ne veut pas de match 
				} 
                elseif ($get['has_match'] == 'has_no_match') {
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
            }// S'IL Y A DES ERREURS 
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
			$this->showForbidden();			
		}
	} // Fin fonction searchCourts
	
	// *********************Supprimer un terrain***************//
	


//************************Ajouter un terrain********************//
    public function addCourts()
    {
    	
        $post = [];
		$errors = []; 
		if(!empty($_POST)){

			$post = array_map('trim', array_map('strip_tags', $_POST));


			if(mb_strlen($post['name'])<2)
			{
				$errors[] = 'Le nom du terrain doit comporter au moins 2 caractères';
			}

			if(mb_strlen($post['description'])<10)
			{
				$errors[] = 'Le description doit comporter au moins 10 caractères';
			}

			if(empty($post['level']))
			{
				$errors[] = 'L\'état du terrain doit être choisi';
			}

			if(mb_strlen($post['address'])<2)
			{
				$errors[] = 'L\'adresse doit comporter au moins 2 caractères';
			}
			
			if(is_int($post['postal_code']))
			{
				$errors[] = 'Le code postal doit comporter des chiffres';
			}

			if(mb_strlen($post['city'])<2)
			{
				$errors[] = 'Le nom de la ville doit comporter au moins 2 caractères';
			}

			if(empty($post['net']))
			{
				$errors[] = 'Le filet doit être défini';
			}

			if(mb_strlen($post['opening_hours'])<2)
			{
				$errors[] = 'Les horaires d\'ouverture doivent comporter au moins 2 caractères';
			}
			
			 if(isset($_FILES['name'])){

                $maxfilesize = 1048576; //1 Mo
                
                if($_FILES['name']['size'] < $maxfilesize){
                    //pas d'erreur et le fichier n'est pas trop volumineux
                    //on teste l'extension
                    $extensions_autorisees = array('jpg', 'jpeg', 'png', 'gif');
                    $fileInfo = pathinfo($_FILES['name']['name']);
                    $extension = $fileInfo['extension'];
                    
                    if(in_array($extension, $extensions_autorisees)){
                    //extension valide
                    //transférer définitivement le fichier sur le serveur
                    //on renomme le fichier
                        switch($extension){
                            case 'jpg':
                            case 'jpeg':
                                $newImage = imagecreatefromjpeg($_FILES['name']['tmp_name']);
                            break;
                                
                            case 'png':
                                $newImage = imagecreatefrompng($_FILES['name']['tmp_name']);
                            break;

                            case 'gif':
                                $newImage = imagecreatefromgif($_FILES['name']['tmp_name']);
                            break;
                        }
                    }

                    $image = Image::make($newImage)->resize(300, 200);

                   
                    $picture = md5(uniqid(rand(), true));
                   
                    
                    // $this->assetUrl : utilisable que dans les vues
                    if(move_uploaded_file($_FILES['name']['tmp_name'], $this->assetUrl('img/uploads/'.$picture.'.'.$extension))){
                       // Image bien uploadé
                    }
                    else{//problème:
                        $errors[] = 'Une erreur de transfert est survenue !';
					}
                }
                else{
					$errors[] = 'Le fichier est trop volumineux !';
				}
			}
			else{
				$errors[] = 'l\'image est absente';
			}


            if(count($errors) === 0){
				$data = [
					
					'name'         => $post['name'],
					'address'      => $post['address'],
					'postal_code'  => $post['postal_code'],
					'city'         => $post['city'],
					'picture'      => $picture,
					'description'  => $post['description'],
					'net'          => $post['net'],
					'court_state'  => $post['level'],
					'opening_hours'    => $post['opening_hours'],
					'admin_validation' => false,
					'parking'          => $post['parking'],
				];

				$addCourts = new CourtsModel();
				$insert = $addCourts->insert($data);
				
				if($insert){
					$json =[
                        'result'    => true,
                        'message'   => 'le terrain est soumis!',
					];
				}
                
            } // fin if(count($errors))
            else{
                $json =[
                    'result'    => false,
                    'errors'    => implode('<br>',$errors),
                ];
			}
			
            $this->showJson($json);
        } // fin (!empty($_POST))
 
    }
}