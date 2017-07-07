<?php

namespace Model;

class CourtsModel extends \W\Model\Model
{

    /**
	* JOINTURE ENTRE LES TABLES COURTS & GAMES
	* @return array (INNER JOIN) 
	*/ 



    public function leftJoinCourtsGames ($date) 
    { 

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


    public function findLatLng($postal_code)
    {
        // Requete SQL pour recupérér les coordonnées des terrains en fonction du code postale récupéré au dessus
        $sql = 'SELECT * FROM '.$this->table.' WHERE LEFT(postal_code,2) = LEFT(:postal_code, 2)';
        $result = $this->dbh->prepare($sql);
        //debug($result); die();
        //var_dump($result); die();
        $result->bindValue(':postal_code', $postal_code);
        if($result->execute())
        {
            $donnee = $result->fetchAll();
            return $donnee;
        }
    }


}
