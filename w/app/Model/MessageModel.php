<?php

namespace Model;


class MessageModel extends \W\Model\Model
{
	public function selectHomeMessage() { 
		$select = $this->dbh->prepare('SELECT message, status FROM '.$this->table.' WHERE id = 1' );
		$select->execute();
		return $message = $select->fetch();

	}

	public function updateHomeMessage($message, $status) { 
        $update = $this->dbh->prepare('UPDATE '.$this->table.' SET message = :message, status = :status WHERE id = 1');
        $update->bindValue(':message', $message);
        $update->bindValue(':status', $status);
        return $update->execute();
        	
    }

    public function updateBackground($message, $status) { 
        $update = $this->dbh->prepare('UPDATE '.$this->table.' SET message = :message, status = :status WHERE id = 2');
        $update->bindValue(':message', $message);
        $update->bindValue(':status', $status);
        return $update->execute();
        	
    }


     public function showBackground() { 
        $showBg = $this->dbh->prepare('SELECT message FROM '.$this->table.' WHERE id = 2');
         $showBg->execute();
        return $picture = $showBg->fetch();
        
          
    }
}