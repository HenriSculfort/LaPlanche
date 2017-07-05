<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Model\UsersModel;
use \W\Security\AuthentificationModel;

class UsersController extends Controller
{
	public function add()
	{
		// permet d'afficher le formulaire d'inscription
		$this->show('users/add');
	}


	public function insert()
	{

		$post = [];
		$errors = [];
		$recapErrors = [];
		$usersModel = new UsersModel();

		if(!empty($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));

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
			}
			if(count($errors) === 0){
				$authModel = new AuthentificationModel();

				// insertion des données en base
				$data = [
				'firstname' => ucfirst($post['firstname']),
				'lastname' 	=> ucfirst($post['lastname']),
				'address' 	=> ucwords($post['address']),
				'postal_code' 	=> $post['cp'],
				'city' 	=> ucfirst($post['city']),
				'email' 	=> $post['email'],
				'phone' 	=> $post['phone'],
				'username' 	=> $post['username'],
				'level' 	=> $post['level'],
				'password' 	=> $authModel->hashPassword($post['password']),
				];

				$insert = $usersModel->insert($data);

				$json = [
				'result' => true,
				];
			}
			else {

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

				$usersModel = new UsersModel();
				$me = $usersModel->find($id_user); 
				$authModel->logUserIn($me); 

				if(!empty($authModel->getLoggedUser())){
					$json = [
					'result' => true,
					];
					$this->flash('Vous êtes connecté', 'success');
				}
			}
			else {
				$json = [
				'result' => false,
				'errors' => 'Le couple identifiant / mot de passe est invalide',
				];
			}
			$this->showJson($json);
		}	
	}


	public function logout()
	{
		$authModel = new AuthentificationModel();
		$authModel->logUserOut();

		if(empty($authModel->getLoggedUser())){
			// Si l'utilisateur est "vide", on a donc bien vider la session, il est donc déconnecté
			$this->flash('Vous êtes déconnecté', 'success');
			$this->redirectToRoute('accueil');
		}
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
