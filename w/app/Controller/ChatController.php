<?php

namespace Controller;

use \W\Controller\Controller;
use Model\ChatModel;

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
				$errors[] = 'Attention à ton langage';
			}

			if(strlen($post['message']) < 2) { 
				$errors[] = 'Ton message doit faire au moins 2 caracteres mon lapin';
			}

			if(count($errors) === 0) { 
				
				$data = [
					'user_id' => $this->getUser()['id'], // $_SESSION['user']['id'] aurait également fonctionné.
					'message' => $post['message'],
					'username' => $this->getUser()['username'],
					'date_publi' => date('c'), // Correspond à (Y-m-d H:i:s)
					'game_id' => $post['game_id'],
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


	public function listMessagesAjax($idChat) { 


		$findAllMessages = new ChatModel();
		$allMessages = $findAllMessages->jointureChatUsers($idChat);
		
		$html = '<ul>';
		foreach($allMessages as $msg){
			$html.='<li><strong>'.$msg['username'].'</strong> ('.$msg['date_publi'].') : '.$msg['message'].'</li>';
			$game_id = $msg['game_id'];
		}
		$html.= '</ul>';

		$data = ['html' => $html,
			'game_id' => $game_id,
		];
		$this->showJson($data);
	}

}// Fin de la class
