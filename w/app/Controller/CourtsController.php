<?php

namespace Controller;

use \W\Controller\Controller;
use Model\CourtsModel;
use Respect\Validation\Validator as v;
use Intervention\Image\ImageManagerStatic as Image;


class CourtsController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function listAllCourts()
	{
		$model = new CourtsModel();
		$findAll = $model->findAll();
		$this->show('default/terrains', $findAll);
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

					$this->show('default/terrains');
				}

			} 
			else { 

			}


			
		} // Fin du if !empty GET
	} // Fin fonction searchCourts
	
	// *********************Supprimer un terrain***************//
	public function deleteCourts

        if(isset($_GET['id'])){
            $reponse = $bdd->prepare('SELECT * FROM pictures WHERE id = :id');
            $reponse -> bindValue(':id',htmlspecialchars($_GET['id']), PDO::PARAM_INT);
            $reponse -> execute();
            $nom=$reponse->fetch();
            $reponse -> closeCursor(); 


            $reponse = $bdd->prepare('DELETE FROM pictures WHERE id = :id');
            $reponse -> bindValue(':id',htmlspecialchars($_GET['id']), PDO::PARAM_INT);
            $reponse -> execute();


            if($reponse -> execute()){
                unlink($this->assetUrl().$nom['name']);
                unlink('../docs/tuto/img/uploads/'.$nom['name']);

            }
        }


//************************Ajouter un terrain********************//
    public function addCourts

        if(isset($_FILES['name'])){

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

			if(!empty($post['level']))
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

			if(!empty($post['net']))
			{
				$errors[] = 'Le filet doit être défini';
			}

			if(mb_strlen($post['opening_hours'])<2)
			{
				$errors[] = 'Les horaires d\'ouverture doivent comporter au moins 2 caractères';
			}
			

            $maxfilesize = 1048576; //1 Mo

            if($_FILES['name']['size'] < $maxfilesize){
                //pas d'erreur et le fichier n'est pas trop volumineux
                //on teste l'extension
                $extensions_autorisees = array('jpg', 'jpeg', 'png', 'gif');
                $fileInfo = pathinfo($_FILES['name']['name']);
                $extension = $fileInfo['extension'];
                if(in_array($extension, $extensions_autorisees)){
                    //extension valide
                    echo 'c\'est bon<br>';
                    //transférer définitivement le fichier sur le serveur
                    //on renomme le fichier
                    if($extension == 'jpg' OR $extension == 'jpeg'){
                        //jpeg ou pjg
                        $newImage = imagecreatefromjpeg($_FILES['name']['tmp_name']);
                    }
                    elseif($extension == 'png'){
                        //png
                        $newImage = imagecreatefrompng($_FILES['name']['tmp_name']);
                    }
                    else{
                        //fichier gif
                        $newImage = imagecreatefromgif($_FILES['name']['tmp_name']);
                    }


                    $image = Image::make('$newImage')->resize(300, 200);

                   
                    $picture = md5(uniqid(rand(), true));
                   
                    move_uploaded_file($_FILES['name']['tmp_name'], 'uploads/'.$picture.'.'.$extension);

                }
            }

            if(count($errors) === 0){
				$data = [
					
					'name'	=> $post['name'],
					'address'	=> $post['address'],
					'postal_code'	=> $post['postal_code'],
					'city'	=> $post['city'],
					'picture'	=> $post['picture'],
					'description'	=> $post['description'],
					'net'	=> $post['net'],
					'court_state'	=> $post['level'],
					'opening_hours'	=> $post['opening_hours'],
					'admin_validation'	=> false,
					'parking'	=> $post['parking'],
	
				];

				$addCourts = new CourtsModel();
				$insert = $addCourts->insert($data);
				
				if($insert){
					$json =[
					'result' =>true,
					'message' =>'le terrain est soumis!',
					];
		
				}
				

				else{
					$json =[
					'result' =>false,
					'errors'=>'Ce n\'est pas une bonne extension !',
					];
					//extension non autorisée
				}
			}
			else{//problème:
				if($_FILES['name']['error'] > 0){
					$json =[
					'result' =>false,
					'errors'=>'Une erreur de transfert est survenue !',
					];
				//erreur lors du transfert
					
				}
				else{
					$json =[
					'result' =>false,
					'errors'=>'Le fichier est trop gros !',
					];
					//fichier trop volumineux	
				}
				
			}

		}

		$this->showJson($json); 
      
	}



}
    