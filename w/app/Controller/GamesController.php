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
      

        if(!empty($_POST)){

            $post = array_map('trim', array_map('strip_tags', $_POST));

            //verification de la date
         	if(!checkdate($post['month'], $post['day'],$post['year'] ))
         	{
         		$errors[] = 'La date doit être au bon format';
         	}

            //vérification de l'heure de début


            //vérification de l'heure de fin


            //vérification du niveau
             if(empty($post['level']))
            {
                $errors[] = 'Le niveau de l\'équipe doit être choisi';
            }

            //vérification du nombre de joueurs
            if(is_int($post['number_players'])<2)
            {
                $errors[] = 'Le nombre de joueurs doit comporter au moins 2 caractères';
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



            }


	}



}