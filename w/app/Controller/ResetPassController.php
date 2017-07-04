<?php

namespace Controller;

use \Model\TokensModel;
use \Model\UsersModel;
use Respect\Validation\Validator as v;

class ResetPassController extends \W\Controller\Controller
{
    public function resetPass()
    {
        //		if(isset($_GET['user_id']) AND isset($_GET['token']) AND !empty($_GET['user_id']) AND !empty($_GET['token'])){
        //			//si les variables existent, ne sont pas vides et que l'id est composé uniquement de chiffres on va chercher s'il y a une correspondance dans la bdd
        //			$TokensModel = new TokensModel();
        //			$compare = $TokensModel->verifToken();
        //
        //			$compare->fetchAll();
        //
        //			if(count($compare) === 1){

        $post = [];
        $errors = [];

        if(!empty($_POST)){
            //si un id est trouvé
            foreach($_POST as $key => $value){
                $post[$key] = trim(strip_tags($value));
            }

            if(!isset($post['mdp']) || !isset($post['mdp2']) || !isset($post['id']) || empty($post['mdp']) || empty($post['mdp2']) || empty($post['id'])){

                $errors[] = 'Veuillez remplir les champs';

            } 

            if(!ctype_digit($post['id'])){

                $errors[] = 'Une erreur est survenue pendant la récupération de votre session';

            }

            if(($post['mdp']) != ($post['mdp2'])){

                $errors[] = 'La confirmation du mot de passe est invalide';
            }

            if(!v::stringType()->length(8, 30)->validate($post['mdp']))
            {
                $errors[] = 'Le mot de passe doit comporter au moins 8 caractères';
            }
            if(count($errors) === 0){

                $mdp = [
                    'password'=>password_hash(trim($post['mdp']), PASSWORD_DEFAULT),
                ];

                $UsersModel = new UsersModel();
                $update = $UsersModel->update($mdp,$post['id']);
                if(!empty($update)){

//                    $TokensModel = new TokensModel();
//                    $delete = $TokensModel->deleteToken($token);
                    $json = [ 
                        'result'    => true,
                        'message'   => 'Votre mot de passe a été réinitialisé',
                    ];
                }
                else{
                    $json = [
                        'result'=>false,
                        'errors'=>'Uploade impossible'
                    ];
                }


                //                if($update == true){
                //
                //
                //                }else{
                //                    $json = [
                //                        'result'=>false,
                //                        'errors'=>'Uploade impossible'
                //                    ];
                //                }
            }
            else{
                $json=[
                    'result'=>false,
                    'errors'=>implode('<br>', $errors)
                ];
            }
            $this->showJson($json);
        }
        //			}else{
        //				$json=[
        //				'result'=>false,
        //				'errors'=>'Aucun utilisateur trouvé'
        //				];
        //			}
        //		}else{
        //			$json=[
        //			'result'=>false,
        //			'errors'=>'Les données reçues sont invalides'
        //			];
        //		}

    }


    public function changePass()
    {
        // Vérif que les GET soient présents
        // Si ok, affichage du formulaire, sinon erreur

        // Si ok, on accède a la méthode AJAX en POST
        $this->show('users/changePassword');
    }
}
