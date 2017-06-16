<?php
/**
 * General configs
*/

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

define('FULL_URL','https://cms-mvc.herokuapp.com/');
define('ASSETS_URL','https://cms-mvc.herokuapp.com/public/assets/');

// For NGINX
if (!function_exists('getallheaders')):
  function getallheaders() {
      $headers = [];
      foreach ($_SERVER as $name => $value) {
          if (substr($name, 0, 5) == 'HTTP_') {
              $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
          }
      }
      return $headers;
  }
endif;
