<?php

namespace Controller;

use \W\Controller\Controller;

class ChatController extends Controller
{

	public function chat() 
	{

		$this->show('default/court_details');
	}

	public function addMessageAjax() { 

		
		$json = [];
		$errors = [];
		$current_user = $this->getUser();

		
		if(!empty($_POST)) { 


			if(empty($current_user)) { 
				$errors[] = 'Vous devez être connecté pour publier un message';
			}

			foreach($_POST as $key => $value){
				$post[$key] = trim(strip_tags($value));
			}

			if(preg_match('#connard|con|enculé|connasse|pute|pd|pédé|fdp|salope|trouduc#', $post['message'])) {
				$errors[] = 'Attention à ton langage petit poulet';
			}

			if(strlen($post['message']) < 2) { 
				$errors[] = 'Ton message doit faire au moins 2 caracteres mon lapin';
			}

			if(count($errors) === 0) { 
				
				$data = [
					'id_user' => $this->getUser()['id'], // $_SESSION['user']['id'] aurait également fonctionné.
					'message' => $post['message'],
					'date_publish' => date('c'), // Correspond à (Y-m-d H:i:s)
				];

				$chatModel = new ChatModel();
				if($chatModel->insert($data)){
					$json = [
						'result' => true,
					];
				}
				else {
					$json = [
						'result' => false,
						'errors' => 'Une erreur est survenue lors de l\'envoi de votre message',
					];
				}
			}
			else { 
				$json = [
						'result' => false,
						'errors' => implode('<br>', $errors),
				];

			}
		}
		
		$this->showJson($json);

	}


	public function listMessagesAjax() { 

		$findAllMessages = new ChatModel();
		$allMessages = $findAllMessages->findJointure();
	
		$html = '<ul>';
		foreach($allMessages as $msg){
			$html.='<li><strong>'.$msg['firstname'].'</strong> ('.$msg['date_publish'].') : '.$msg['message'].'</li>';
		}

		$html.= '</ul>';

		$this->showJson($html);
	}

}// Fin de la class
