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


         	if(!checkdate($post['month'], $post['day'],$post['year'] ))
         	{
         		$errors[] = 'La date doit être au bon format';
         	}

            //vérification de l'heure de début
         	if(empty($post['starting_time']))
            {
                $errors[] = 'L\'heure de départ doit être renseignée';
            }

            //vérification de l'heure de fin
            if(empty($post['finishing_time']))
            {
                $errors[] = 'L\'heure de fin doit être renseignée';
            }

            //vérification du niveau
             if(empty($post['level']))
            {
                $errors[] = 'Le niveau de l\'équipe doit être choisi';
            }

            //vérification du nombre de joueurs
            if(is_int($post['number_players']))
            {
                $errors[] = 'Le nombre de joueurs doit être un chiffre';
            }

            //vérification du nom de l'équipe
            if(mb_strlen($post['team_name'])<2)
            {
                $errors[] = 'Le nom de l\'équipe doit comporter au moins 2 caractères';
            }

            //vérification du message
            if(mb_strlen($post['message'])<2)
            {
                $errors[] = 'Le message doit comporter au moins 2 caractères';
            }

            if(count($errors) === 0){

            	$data=[
            		'court_id' 		=> $post['id'],
            		'date'			=> ,
            		'starting_time'	=> $post['starting_time'],
            		'finishing_time'=> $post['finishing_time'],
            		'number_players'=> $post['number_players'],
            		'team_name'		=> $post['team_name'],
            		'team_level'	=> ,
            		'message'		=> $post['message'],
            		'accepted'		=> 0,

            	];



            }


	}



}