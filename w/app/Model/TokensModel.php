<?php

namespace Model;


class TokensModel extends \W\Model\Model
{
	public function verifToken()
	{
		$verif = 'SELECT * FROM '.$this->table.' WHERE user_id = :id AND token = :token';
		$tok = $this->dbh->prepare($verif);
		$tok->bindValue(':id', $_GET['user_id'], PDO::PARAM_INT);
		$tok->bindValue(':token', $_GET['token']);
		return $tok->execute();
	}
    
    public function deleteToken($token)
	{

		$sql = 'DELETE FROM ' . $this->table . ' WHERE token = :token';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':token', $token);
		return $sth->execute();
	}
}
