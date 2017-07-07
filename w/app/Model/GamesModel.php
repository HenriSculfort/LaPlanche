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
		
		$sql = 'SELECT DISTINCT court_id, description, name, parking, picture, address, postal_code, city, court_state, net FROM '.$this->table.' AS g INNER JOIN courts AS c ON g.court_id = c.id WHERE city LIKE :recherchecity OR postal_code LIKE :recherchepostalcode AND date LIKE :date ORDER BY g.date ASC';
		$select = $this->dbh->prepare($sql);
        $select->bindValue(':recherchecity', strip_tags('%' . $_GET['searchWhere'] . '%'));
        $select->bindValue(':recherchepostalcode', strip_tags('%' . $_GET['searchWhere'] . '%'));
        $select->bindValue(':date', $date);

       if($select->execute()){
            return $select->fetchAll(); // Retournera un tableau avec les données correspondantes trouvées
        }
	}

	/**
	* JOINTURE ENTRE LES TABLES COURTS & GAMES
	* Pour retourner les games du terrain dont l'id est passé en paramètre
	* @return array
	*/ 

	public function showGamesOnThisCourt($court_id) 	{ 

		$sql = 'SELECT * FROM '. $this->table . ' WHERE court_id = '. $court_id;
		$select = $this->dbh->prepare($sql);
		if($select->execute()) { 
			return $select->fetchAll();
		}
	}
}

