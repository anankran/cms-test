<?php
/**
 * Posts Controller class
 * Versão 1.0
 * @author André Nankran <andrenankran@gmail.com.br>
 */

namespace Controller;

use Model\Posts;

class PostsController {

	public function newPost()
	{
		$headers = getallheaders();
		if($headers['X-Csrf-Token'] == $_SESSION['_token']):
			$records = Posts::newPost($_POST['title'], $_POST['text']);
			return json_encode($records);
		else:
			return json_encode(array('status' => 'error', 'msg' => 'Invalid CSRF Token.'));
		endif;
	}

	public function updatePost()
	{
		$headers = getallheaders();
		if($headers['X-Csrf-Token'] == $_SESSION['_token']):
			$records = Posts::updatePost($_POST['id'], $_POST['title'], $_POST['text']);
			return json_encode($records);
		else:
			return json_encode(array('status' => 'error', 'msg' => 'Invalid CSRF Token.'));
		endif;
	}

}
