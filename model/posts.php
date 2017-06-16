<?php
/**
 * Model class
 * Versão 1.0
 * @author André Nankran <andrenankran@gmail.com.br>
 */

namespace Model;

class Posts extends Database {

	public static function all()
	{
		$sql = 'SELECT * FROM posts ORDER BY id DESC';
    $records = Database::select($sql);
    return $records;
	}

	public static function newPost($title, $text)
	{
		Database::setTitle($title);
    Database::setText($text);
		$sql = 'INSERT INTO posts (title, text) VALUES (:title, :text)';
   	$records = Database::insert($sql);
    return $records;
	}

	public static function updatePost($id, $title, $text)
	{
		Database::setTitle($title);
    Database::setText($text);
    Database::setID($id);
		$sql = 'UPDATE posts SET title = :title, text = :text WHERE id = :id';
   	$records = Database::update($sql);
    return $records;
	}

	public static function getPost($id)
	{
		if(!is_null($id)):
			Database::setFilters(array($id));
			$sql = 'SELECT * FROM posts WHERE id = ?';
	    $records = Database::select($sql);
			return $records;
		else:
			return array('status' => 'error', 'msg' => 'Invalid argument.');
		endif;
	}

}
