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

		
		if(!empty($_GET)) { 


			if(empty($current_user)) { 
				$errors[] = 'Vous devez être connecté pour publier un message';
			}

			foreach($_GET as $key => $value){
				$get[$key] = trim(strip_tags($value));
			}

			if(preg_match('#connard|con|enculé|connasse|pute|pd|pédé|fdp|salope|trouduc#', $get['message'])) {
				$errors[] = 'Attention à ton langage';
			}

			if(strlen($get['message']) < 2) { 
				$errors[] = 'Ton message doit faire au moins 2 caracteres mon lapin';
			}

			if(count($errors) === 0) { 
				
				$data = [
					'user_id' => $this->getUser()['id'], // $_SESSION['user']['id'] aurait également fonctionné.
					'message' => $get['message'],
					'username' => $this->getUser()['username'],
					'date_publi' => date('c'), // Correspond à (Y-m-d H:i:s)
					'game_id' => $get['idChat'],
				];

				$chatModel = new ChatModel();
				if($chatModel->insert($data)){
					$json = [
						'result' => true,
						'idChat' => $get['idChat'],
					];
				}
				else {
					$json = [
						'result' => false,
						'errors' => 'Une erreur est survenue lors de l\'envoi de votre message',
						'idChat' => $get['idChat'],
					];
				}
			}
			else { 
				$json = [
						'result' => false,
						'errors' => implode('<br>', $errors),
						'idChat' => $get['idChat'],
				];

			}
		}
		
		$this->showJson($json);
	}



	public function listMessagesAjax() { 

		$idChat = (int) $_GET['idChat'];
		$findAllMessages = new ChatModel();
		$allMessages = $findAllMessages->jointureChatUsers($idChat);
		
		$html = '<ul>';
		foreach($allMessages as $msg){
			$html.='<li><strong>'.$msg['username'].'</strong> ('.$msg['date_publi'].') : '.$msg['message'].'</li>';
		}
		$html.= '</ul>';

		$data = [
            'html' => $html,
			'gameId' => (int) $idChat,
		];
		$this->showJson($data);
	}

}// Fin de la class
