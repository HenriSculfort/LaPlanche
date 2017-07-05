<?php

namespace Controller;

use \Model\TokensModel;
use \Model\UsersModel;
use Respect\Validation\Validator as v;

class ResetPassController extends \W\Controller\Controller
{
	public function resetPass()
	{

		$post = [];
		$errors = [];

		//On vérifie les données envoyés par le formulaire du fichier "changePassword.php" 
		if(!empty($_POST)){
            //si un id est trouvé
			foreach($_POST as $key => $value){
				$post[$key] = trim(strip_tags($value));
			}

			if(!isset($post['mdp']) || !isset($post['mdp2']) || !isset($post['user_id']) || empty($post['mdp']) || empty($post['mdp2']) || empty($post['user_id'])){

				$errors[] = 'Veuillez remplir les champs';

			} 

			if(!ctype_digit($post['user_id'])){

				$errors[] = 'Une erreur est survenue pendant la récupération de votre session';

			}

			if(($post['mdp']) != ($post['mdp2'])){

				$errors[] = 'La confirmation du mot de passe est invalide';
			}

			if(!v::stringType()->length(8, 30)->validate($post['mdp']))
			{
				$errors[] = 'Le mot de passe doit comporter au moins 8 caractères';
			}
			//si aucune erreur ne ressort des informations envoyés, on update le nouveau password
			if(count($errors) === 0){

				$mdp = [
				'password'=>password_hash(trim($post['mdp']), PASSWORD_DEFAULT),
				];

				$UsersModel = new UsersModel();
				$update = $UsersModel->update($mdp,$post['user_id']);
				//Quand l'update est réalisé on supprime le token et on envoye un message.
				if($update == true){

					$TokensModel = new TokensModel();
					$delete = $TokensModel->deleteToken($post['user_id']);
					
					$json = [ 
					'result'    => true,
					'message'   => 'Votre mot de passe a été réinitialisé',
					];
				//sinon on renvoie les erreurs en Ajax
				}else{
					$json = [
					'result'=>false,
					'errors'=>'Uploade impossible'
					];
				}
			}else{
				$json=[
				'result'=>false,
				'errors'=>implode('<br>', $errors)
				];
			}
			$this->showJson($json);
		}
	}


	public function changePass()
	{
        // Vérif que les GET soient présents
		if(isset($_GET['user_id']) && !empty($_GET['user_id'])){
        // Si ok, affichage du formulaire, sinon erreur

        // Si ok, on accède a la méthode AJAX en POST
			$this->show('users/changePassword');

		}else{
			echo 'error user_id';
		}
	}
}
