<?php
/**
 * Session controller
 * Versão 1.0
 * @author André Nankran <andrenankran@gmail.com.br>
 */

namespace Controller;

use Model\Database;
use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;

class SessionController {

  public function verify()
  {
    if(isset($_SESSION['loggedIn'])):
      return true;
    else:
      return false;
    endif;
  }

  public function loginCheck()
  {
    $login = Database::loginCheck($_POST['user'], $_POST['password']);
    if($login == true):
      $_SESSION['loggedIn'] = $_POST['user'];
      $login = true;
    else:
      $login = false;
    endif;
    return $login;
  }

}
