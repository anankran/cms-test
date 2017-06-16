<?php
/**
 * Views controller
 * Versão 1.0
 * @author André Nankran <andrenankran@gmail.com.br>
 */

namespace Controller;

use Model\Posts;
use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;

class PageController {

	function __construct($page, $id = null)
	{

		$m = new Mustache_Engine(array(
		    'loader' => new Mustache_Loader_FilesystemLoader('view'),
				'helpers' => array(
					'_token' => $_SESSION['_token'],
					'fullpath' => FULL_URL,
					'assetspath' => ASSETS_URL
				)
		));

		if(file_exists('view/'.$page.'.mustache')):
			if(method_exists(__CLASS__,$page)):
				$records = $this->$page($id);
			else:
				$records = null;
			endif;
			print $m->render( $page, [ 'records' => $records ] );
		else:
			print $m->render( '404' );
		endif;

	}

	private function main()
	{
		$records = Posts::all();
		return $records;
	}

	private function post($id)
	{
		$records = Posts::getPost($id);
		return isset($records[0]) ? $records[0] : '' ;
	}

	private function view($id)
	{
		$record = Posts::getPost($id);
		$records = [];
		$records['title'] = $record[0]['title'];
		$records['text'] = nl2br($record[0]['text']);
		return $records;
	}

}
