<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Model\UsersModel;
use \W\Security\AuthentificationModel;

class UsersController extends Controller
{
<<<<<<< HEAD
	public function add(){
		$this->show('users/add');
	}

	public function insert()
=======
	public function add()
>>>>>>> 6a129674620a59631a7a46d79e5ce2d14714e292
	{
		// permet d'afficher le formulaire d'inscription
		$this->show('users/add');
	}


	public function insert()
	{

		$post = [];
		$errors = [];
<<<<<<< HEAD
=======
		$recapErrors = [];
		$usersModel = new UsersModel();
>>>>>>> 6a129674620a59631a7a46d79e5ce2d14714e292

		if(!empty($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));

<<<<<<< HEAD
			if(empty($post['firstname'])){
				$errors['firstname'] = 'Veuillez renseigner votre prénom';
			}

			if(empty($post['lastname'])){
				$errors['lastname'] = 'Veuillez renseigner votre nom';
			}

			if(empty($post['address'])){
				$errors['address'] = 'Veuillez renseigner votre adresse';
			}

			if(empty($post['cp'])){
				$errors['cp'] = 'Veuillez renseigner votre code postal';
			}

			if(empty($post['ville'])){
				$errors['city'] = 'Veuillez renseigner votre ville';
			}

			if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
				$errors['email'] = 'Votre adresse email est invalide';
			}
			
			if(strlen($post['password']) < 8){
				$errors['password'] = 'Votre mot de passe doit comporter au moins 8 caractères';
			}

			if(($post['password']) != ($post['checkPassword'])){
				$errors[] = 'Vos mot de passe ne sont pas identiques';
=======
			// vérifie le prénom
			if(isset($post['firstname']) && empty($post['firstname'])){
				$errors['prenom'] = 'Veuillez renseigner votre prénom';
			}

			// vérifie le nom
			if(isset($post['lastname']) && empty($post['lastname'])){
				$errors['nom'] = 'Veuillez renseigner votre nom';
			}

			// vérifie l'adresse
			if(isset($post['address']) && empty($post['address'])){
				$errors['adresse'] = 'Veuillez renseigner votre adresse';
			}

			// vérifie le code postal
			if(isset($post['cp']) && (strlen($post['cp']) != 5) || !is_numeric($post['cp'])){
				$errors['code_postal'] = 'Votre code postal doit être composé de 5 chiffres';
			}

			// vérifie la ville
			if(isset($post['city']) && empty($post['city'])){
				$errors['ville'] = 'Veuillez renseigner votre ville';
			}

			// vérifie le format d'email
			if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
				$errors['mail'] = 'Votre adresse email est invalide';
			}

			// vérifie si l'email existe en base
			$emailExists = $usersModel->emailExists($post['email']);
			if($emailExists == true){
				$errors['mail_exist'] = 'Cette adresse email est déjà enregistrée';
			}

			// vérifie le pseudo
			if(isset($post['username']) && empty($post['username']) || strlen($post['username']) < 3){
				$errors['pseudo'] = 'Votre pseudo doit contenir au moins 3 caractères';
			}

			// vérifie si l'email existe en base
			$usernameExists = $usersModel->usernameExists($post['username']);
			if($usernameExists == true){
				$errors['username_exist'] = 'Ce pseudo existe déjà';
			}
			
			// vérifie le mot de passe
			if(strlen($post['password']) < 8){
				$errors['mot_de_passe'] = 'Votre mot de passe doit comporter au moins 8 caractères';
			}

			// vérifie que les mots de passe soient identiques
			if($post['password'] != $post['checkPassword']){
				$errors['verif_mot_de_passe'] = 'Vos mot de passe doivent être identiques';
>>>>>>> 6a129674620a59631a7a46d79e5ce2d14714e292
			}
			if(count($errors) === 0){
				$authModel = new AuthentificationModel();

				// insertion des données en base
				$data = [
				'firstname' => ucfirst($post['firstname']),
				'lastname' 	=> ucfirst($post['lastname']),
				'address' 	=> ucwords($post['address']),
				'cp' 	=> $post['cp'],
				'city' 	=> ucfirst($post['city']),
				'email' 	=> $post['email'],
				'phone' 	=> $post['phone'],
				'username' 	=> $post['username'],
				'level' 	=> $post['level'],
				'password' 	=> $authModel->hashPassword($post['password']),
				];

<<<<<<< HEAD
=======
				$insert = $usersModel->insert($data);

>>>>>>> 6a129674620a59631a7a46d79e5ce2d14714e292
				$json = [
				'result' => true,
				];
			}
			else {
<<<<<<< HEAD
				$recapErrors =[
					'firstname' => $errors['firstname'],
=======

				// définie les erreurs du formulaire
				$recapErrors = [
				'prenom' => isset($errors['prenom']) ? $errors['prenom'] : '',
				'nom' => isset($errors['nom']) ? $errors['nom'] : '',
				'adresse' => isset($errors['adresse']) ? $errors['adresse'] : '',
				'code_postal' => isset($errors['code_postal']) ? $errors['code_postal'] : '',
				'ville' => isset($errors['ville']) ? $errors['ville'] : '',
				'mail' => isset($errors['mail']) ? $errors['mail'] : '',
				'mail_exist' => isset($errors['mail_exist']) ? $errors['mail_exist'] : '',
				'username_exist' => isset($errors['username_exist']) ? $errors['username_exist'] : '',
				'pseudo' => isset($errors['pseudo']) ? $errors['pseudo'] : '',
				'mot_de_passe' => isset($errors['mot_de_passe']) ? $errors['mot_de_passe'] : '',
				'verif_mot_de_passe' => isset($errors['verif_mot_de_passe']) ? $errors['verif_mot_de_passe'] : '',
>>>>>>> 6a129674620a59631a7a46d79e5ce2d14714e292
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
