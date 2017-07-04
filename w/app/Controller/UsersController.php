<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Model\UsersModel;
use \W\Security\AuthentificationModel;

class UsersController extends Controller
{
	public function add(){
		$this->show('users/add');
	}

	public function insert()
	{

		$post = [];
		$errors = [];
		$recapErrors = [];

		if(!empty($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));

			if(isset($post['firstname']) && empty($post['firstname'])){
				$errors['prenom'] = 'Veuillez renseigner votre prénom';
			}

			if(isset($post['lastname']) && empty($post['lastname'])){
				$errors['nom'] = 'Veuillez renseigner votre nom';
			}

			if(isset($post['address']) && empty($post['address'])){
				$errors['adresse'] = 'Veuillez renseigner votre adresse';
			}

			if(isset($post['cp']) && (strlen($post['cp']) != 5) || !is_numeric($post['cp'])){
				$errors['code_postal'] = 'Votre code postal doit être composé de 5 chiffres';
			}

			if(isset($post['city']) && empty($post['city'])){
				$errors['ville'] = 'Veuillez renseigner votre ville';
			}

			if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
				$errors['mail'] = 'Votre adresse email est invalide';
			}

			if(isset($post['username']) && empty($post['username']) || strlen($post['username']) < 3){
				$errors['pseudo'] = 'Votre pseudo doit contenir au moins 3 caractères';
			}
			
			if(strlen($post['password']) < 8){
				$errors['mot_de_passe'] = 'Votre mot de passe doit comporter au moins 8 caractères';
			}

			if($post['password'] != $post['checkPassword']){
				$errors['verif_mot_de_passe'] = 'Vos mot de passe doivent être identiques';
			}
			if(count($errors) === 0){
				$authModel = new AuthentificationModel();

				$data = [
				'firstname' => $post['firstname'],
				'lastname' 	=> $post['lastname'],
				'address' 	=> $post['address'],
				'cp' 	=> $post['cp'],
				'city' 	=> $post['city'],
				'email' 	=> $post['email'],
				'phone' 	=> $post['phone'],
				'username' 	=> $post['username'],
				'level' 	=> $post['level'],
				'password' 	=> $authModel->hashPassword($post['password']),
				];

				$usersModel = new UsersModel();
				$insert = $usersModel->insert($data);

				$json = [
				'result' => true,
				];
			}
			else {
				$recapErrors = [
				'prenom' => isset($errors['prenom']) ? $errors['prenom'] : '',
				'nom' => isset($errors['nom']) ? $errors['nom'] : '',
				'adresse' => isset($errors['adresse']) ? $errors['adresse'] : '',
				'code_postal' => isset($errors['code_postal']) ? $errors['code_postal'] : '',
				'ville' => isset($errors['ville']) ? $errors['ville'] : '',
				'mail' => isset($errors['mail']) ? $errors['mail'] : '',
				'pseudo' => isset($errors['pseudo']) ? $errors['pseudo'] : '',
				'mot_de_passe' => isset($errors['mot_de_passe']) ? $errors['mot_de_passe'] : '',
				'verif_mot_de_passe' => isset($errors['verif_mot_de_passe']) ? $errors['verif_mot_de_passe'] : '',
				];

				$json = [
				'result' => false,
				'errors' => $recapErrors,
				];
			}
			$this->showJson($json);
		}
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
