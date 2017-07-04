<?php

namespace Model;


class TokensModel extends \W\Model\Model
{
	public function verifToken()
	{
		$verif = 'SELECT * FROM '.$this->table.' WHERE user_id = :id AND token = :token';
		$tok = $this->dbh->prepare($verif);
		$tok->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
		$tok->bindValue(':token', $_GET['token']);
		return $tok->execute();
	}
}
