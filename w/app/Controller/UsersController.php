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

			if(empty($post['firstname'])){
				$errors[] = 'Veuillez renseigner votre prénom';
			}

			if(empty($post['lastname'])){
				$errors[] = 'Veuillez renseigner votre nom';
			}

			if(empty($post['adress'])){
				$errors[] = 'Veuillez renseigner votre adresse';
			}

			if(empty($post['cp'])){
				$errors[] = 'Veuillez renseigner votre code postal';
			}

			if(empty($post['ville'])){
				$errors[] = 'Veuillez renseigner votre ville';
			}

			if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
				$errors[] = 'Votre adresse email est invalide';
			}
			
			if(strlen($post['password']) < 8){
				$errors[] = 'Votre mot de passe doit comporter au moins 8 caractères';
			}

			if(($post['password']) != ($post['checkPassword'])){
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
