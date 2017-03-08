<?php
/**
 * Created by PhpStorm.
 * User: mmoullec
 * Date: 3/8/17
 * Time: 6:12 PM
 */

namespace App\Controller;


use Core\Debug\Debug;
use Core\Auth\DBAuth;
use Core\HTML\BootstrapForm;

class RegisterController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('user');
    }

    public function login() {
        if ($this->loggued()) {
            header('Location: index.php?p=user.index');
        }
        else {
            $errors = false;
            if (!empty($_POST)) {
                if ($this->user->CheckAdmin($_POST)) {
                    $_SESSION['auth'] = true;
                    $_SESSION['admin'] = true;
                    return (header('Location: index.php?p=admin.index'));
                }
                if ($this->user->CheckRegistered($_POST['pseudo'])->registered) {
                    $auth = new DBAuth(\App::getInstance()->getDB());
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
            $this->render('register.login', compact('form', 'errors'));
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
                header('Location: index.php?p=register.register&reg=false');
            }
        }
        $form = new BootstrapForm($_POST);
        $this->render('register.inscription', compact('form', 'errors'));
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
        mail($mail, "Confirmation de votre compte", "Pour valider votre compte, veuillez cliquer sur ce lien ou le copier dans votre navigateur
        \n
        \n
        \n
        http://localhost:8080/cam_gh/Camagru/index.php?p=register.register&ps={$pseudo}&tk={$token}");
    }

    public function logout()
    {
        if (isset($_SESSION['auth'])) {
            if (isset($_SESSION['admin'])) {
                return AdminController::Adminlogout();
            }
            return UserController::Userlogout();
        }
        return self::forbidden();
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
        $this->render('register.register', compact('errors'));
    }
}