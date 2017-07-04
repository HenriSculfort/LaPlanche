<?php

namespace Controller;

use \Model\TokensModel;
use \Model\UsersModel;
use Respect\Validation\Validator as v;

class TokensController extends \W\Controller\Controller
{
	public function creatTokens()
	{
		$get = [];
		$errors =[];
		$json = [];
		//inclusion des dépendances avec composer
		
		if(!empty($_GET)){

			foreach($_GET as $key => $value){
				$get[$key] = trim(strip_tags($value));
			}

		//le formulaire a été posté, l'email n'est pas vide et au bon format
			if(!v::notEmpty()->email()->validate($get['email'])){
				$errors[] = 'L\'adresse email est invalide';
			}
			if(count($errors) === 0){
			//On verifie que l'email est dans la base de donnée
				$usersModel = new UsersModel();
<<<<<<< HEAD
				$emailInBdd = $usersModel->emailExists($post['email']);
=======
				$emailInBdd = $usersModel->emailExists($get['email']);
>>>>>>> 6a129674620a59631a7a46d79e5ce2d14714e292


				//si le mail existe dans la base, on envoye un mail pour changer le mot de passe.
				if($emailInBdd == true){

<<<<<<< HEAD
					$user = $usersModel->getUserByUsernameOrEmail($post['email']); // Recherche un utilisateur par email ou username
=======
					$user = $usersModel->getUserByUsernameOrEmail($get['email']); // Recherche un utilisateur par email ou username
>>>>>>> 6a129674620a59631a7a46d79e5ce2d14714e292


					// On sauvegarde le token
					$token = md5(uniqid(rand(), true));
					// on enregistre l'id de l'utilisateur et le token généré dans la bdd
					$data=[
						'user_id' => $user['id'],
						'token' => $token
					];
					$TokensModel = new TokensModel();
					$insertToken = $TokensModel->insert($data);


					if(!empty($insertToken)) {
						// On envoi le mail
						$mail = new \PHPMailer();
						$mail->CharSet = 'UTF-8';
						$mail->isSMTP();
						$mail->Host = 'smtp.gmail.com';
						$mail->SMTPAuth = true;
						$mail->Username = 'testwf3mc@gmail.com';
						$mail->Password = 'ttttttttt';
						$mail->SMTPSecure = 'ssl'; 
						$mail->Port = 465;
						$mail->SetFrom('laplanche@wf3.fr', 'La Planche Team');
						//mail et nom du destinataire
<<<<<<< HEAD
						$mail->addAddress($post['email'], $user['username']);
						$mail->isHTML(true);
						$mail->Subject = 'La Planche mot de passe oublié';
						$mail->Body = '<p>Ce message vous est envoyé suite à une demande de récupération de mot de passe de connexion à La Planche.</p><br><strong>Cliquez sur le lien pour changer votre mot de passe: <a href="http://localhost/LaPlanche/w/app/Controller/TokensController.php?user_id=' . $user['id'] . '&token=' . $token . '">Modifier le mot de passe</a></strong><br><p>A bientôt sur La Planche</p><br><p>Cordialement,</p><p>L\'équipe La Planche Bordeaux</p>';
=======
						$mail->addAddress($get['email'], $user['username']);
						$mail->isHTML(true);
						$mail->Subject = 'La Planche mot de passe oublié';
						$mail->Body = '<p>Ce message vous est envoyé suite à une demande de récupération de mot de passe de connexion à La Planche.</p><br><strong>Cliquez sur le lien pour changer votre mot de passe: <a href="http://localhost/LaPlanche/w/public/changePassword/?user_id=' . $user['id'] . '&token=' . $token . '">Modifier le mot de passe</a></strong><br><p>A bientôt sur La Planche</p><br><p>Cordialement,</p><p>L\'équipe La Planche Bordeaux</p>';
>>>>>>> 6a129674620a59631a7a46d79e5ce2d14714e292

						//Si l'email est envoyé, renvoye vrai à l'Ajax pour afficher un message de réussite
						if($mail->Send()){
							$json = [
								'result' => true,
								'message' => 'email envoyé'
							];

						}
						else {
							$json = [
								'result' => false,
								'errors' => 'Le mail n\'a pas été envoyé' //liste toutes les erreurs dans une chaîne string qui seront séparées par un <br>
							];

						}
					}
					else{ // Erreur de sauvegarde du token en BDD

						$json = [
							'result' => false,
							'errors' => 'Une erreur est survenue lors de la sauvegarde en base de données'
						];
					}

				}else{

					$json = [
						'result' => false,
						'errors' => 'Cette email n\'existe pas'
					];

				}
			}else{

				$json = [
				'result' => false,
				'errors' => implode('<br>', $errors)
				];

			}
		}
		$this->showJson($json);
	}

	public function formTokens()
	{
		$this->show('users/tokensForm');
	}
}