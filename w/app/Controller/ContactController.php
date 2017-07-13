<?php

namespace Controller;

use \W\Controller\Controller;


class ContactController extends Controller
{

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

			$post = array_map('trim', array_map('strip_tags', $_POST));
			// vérifie le prénom
			if(isset($post['name']) && empty($post['name'])){
				$errors['nom'] = 'Veuillez renseigner votre nom';
			}
			// vérifie le format d'email
			if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
				$errors['mail'] = 'Votre adresse email est invalide';
			}
			// vérifie le message
			if(isset($post['message']) && empty($post['message'])){
				$errors['message'] = 'Veuillez ajouter votre message';
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
				$mail->Subject = 'Message de : '.$post['name'];
				$mail->Body = 	'<p>Vous avez reçu un nouveau message de : '.ucfirst($post['name']).'.</p><br><br>
								<p>Adresse email de l\'expéditeur : '.$post['email'].'.</p><br><br>
								<p>Contenu du message : '.ucfirst($post['message']).'.</p><br>';

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
				// Définit les erreurs du formulaire
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