<?php

namespace Controller;

use \Model\UsersModel;
use \W\Controller\Controller;

class AdminGestionCompteController extends Controller
{
	public function gestionCompte()
	{
		
		$UsersModel= new UsersModel();
		$listuser = $UsersModel->findAll('id');
		$param=[
		'listuser' => $listuser
		];

	$this->show('admin/compte', $param);
	}
}
