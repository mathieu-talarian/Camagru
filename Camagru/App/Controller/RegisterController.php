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
                $t = $this->user->CheckRegistered($_POST['pseudo']);
//                Debug::getInstance()->vd($t);
                if ($t && $t->registered !== null) {
                    $usr = $this->user->all_pseudo($this->protectform($_POST['pseudo']));
                    if ($usr->passwd === $this->protect_hash($_POST['passwd'])) {
                        $_SESSION['auth'] = $usr->id;
                        header('Location: index.php?p=user.index');
                    } else {
                        $errors[] = 'Identifiants incorrects';
                    }
                } else {
                    $errors[] = 'Vous n\'etes pas inscit ou vous n\'avez pas confirme votre compte';
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
                        'nom' => $this->protectform($_POST['nom']),
                        'prenom' => $this->protectform($_POST['prenom']),
                        'pseudo' => $this->protectform($_POST['pseudo']),
                        'mail' => $this->protectform($_POST['mail']),
                        'passwd' => $this->protect_hash($_POST['passwd']),
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

    public function majpseudo() {
        $errors =null;
        $form = new BootstrapForm($_POST);
        if (isset($_POST['newpseudo']) && $_POST['newpseudo']) {
            $this->user->Updatepseudo($this->protectform($_POST['newpseudo']), $_SESSION['auth']);
        }
        else {
            $errors[] = "Champ vide";
            $errors[] = "La mise a jour du pseudo a echoue";
        }
        return $this->render('user.compte', compact('errors', 'form'));
    }


    public function majname() {
        $errors = null;
        $form = new BootstrapForm($_POST);
        if (isset($_POST['newnom']) && $_POST['newnom'] && isset($_POST['newprenom']) && $_POST['newprenom']) {
            $this->user->Updatename($this->protectform($_POST['newnom']), $this->protectform($_POST['newprenom']), $_SESSION['auth']);
        }
        else {
            $errors[] = "Des champs sont vides";
            $errors[] = "La mise a jour a echoue";
        }
        return $this->render('user.compte', compact('errors', 'form'));
    }

    public function majmdp() {
        $errors = null;
        $form = new BootstrapForm($_POST);
        if (isset($_POST)) {
            if (isset($_POST['ancienmdp']) && isset($_POST['nouveaumdp']) && isset($_POST['conf']) && $_POST['ancienmdp'] && $_POST['nouveaumdp'] && $_POST['conf']) {
                if ($_POST['nouveaumdp'] === $_POST['conf']) {
                    $mdp = hash('whirlpool', $this->protectform($_POST['ancienmdp']));
                    $ex = $this->user->FindPswdWithId($_SESSION['auth']);
                    $ex = $ex->passwd;
                    if ($ex === $mdp) {
                        $this->user->MajPswd($_SESSION['auth'], $this->protect_hash($_POST['nouveaumdp']));
                        $errors[] = "Mise a jour du mot de passe Reussie";
                        return $this->render('user.compte', compact('errors', 'form'));
                    }
                    else {
                        $errors[] = "l'ancien mot de passe et le nouveau ne correspondent pas";
                    }
                }
                else {
                    $errors[] = "le nouveau mdp et la confirmation ne correspondent pas";
                }
            }
            else {
                $errors[] = "Des champs sont vides";
            }
        }
        $errors[] = "La mise a jour du mot de passe a echoue";
        return $this->render('user.compte', compact('errors', 'form'));
    }
}