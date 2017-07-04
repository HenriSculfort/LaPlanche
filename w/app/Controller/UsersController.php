<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Model\UsersModel;
use \W\Security\AuthentificationModel;

class UsersController extends Controller
{

	public function add()
	{

		$post = [];
		$errors = [];
		$formValid = false;

		if(!empty($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));

			if(!filter_var($post['emailInscription'], FILTER_VALIDATE_EMAIL)) {
				$errors[] = 'Votre adresse email est invalide';
			}
			
			if(strlen($post['passwordInscription']) < 8){
				$errors[] = 'Votre mot de passe doit comporter au moins 8 caractères';
			}

			if(($post['passwordInscription']) != ($post['ControlPasswordInscription'])){
				$errors[] = 'Vos mot de passe ne sont pas identiques';
			}
			if(count($errors) === 0){

				$json = [
				'result' => true,
				];
			}
			else {
				$json = [
				'result' => false,
				'errors' => implode('<br>', $errors),
				];
			}
			$this->showJson($json);

		}
		$this->show('users/add');
	}

	public function insert()
	{
	
	}



	public function login()
	{
		$post = [];
		$errors = [];

		if(!empty($_POST)){

			$post = array_map('trim', array_map('strip_tags', $_POST));

			$authModel = new AuthentificationModel();
			$id_user = $authModel->isValidLoginInfo($post['emailConnexion'], $post['passwordConnexion']);

			if($id_user > 0){ 

				$json = [
				'result' => true,
				];

				$usersModel = new UsersModel();
				$me = $usersModel->find($id_user); 
				$authModel->logUserIn($me); 

				if(!empty($authModel->getLoggedUser())){

					$this->flash('Vous êtes desormais connecté', 'success');
					$this->redirectToRoute('accueil');
				}
			}
			else {
				$errors[] = 'Le couple identifiant / mot de passe est invalide';
				$json = [
				'result' => false,
				'errors' => implode('<br>', $errors),
				];
			}
			$this->showJson($json);
		}	
	}


	public function logout()
	{
		$this->show('logout');
	}


	public function mySpace() 
	{ 
		// En attendant qu'une connexion soit possible, pour pouvoir travailler dessus
		//if(empty($_SESSION)) { 
		//	$this->show('w_errors/403');
		//} else { 
		$this->show('users/user_myspace');
		//}
	}
}
