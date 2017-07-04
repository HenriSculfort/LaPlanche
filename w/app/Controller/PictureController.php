<?php

namespace Controller;

use Intervention\Image\ImageManagerStatic as Image;

class PictureController extends Controller
{

//*************** Suppression de la photo et suppression dans le fichier source************************//

	public function deletePicture

        if(isset($_GET['id'])){
            $reponse = $bdd->prepare('SELECT * FROM pictures WHERE id = :id');
            $reponse -> bindValue(':id',htmlspecialchars($_GET['id']), PDO::PARAM_INT);
            $reponse -> execute();
            $nom=$reponse->fetch();
            $reponse -> closeCursor(); 


            $reponse = $bdd->prepare('DELETE FROM pictures WHERE id = :id');
            $reponse -> bindValue(':id',htmlspecialchars($_GET['id']), PDO::PARAM_INT);
            $reponse -> execute();


            if($reponse -> execute()){
                unlink('../docs/tuto/img/uploads/thumbnails/'.$nom['name']);
                unlink('../docs/tuto/img/uploads/'.$nom['name']);

            }
        }

    public function addPicture

        if(isset($_FILES['name'])){

            $maxfilesize = 1048576; //1 Mo

            if($_FILES['name']['error'] === 0 AND $_FILES['name']['size'] < $maxfilesize){
                //pas d'erreur et le fichier n'est pas trop volumineux
                //on teste l'extension
                $extensions_autorisees = array('jpg', 'jpeg', 'png', 'gif');
                $fileInfo = pathinfo($_FILES['name']['name']);
                $extension = $fileInfo['extension'];
                if(in_array($extension, $extensions_autorisees)){
                    //extension valide
                    echo 'c\'est bon<br>';
                    //transférer définitivement le fichier sur le serveur
                    //on renomme le fichier
                    if($extension == 'jpg' OR $extension == 'jpeg'){
                        //jpeg ou pjg
                        $newImage = imagecreatefromjpeg($_FILES['name']['tmp_name']);
                    }
                    elseif($extension == 'png'){
                        //png
                        $newImage = imagecreatefrompng($_FILES['name']['tmp_name']);
                    }
                    else{
                        //fichier gif
                        $newImage = imagecreatefromgif($_FILES['name']['tmp_name']);
                    }


                    $image = Image::make('$newImage')->resize(300, 200);

                   
                    $nom = md5(uniqid(rand(), true));
                   
                    move_uploaded_file($_FILES['name']['tmp_name'], 'uploads/'.$nom.'.'.$extension);

					//ajouter des donnees
					$reponse = $bdd->prepare('INSERT INTO courts(picture) VALUES (:name)');
					$reponse->bindValue(':name', $nom.'.'.$extension, PDO::PARAM_STR);
					$reponse->execute();
					//quand on a fini de traiter la réponse
					$reponse->closeCursor();
		

				}
				else{
					//extension non autorisée
					echo 'pas bonne extension';
				}
			}
			else{//problème:
				if($_FILES['name']['error'] > 0){
				//erreur lors du transfert
					echo 'erreur de transfert';
				}
				else{
					//fichier trop volumineux
					echo 'fichier trop gros';
				}
				echo 'c\'est pas bon';
			}
				//pour tester l'extension du fichier
			$fileInfo = pathinfo($_FILES['name']['name']);
			print_r($fileInfo);
		}

        $this->show('user_myspace');

}