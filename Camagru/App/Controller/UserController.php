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
                if ($this->user->CheckRegistered($_POST['pseudo'])->registered) {
                    $auth = new DBAuth(App::getInstance()->getDB());
                    if ($auth->login($_POST['pseudo'], $_POST['passwd'])) {
                        header('Location: index.php?p=user.index');
                    } else {
                        $errors[] = 'Identifiants incorrects';
                    }
                } else {
                    $errors[] = 'Vous n\'avez pas confirme votre compte';
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
                $token = uniqid("camagru", true);
                $this->user->create(
                    [
                        'nom' => $_POST['nom'],
                        'prenom' => $_POST['prenom'],
                        'pseudo' => $_POST['pseudo'],
                        'mail' => $_POST['mail'],
                        'passwd' => hash('whirlpool', $_POST['passwd']),
                        'register_token' => $token
                    ]
                );
                $this->create_token($_POST['pseudo'], $_POST['mail'], $token);
                header('Location: index.php?p=user.register&reg=false');
            }

        }
        $form = new BootstrapForm($_POST);
        $this->render('user.inscription', compact('form', 'errors'));
    }

    public function tests_inscription($var) {
        $errors = [];
        if (!$this->keys_filled($var)) {
            $errors[] = 'Champs incomplets';
        }
        $pseudo = $this->user->pseudo($_POST['pseudo']);
        if (isset($pseudo->pseudo)) {
            $errors[] = 'Pseudo deja utilise';
        }
       $mail = $this->user->mail($_POST['mail']);
        if (isset($mail->mail)) {
            if ($mail->mail === 'mathieu.moullec@gmail.com')
            {}
            else {
                $errors[] = 'Mail deja utilise';
            }
        }
        if (!preg_match(self::$_regexp_mail, $var['mail']))
        {
            $errors[] = 'Mail non compatible';
        }
        if ($var['passwd'] !== $var['passwd-verif'])
        {
            $errors[] = 'Les deux mot de passe ne correspondent pas';
        }
        return $errors;
    }

    public function create_token($pseudo, $mail, $token) {
        mail($mail, "Confirmation de votre compte", "Pour valider votre compte, veuillez cliquer sur ce lien ou le copier dans votre navigateur\n\n\nhttp://e1r8p9.42.fr:8080/cam_gh/Camagru/index.php?p=user.register&ps={$pseudo}&tk={$token}");
    }

    public function logout () {
        unset ($_SESSION['auth']);
    }

    public function register(){
        $errors = null;
        if (isset($_GET['reg'])) {

        }
        else {
            $errors;
            $token = $this->user->SelectTokenByPseudo($_GET['ps']);
            if (!$token) {
                $errors = 'Mauvais mail de confirmation ou pseudo modifie';
            }
            else
            {
                if ($token->registered === null) {
                    if ($token->register_token === $_GET['tk']) {
                        $errors = 'Confirmation de la creation de votre compte';
                        $this->user->UpdadeRegistered($_GET['ps']);
                    }
                    else {
                        $errors = 'tu as modifie le token petit coquin';
                    }
                }
                else {
                    $errors = 'tu as deja confirme ton compte enfin';
                }

            }
        }
        $this->render('user.register', compact('errors'));
    }
}