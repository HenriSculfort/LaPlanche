<?php

namespace Model;

class CourtsModel extends \W\Model\Model
{
	
	/**
	* JOINTURE ENTRE LES TABLES COURTS & GAMES
	* @return array (INNER JOIN) 
	*/ 



	public function leftJoinCourtsGames ($date) {
		 

		   
		$sql = 'SELECT * FROM ' .$this->table. ' 
				WHERE id NOT IN ( SELECT CONCAT(court_id) AS id_terrains FROM games WHERE games.date = :date) 
				AND (city LIKE :recherchecity OR postal_code LIKE :recherchepostalcode)'; 

        $select = $this->dbh->prepare($sql);
        $select->bindValue(':recherchecity', strip_tags('%' . $_GET['searchWhere'] . '%'));
       	$select->bindValue(':recherchepostalcode', strip_tags('%' . $_GET['searchWhere'] . '%'));
        $select->bindValue(':date', $date);

       	
       	if($select->execute()){
            return $select->fetchAll(); // Retournera un tableau avec les données correspondantes trouvées
        }

	}

	
}
