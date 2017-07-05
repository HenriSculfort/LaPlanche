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

}