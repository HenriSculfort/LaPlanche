<?php

namespace Model;


class MessageModel extends \W\Model\Model
{
	

	public function updateHomeMessage($message) { 
        $select = $this->dbh->prepare('UPDATE '.$this->table.' SET message = '. $message . '  WHERE id = 1' );

       if($select->execute()){
            return $select->fetchAll(); // Retournera un tableau avec les données 
		}
	}

}