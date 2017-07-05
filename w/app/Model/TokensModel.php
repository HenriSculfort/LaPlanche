<?php

namespace Model;


class TokensModel extends \W\Model\Model
{
    public function deleteToken($user_id)
	{
		$sql = 'DELETE FROM ' . $this->table . ' WHERE user_id = :user_id';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':user_id', $user_id);
		return $sth->execute();
	}
}
