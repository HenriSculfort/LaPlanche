<?php

namespace Model;

class GamesModel extends \W\Model\Model
{
	/**
	* JOINTURE ENTRE LES TABLES COURTS & GAMES
	* @return array (INNER JOIN) 
	*/ 

	public function jointureCourtsGames() {
		// Le mot clé 'AS" permet de renommer (temporairement) la table. Pour accéder aux colonnes, il faudra donc utiliser l'alias et non le nom de la table. 
        $select = $this->dbh->prepare('SELECT * FROM '.$this->table.' AS g INNER JOIN courts AS c ON g.court_location = c.id ORDER BY g.date ASC' );

       if($select->execute()){
            return $select->fetchAll(); // Retournera un tableau avec les données correspondantes trouvées
        }
	}
}