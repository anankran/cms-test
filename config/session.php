<?php
use Controller\SessionController as SessionController;

$session = new SessionController();
$message = '';

if(isset($url[0]) && $url[0] == 'logout'):
  unset($_SESSION['loggedIn']);
endif;

if($session->verify() === false && !$_POST && (!isset($url[0]) && $url[0] != 'login')):
  header('Location: '.FULL_URL.'login');
elseif($session->verify() === false && $_POST):
  if($session->loginCheck() == true):
    header('Location: '.FULL_URL.'main');
  else:
    header('Location: '.FULL_URL.'login');
  endif;
endif;
