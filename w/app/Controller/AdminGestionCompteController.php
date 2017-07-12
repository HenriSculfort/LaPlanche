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
			
			if(isset($_GET['suppr']) && $_GET['suppr'] == 'off' && $_GET['blacklist'] == 'autorisé'){
				$roleModif = [
				'role' => $_GET['role'],
				];
				$blacklist = [
				'blacklist' => $_GET['blacklist'],
				];

				$UsersModel = new UsersModel();
				$update = $UsersModel->update($roleModif, $_GET['id']);
				$update = $UsersModel->update($blacklist, $_GET['id']);

				if($update == true){

					$json = [
					'result' => true,
					'message' => 'L\'utilisateur '.$_GET['username'].' est '.$_GET['blacklist'].', son rôle est '.$_GET['role'],
					];
				}
			}
			elseif(isset($_GET['suppr']) && $_GET['suppr'] == 'off' && $_GET['blacklist'] == 'bloqué'){
				$blacklist = [
				'blacklist' => $_GET['blacklist'],
				];
				$roleModif = [
				'role' => $_GET['role'],
				];

				$UsersModel = new UsersModel();
				$update = $UsersModel->update($roleModif, $_GET['id']);
				$update = $UsersModel->update($blacklist, $_GET['id']);

				if($update == true){

					$json = [
					'result' => true,
					'message' => 'L\'utilisateur '.$_GET['username'].' est '.$_GET['blacklist'].', son rôle est '.$_GET['role'],
					];
				}
			}
			elseif(isset($_GET['suppr']) && $_GET['suppr'] == 'on'){
				$UsersModel = new UsersModel();
				$suppr = $UsersModel->delete((int) $_GET['id']);

				if($suppr == true){

					$json = [
					'result' => true,
					'message' => 'L\'utilisateur '.$_GET['username'].' a été supprimé'
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
				$html .= '<form method="GET" id="user-id-' . $value['id'] . '">';
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
				$html .= '</td>';

				$html .= '<td><select name="blacklist" class="select-blacklist" id="blacklist-' . $value['id'] . '" >';
				$html .= '<option value="autorisé"';
				if(isset($value['blacklist']) && $value['blacklist'] == 'autorisé'){
					$html .= 'selected';
				}
				$html .= '>Autorisé</option>';
				$html .= '<option value="bloqué"';
				if(isset($value['blacklist']) && $value['blacklist'] == 'bloqué'){ 
					$html .= 'selected';
				}
				$html .= '>Bloqué</option>';
				$html .= '</select></td><td>';
				$html .='<input type="hidden" id="username'.$value['id'].'" name="username" value="'. $value['username'] . '">';
				$html .= '<button type="submit" data-id="' . $value['id'] . '" class="btn btn-warning zob">Appliquer</button>';
				$html .= '</td></form></tr>';
			}

			$boucle = [
			'html' => $html,
			'listuser' => $listuser,
			'id_user' => $value['id'],
			'id' => $value['id'],
			'username' => $value['id'],
			];
			$this->showJson($boucle);
		}
	}
	public function showMessage() { 

		$this->show('admin/website_look');
	}

	public function loadMessage() { 

		$messageModel = new MessageModel();
		$message = $messageModel->selectHomeMessage();
		$this->showJSON($message);
	}

	public function changeMessage() { 

		if(!empty($_POST)) { 

			$post = array_map('trim', array_map('strip_tags', $_POST));

			$messageModel = new MessageModel();
			if(strlen($post['message']) == 0) { 
				$status = 'hide';
			} else { 
				$status = 'show';
			}
			$message = $messageModel->updateHomeMessage($post['message'], $status);
		
			$json = [ 
        		'result' => true,
        		'message' => $post['message'],
        		'success' => 'Message modifié',
        	];
        }
        else { 
        	$json = [ 
        		'result' => false,
        		'error' => 'Le message ,n\'a pas été modifié',
        	];
        }
        $this->showJSON($json);

		}


	function changeBackground ()
	{
		$picture=[];
		if(isset($_FILES['name'])){

            $maxfilesize = 5048576; 

            if($_FILES['name']['error'] === 0 AND $_FILES['name']['size'] < $maxfilesize){
                //pas d'erreur et le fichier n'est pas trop volumineux
                //on teste l'extension
                $extensions_autorisees = array('jpg', 'jpeg', 'png', 'gif', 'PNG', 'JPEG', 'JPG', 'GIF');
                	$fileInfo = pathinfo($_FILES['name']['name']);

                	$extension = $fileInfo['extension'];


                	if(in_array($extension, $extensions_autorisees)){
                        //extension valide
                        //on renomme le fichier
                		switch ($extension) {
                			case 'jpg':
                            case 'JPG':
                			$newImage = imagecreatefromjpeg($_FILES['name']['tmp_name']);
                			break;
                			case 'jpeg':
                            case 'JPEG':
                			$newImage = imagecreatefromjpeg($_FILES['name']['tmp_name']);
                			break;
                			case 'png':
                            case 'PNG':
                			$newImage = imagecreatefrompng($_FILES['name']['tmp_name']);
                			break;
                			case 'gif':
                            case 'GIF':
                			$newImage = imagecreatefromgif($_FILES['name']['tmp_name']);
                			break;
                		};


                        //largeur
                		$imageWidth = imagesx($newImage);
                         //hauteur
                		$imageHeight = imagesy($newImage);
                      // je décide de la largeur des miniatures
                		$newWidth = 200;
                        //on calcule la nouvelle hauteur
                		$newHeight = ($imageHeight * $newWidth) / $imageWidth ;
                        // on crée la nouvelle image 
                		$miniature = imagecreatetruecolor($newWidth, $newHeight);
                		imagecopyresampled($miniature, $newImage, 0, 0, 0, 0, $newWidth, $newHeight, $imageWidth, $imageHeight);


                		$picture = md5(uniqid(rand(), true));

                		if($extension == 'jpeg' OR $extension == 'jpg' OR $extension == 'JPEG' OR $extension == 'JPG'){  
                			$picture.='.'.$extension;
                			imagejpeg($miniature, '../public/assets/img/uploads/thumbnails/'.$picture);
                		} elseif($extension == 'png' OR $extension == 'PNG'){
                			$picture.='.'.$extension;
                			imagepng($miniature, '../public/assets/img/uploads/thumbnails/'.$picture);
                		} elseif($extension == 'gif' OR $extension == 'GIF'){
                			$picture.='.'.$extension;
                			imagegif($miniature, '../public/assets/img/uploads/thumbnails/'.$picture);
                		}

                		move_uploaded_file($_FILES['name']['tmp_name'], '../public/assets/img/uploads/'.$picture);

					}else{
						//extension non autorisée
						echo 'ce n\'est pas une bonne extension';
					}
			}else{//problème:
				if($_FILES['name']['error'] > 0){
					//erreur lors du transfert
					echo 'erreur de transfert';
				}else{
					//fichier trop volumineux
					echo 'Le fichier est trop gros';
				}			
			}

			$status = 'show';
			$messageModel = new MessageModel();
			$message = $messageModel->updateBackground($picture, $status);

		}

		$this->redirectToRoute('accueil');
	}


	function newBackground()
	{
		$messageModel = new MessageModel();
		$picture = $messageModel->showBackground();
		var_dump($picture);
		$this->show('default/index',['picture' =>$picture]);
	}

}
