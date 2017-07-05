<?php

namespace Controller;

use \W\Controller\Controller;

class ContactController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function showForm()
	{
		$this->show('default/contact');
	}

	public function sendForm()
	{
		$post = [];
		$errors =[];
		$json = [];
		
		if(!empty($_POST)){

			foreach($_POST as $key => $value){
				$post[$key] = trim(strip_tags($value));
			}

			// vérifie le prénom
			if(isset($post['name']) && empty($post['name'])){
				$errors['nom'] = 'Veuillez renseigner votre nom';
			}
			//l'email n'est pas vide et au bon format
			if(!v::notEmpty()->email()->validate($post['email'])){
				$errors['mail'] = 'L\'adresse email est invalide';
			}

			// vérifie le message
			if(isset($post['message']) && empty($post['message'])){
				$errors['message'] = 'Veuillez renseigner votre nom';
			}

			if(count($errors) === 0){

				// On envoi le mail
				$mail = new \PHPMailer();
				$mail->CharSet = 'UTF-8';
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'laplanche.bordeaux@gmail.com';
				$mail->Password = 'lefhn33000';
				$mail->SMTPSecure = 'ssl'; 
				$mail->Port = 465;
				$mail->SetFrom('laplanche.bordeaux@gmail.com', 'La Planche Team');
				//mail et nom du destinataire
				$mail->addAddress('laplanche.bordeaux@gmail.com');
				$mail->isHTML(true);
				$mail->Subject = 'La Planche mot de passe oublié';
				$mail->Body = '';

				//Si l'email est envoyé, renvoye vrai à l'Ajax pour afficher un message de réussite
				if($mail->Send()){
					$json = [
					'result' => true,
					];
				}
				else{
					$json = [
					'result' => false,
					'errors' => 'L\'email n\'a pas été envoyé',
					];
				}
			}
			else{
				// définie les erreurs du formulaire
				$recapErrors = [
				'nom' => isset($errors['nom']) ? $errors['nom'] : '',
				'mail' => isset($errors['mail']) ? $errors['mail'] : '',
				'message' => isset($errors['message']) ? $errors['message'] : '',
				];

				$json = [
				'result' => false,
				'errors' => $recapErrors,
				];	
			}
			$this->showJson($json);	
		}
	}	
	
}