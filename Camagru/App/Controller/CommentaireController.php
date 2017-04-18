<?php
/**
 * Created by PhpStorm.
 * User: mmoullec
 * Date: 4/18/17
 * Time: 3:17 PM
 */

namespace App\Controller;


use Core\Debug\Debug;
use Core\HTML\BootstrapForm;

class CommentaireController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('commentaire');
        $this->loadModel('image');
        $this->loadModel('user');
    }

    public function send_notif_mail($ps, $user) {
        mail($ps, "CAMAGRU", "CAMAGRU\n\n\n\nL'utilisateur " . $user . " vient de commenter une de vos photos");
    }

    public function header($variables = []) {
        ob_start();
        extract($variables);
        require($this->viewPath . 'user/header.php');
        return (ob_get_clean());
    }

    protected function render($view, $variables = []) {
        ob_start();
        extract($variables);
        require($this->viewPath . str_replace('.', '/', $view) . '.php');
        $content = ob_get_clean();
        $header = $this->header($variables);
        $footer = $this->footer($variables);
        require($this->viewPath . 'template/' . $this->template . '.php');
    }

    public function post_comm () {
        $errors = null;
        $images = $this->image->all();
        $form = new BootstrapForm($_POST);
        if (isset($_POST['comm']) && $_POST['comm'] && isset($_POST['photo_id']) && $_POST['photo_id']) {
            $comm = nl2br($this->protectform($_POST['comm']));
            $photo_id = $_POST['photo_id'];
            $user_id = $_SESSION['auth'];
            $this->commentaire->create(
                    [
                        'contenu' => $comm,
                        'photo_id' => $this->protectform($photo_id),
                        'user_id' => $user_id,
                        'date' => date("Y-m-d H:i:s"),
                    ]
            );
            $mail = $this->image->get_mail($photo_id)->mail;
            $user = $this->user->FindPseudoWithId($user_id)->pseudo;
            $this->send_notif_mail($mail, $user);
            $errors[] = "Le commentaire a bien ete pris en compte";
        }

        else  {
            $errors[] = 'Un champ est vide';
        }
        return ($this->render('commentaire.post_comment', compact('errors')));
    }

    public function getcomm() {
        return ($this->commentaire->commentaire_by_photo($_POST['id']));
    }
}