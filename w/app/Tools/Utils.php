<?php

namespace Tools;


class Utils 
{

	public static function getTeamLevel($level_id)
	{
		switch($level_id) {

			case 1:
				$return = 'Débutant';
			break;

			case 2:
				$return = 'Novice';
			break;

			case 3:
				$return = 'Intermédiare';
			break;
		
			case 4:
				$return = 'Avancé';
			break;
			
			case 5:
				$return = 'Expert';
			break;

			default: 
				$return = 'Non renseigné';

		}

		return $return;
	}

	public static function getCourtState($court_state) 
	{

		switch($court_state) {
						case 'very_bad':
						echo 'Très mauvais état';
						break;
						case 'bad':
						echo 'Mauvais état';
						break;
						case 'medium':
						echo 'Etat Normal';
						break;
						case 'good':
						echo 'Bon état';
						break;
						case 'very_good':
						echo 'Très bon état';
						break;
					};


	}


}