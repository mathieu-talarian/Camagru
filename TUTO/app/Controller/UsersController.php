<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 02/03/2017
 * Time: 23:27
 */

namespace App\Controller;

use \App;
use Core\HTML\BootstrapForm;
use Core\Auth\DBAuth;

class UsersController extends AppController
{
    public function login() {
        $errors = false;
        if (!empty($_POST)) {
            $auth = new DBAuth(App::getInstance()->getDB());
            if ($auth->login($_POST['username'], $_POST['password']))
                header('Location: index.php?p=admin.posts.index');
            else {
                $errors = true;
            }
        }
        $form = new BootstrapForm($_POST);
        $this->render('users.login', compact('form', 'errors'));
    }
}