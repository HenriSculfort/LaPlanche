<?php
namespace Controller;

use \W\Controller\Controller;
use Model\CourtsModel;
use Model\GamesModel;
use Respect\Validation\Validator as v;
use Intervention\Image\ImageManagerStatic as Image;

class GamesController extends Controller
{
	public function courtSearchGames() {
		


	}

	public function ProposeGame()
	{
		$post = [];
        $errors = []; 
      print_r($_POST);

        if(!empty($_POST)){

            $post = array_map('trim', array_map('strip_tags', $_POST));

            //verification de la date


         	if(!validateDate($post['date'],'d-m-Y'))
         	{
         		$errors[] = 'La date doit être au bon format';
         	}




            //vérification de l'heure de début

            

         	if(empty($post['starting_time']) || (!preg_match('#^[0-2][0-9]:[0-5][0-9]$#', $post['starting_time'])))
            {
                $errors[] = 'L\'heure de départ doit être renseignée ou correcte';
            }

            //vérification de l'heure de fin
            if(empty($post['finishing_time']) || (!preg_match('#^[0-2][0-9]:[0-5][0-9]$#', $post['finishing_time'])) || $post['starting_time'] > $post['finishing_time'])
            {
                $errors[] = 'L\'heure de fin doit être renseignée ou correcte';
            }

            //vérification du niveau
             if(empty($post['level']))
            {
                $errors[] = 'Le niveau de l\'équipe doit être choisi';
            }

            //vérification du nombre de joueurs
            if(!is_int($post['number_players']))
            {
                $errors[] = 'Le nombre de joueurs doit être un chiffre';
            }

            //vérification du message
            if(mb_strlen($post['message'])<2)
            {
                $errors[] = 'Le message doit comporter au moins 2 caractères';
            }

            if(count($errors) === 0){

            	$data=[
            		'court_id' 		=> $post['id'],
            		'date'			=> $post['date'],
            		'starting_time'	=> $post['starting_time'],
            		'finishing_time'=> $post['finishing_time'],
            		'number_players'=> $post['number_players'],
            		'team_name'		=> $post['team_name'],
            		'team_level'	=> $post['level'],
            		'message'		=> $post['message'],
            		'accepted'		=> 0,

            	];
                $gameModel = new GamesModel;
                $insert = $gameModel->insert($data);
                if($insert){
                    
                    $json = [
                    'result' => true,
                    'message'=> 'Match proposé!' ,
                    ];
                }
            }
            else{
                // définie les erreurs du formulaire
                

                $json = [
                'result' => false,
                'errors' => implode('<br>',$errors),
                ];
            }

            $this->showJson($json);



        }


	}

    public function acceptGame() { 
        

        $model = new Model();
        $gameAccepted = $model->update();
    }


}