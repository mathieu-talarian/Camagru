<?php
/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 04/03/2017
 * Time: 16:27
 */

namespace App\Controller;

use \App;
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
            $pseudo = $this->user->FindPseudoWithId($_SESSION['auth'])->pseudo;
            $photo = '<script type="text/javascript" src="js/photo.js"></script>';
            $form = new BootstrapForm($_POST);
            $this->render('user.index', compact('photo', 'pseudo', 'form'));
        }
        else
        {
            $this->forbidden();
        }
    }

    public static function Userlogout () {
        unset ($_SESSION['auth']);
        Header ('Location: index.php');
    }
}