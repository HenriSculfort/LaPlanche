<?php

namespace Controller;

use \Model\UsersModel;
use \W\Controller\Controller;

class AdminGestionCompteController extends Controller
{

	public function gestionCompte()
	{

		
		if(!isset($w_user) || empty($w_user) || $w_user['role'] != 'admin'){
				$this->show('w_errors/403');
		}
		else {
	
			$UsersModel= new UsersModel();
			$listuser = $UsersModel->findAll('username');
			$param=[
			'listuser' => $listuser
			];

			$this->show('admin/compte', $param);
		}
	}


	public function gestionCompteAjax()
	{
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
				'message' => 'L\'utilisateur a été supprimer'
				];
			}
		}
		$this->showJson($json);
	}
}
