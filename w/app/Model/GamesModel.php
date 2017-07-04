<?php

namespace Model;


class GamesModel extends \W\Model\Model
{
	/**
	* JOINTURE ENTRE LES TABLES COURTS & GAMES
	* Pour retourner les courts sur lesquels il y a une game
	* @return array (INNER JOIN) 
	*/ 

	public function jointureCourtsGames($date) {
		
		$sql = 'SELECT DISTINCT court_location, description, name, parking, picture, address, postal_code, city FROM '.$this->table.' AS g INNER JOIN courts AS c ON g.court_location = c.id WHERE city LIKE :recherchecity OR postal_code LIKE :recherchepostalcode AND date LIKE :date ORDER BY g.date ASC';
		$select = $this->dbh->prepare($sql);
        $select->bindValue(':recherchecity', strip_tags('%' . $_GET['searchWhere'] . '%'));
        $select->bindValue(':recherchepostalcode', strip_tags('%' . $_GET['searchWhere'] . '%'));
        $select->bindValue(':date', $date);

       if($select->execute()){
            return $select->fetchAll(); // Retournera un tableau avec les données correspondantes trouvées
        }
	}	
}

