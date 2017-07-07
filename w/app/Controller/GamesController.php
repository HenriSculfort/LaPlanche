<?php
namespace Controller;

use \W\Controller\Controller;
use Model\CourtsModel;
use Model\GamesModel;
use Respect\Validation\Validator as v;
use Intervention\Image\ImageManagerStatic as Image;

class GamesController extends Controller
{
	public function proposeGame()
	{
		$post = [];
        $errors = []; 
    //  print_r($_POST);

        if(!empty($_POST)){

            $post = array_map('trim', array_map('strip_tags', $_POST));

            //verification de la date


         	//if(!validateDate($post['date'],'d-m-Y'))
             //	{
             //		$errors[] = 'La date doit être au bon format';
            //	}
            if(!empty($post['date'])) { 
                if(!v::date('Y-m-d')->validate($post['date'])){ 
                    $errors[] = 'Le format de la date est incorrect';
                }
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
            if(!is_numeric($post['number_players']))
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
                    'user_id'       => $_SESSION['id'],
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
        
        $game_id = (int) $_POST['game_id'];
        $id = (int) $_POST['court_id'];
        $data = [
            'accepted' => 1,
        ];
        $model = new GamesModel();
        $gameAccepted = $model->update($data, $game_id);

        $this->redirectToRoute('court_details', ['id' =>$id]);
    }

    public function cancelGame() { 
        
        $game_id = (int) $_POST['game_id'];
        $id = (int) $_POST['court_id'];
        $data = [
            'accepted' => 0,
        ];
        $model = new GamesModel();
        $gameAccepted = $model->update($data, $game_id);

        $this->redirectToRoute('court_details', ['id' =>$id]);
    }

    public function deleteGame() { 
            
            $game_id = (int) $_POST['game_id'];
            $id = (int) $_POST['court_id'];
            
            $model = new GamesModel();
            $gameAccepted = $model->delete($game_id);

            $this->redirectToRoute('court_details', ['id' =>$id]);
    }

}