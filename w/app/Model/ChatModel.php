<?php

namespace Model;


class ChatModel extends \W\Model\Model
{
	
	/**
	* JOINTURE ENTRE LES TABLES CHAT & USERS
	* Pour retourner les courts sur lesquels il y a une game
	* @return array (INNER JOIN) 
	*/ 
	public function jointureChatUsers($idChat) { 
        $select = $this->dbh->prepare('SELECT c.*, u.username FROM '.$this->table.' AS c INNER JOIN users AS u ON c.user_id = u.id WHERE game_id = '. $idChat .' ORDER BY c.date_publi ASC' );

       if($select->execute()){
            return $select->fetchAll(); // Retournera un tableau avec les données 
		}
	}
}