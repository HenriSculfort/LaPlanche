<?php

namespace Controller;

use \Model\UsersModel;
use \W\Controller\Controller;

class AdminGestionCompteController extends Controller
{

	public function gestionCompte()
	{
		
		$UsersModel= new UsersModel();
		$listuser = $UsersModel->findAll('username');
		$param=[
		'listuser' => $listuser
		];

		$this->show('admin/compte', $param);
	}

	public function gestionCompteAjax()
	{
		if(isset($_GET['suppr'])){
			$UsersModel = new UsersModel();
			$suppr = $UsersModel->delete($_GET['suppr']);

			$json = [
			'result' => true,
			'message' => 'L\'utilisateur a été supprimer'
			];

		}else{

			$roleModif = [
			'role' => $_GET['role']
			];

			$UsersModel = new UsersModel();
			$update = $UsersModel->update($roleModif, $_GET['id']);

			$json = [
			'result' => true,
			'message' => 'Le rôle de l\'utilisateur a été modifié'
			];
		}
		$this->showJson('admin/compte');
	}
}
