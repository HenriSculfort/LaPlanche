<?php

namespace Controller;

use \Model\UsersModel;
use \W\Controller\Controller;
use \Model\MessageModel;

class AdminGestionCompteController extends Controller
{

	public function gestionCompte()
	{
		if(!isset($_SESSION) || empty($_SESSION) || $_SESSION['user']['role'] != 'admin'){         
			$this->show('w_errors/403');            
		}
		else {	

			$this->show('admin/compte');
		}
	}


	public function gestionCompteAjax()
	{
		if(!isset($_SESSION) || empty($_SESSION) || $_SESSION['user']['role'] != 'admin'){         
			$this->show('w_errors/403');            
		}
		else {	
			if(isset($_GET['suppr']) && $_GET['suppr'] == 'off'){
				$roleModif = [
				'role' => $_GET['role'],
				];

				$UsersModel = new UsersModel();
				$update = $UsersModel->update($roleModif, $_GET['id']);

				if($update == true){

					$json = [
					'result' => true,
					'message' => 'Le rôle de l\'utilisateur a été modifié'
					];
				}

			}
			elseif(isset($_GET['suppr']) && $_GET['suppr'] == 'on'){
				$UsersModel = new UsersModel();
				$suppr = $UsersModel->delete((int) $_GET['id']);

				if($suppr == true){

					$json = [
					'result' => true,
					'message' => 'L\'utilisateur a été supprimé'
					];
				}
			}
			$this->showJson($json);
		}
	}


	public function getList()
	{
		if(!isset($_SESSION) || empty($_SESSION) || $_SESSION['user']['role'] != 'admin'){         
			$this->show('w_errors/403');            
		}
		else {	

			$UsersModel= new UsersModel();
			$listuser = $UsersModel->findAll('username');

			$html = '';

		//on génére le formulaire en Ajax
			foreach ($listuser as $key => $value) {

				$html .= '<tr>';
				$html .= '<form type="GET" id="user-id-' . $value['id'] . '">';
				$html .= '<td>' . $value['username'] . '</td>';
				$html .= '<td>' . $value['level'] . '</td>';
				$html .= '<td>' . $value['firstname'] . '</td>';
				$html .= '<td>' . $value['lastname'] . '</td>';
				$html .= '<td>' . $value['email'] . '</td>';
				$html .= '<td>' . $value['address'] . ' '. $value['postal_code'] . ' ' . $value['city'] . '</td>';
				$html .= '<td>' . $value['phone'] . '</td>';
				$html .= '<td><select name="role" class="select-role" id="role-' . $value['id'] . '" >';
				$html .= '<option value="user"';
				if(isset($value['role']) && $value['role'] == 'user'){
					$html .= 'selected';
				}
				$html .= '>User</option>';
				$html .= '<option value="admin"';
				if(isset($value['role']) && $value['role'] == 'admin'){ 
					$html .= 'selected';
				}
				$html .= '>Admin</option>';
				$html .= '</select></td><td>';
				$html .= '<input type="checkbox" name="suppr" id="suppr-' . $value['id'] . '">';
				$html .= '</td><td>';
				$html .= '<button type="submit" data-id="' . $value['id'] . '" class="btn btn-warning zob">Appliquer</button>';
				$html .= '</td></form></tr>';
			}

			$boucle = [
			'html' => $html,
			'listuser' => $listuser,
			'id_user' => $value['id'],
			'id' => $value['id']
			];

			$this->showJson($boucle);
		}
	}

	function changeLook() { 

		$message = null;
		if(!empty($_POST)) { 

			$post = array_map('trim', array_map('strip_tags', $_POST));

			$messageModel = new MessageModel();
			$message = $messageModel->updateHomeMessage($_post['message']);
		}

		$this->show('admin/website_look', ['message' => $message]);

	}

}
