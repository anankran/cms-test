<?php
/**
 * Views controller
 * Versão 1.0
 * @author André Nankran <andrenankran@gmail.com.br>
 */

namespace Controller;

use Model\Main;
use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;

class PageController {

	/**
   	* Return view function and view file
   	* @param $page string View name
   	* @param $id integer Unique ID
  	*/
	function __construct($page,$id = null)
	{
		$m = new Mustache_Engine(array(
		    'loader' => new Mustache_Loader_FilesystemLoader('view'),
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

	/**
   	* Return values to view
   	* @uses Main
   	* @access private
   	* @return array
  	*/
	private function main()
	{
		$return = Main::all();
		return [ 'results' => $return ];
	}

}
