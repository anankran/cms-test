<?php
/**
 * Database class
 * Versão 1.0
 * @author André Nankran <andrenankran@gmail.com.br>
 */

namespace Model;

use PDO;

class Database {

	private static $filters,
								 $id,
								 $title,
								 $text;

 	protected static function getFilters()
	{
		return self::$filters;
  }

  protected static function setFilters($filters)
	{
  	self::$filters = $filters;
	}

	protected static function getID()
	{
		return self::$id;
  }

  protected static function setID($id)
	{
  	self::$id = $id;
	}

	protected static function getTitle()
	{
		return self::$title;
  }

  protected static function setTitle($title)
	{
  	self::$title = $title;
	}

	protected static function getText()
	{
		return self::$text;
  }

  protected static function setText($text)
	{
  	self::$text = $text;
	}

	protected static function conn()
	{
		$host = 'justd.mysql.uhserver.com';
		$db = 'justd';
		$username = 'nankran';
		$password = 'xs3e1zt0xexj{';
		$pdo = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', $username, $password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $pdo;
	}

	protected static function select($sql)
	{
		$filter = self::$filters;
		$conn = self::conn();
		$query = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$query->execute($filter);
		$result = $query->fetchAll();
		return $result;
	}

	protected static function insert($sql)
	{
		$title = self::$title;
		$text = self::$text;
		$conn = self::conn();
		$query = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$query->bindParam(':title', $title, PDO::PARAM_STR);
		$query->bindParam(':text', $text, PDO::PARAM_STR);
		$result = $query->execute();
		return $result;
	}

	protected static function update($sql)
	{
		$title = self::$title;
		$text = self::$text;
		$id = self::$id;
		$conn = self::conn();
		$query = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$query->bindParam(':title', $title, PDO::PARAM_STR);
		$query->bindParam(':text', $text, PDO::PARAM_STR);
		$query->bindParam(':id', $id, PDO::PARAM_INT);
		$result = $query->execute();
		return $result;
	}

	public static function loginCheck($user, $password)
	{
		$sql = 'SELECT password FROM users WHERE user = ?';
		$filter = array($user);
		$conn = self::conn();
		$query = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$query->execute($filter);
		$result = $query->fetchAll();
		if(count($result) > 0):
			return $result[0]['password'] == strtoupper(sha1($password)) ? true : false ;
		else:
			return false;
		endif;
	}

}
