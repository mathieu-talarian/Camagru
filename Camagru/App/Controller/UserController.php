<?php
/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 04/03/2017
 * Time: 16:27
 */

namespace App\Controller;

use \App;
use Core\Auth\DBAuth;
use Core\Debug\Debug;
use Core\HTML\BootstrapForm;

class UserController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('user');
    }

    public function index() {
        Debug::getInstance()->session;
        if ($this->loggued()) {
            $this->render('user.index', []);
        }
        else
        {
            $this->forbidden();
        }
    }

    public function login() {
       if ($this->loggued()) {
       header('Location: index.php?p=user.index');
        }
        else {
            $errors = false;
            if (!empty($_POST)) {
                $auth = new DBAuth(App::getInstance()->getDB());
                if ($auth->login($_POST['pseudo'], $_POST['passwd'])) {
                    header('Location: index.php?p=user.index');
                } else {
                    $errors = true;
                }
            }
            $form = new BootstrapForm($_POST);
            $this->render('user.login', compact('form', 'errors'));
        }
    }

    public function inscription() {
        $errors = false;
        if (!empty($_POST)) {
            $errors = $this->tests_inscription($_POST);
            if ($errors) {

            }
            else {
                $this->user->create(
                    [
                        'nom' => $_POST['nom'],
                        'prenom' => $_POST['prenom'],
                        'pseudo' => $_POST['pseudo'],
                        'mail' => $_POST['mail'],
                        'passwd' => hash('whirlpool', $_POST['passwd'])
                    ]
                );
            }

        }
        $form = new BootstrapForm($_POST);
        $this->render('user.inscription', compact('form', 'errors'));
    }

    public function tests_inscription($var) {
        if (!$this->keys_filled($var)) {
            return 1;
        }
        $pseudo = $this->user->pseudo();
        foreach ($pseudo as $k => $v) {
            if ($v->check_pseudo($var['pseudo'])) {
                return 2;
            }
        }
        if (!preg_match(self::$_regexp_mail, $var['mail']))
        {
            return 3;
        }
        if ($var['passwd'] !== $var['passwd-verif'])
        {
            return 4;
        }
        return 1;
    }

    public function logout () {
        unset ($_SESSION['auth']);
    }

}