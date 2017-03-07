<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 04/03/2017
 * Time: 16:02
 */
namespace App\Controller;

use Core\Debug\Debug;

class HomeController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('user');
    }

    public function index() {
        $pseudo = null;

        if ($this->loggued())
        {
            $e = $this->user->findpseudowithid($_SESSION['auth']);
            $pseudo = $e[0]->pseudo;
        }
        $this->render('home', compact('pseudo'));
    }

    public function restart_session() {
        \App::getInstance()->getDB()->delete_db();
        session_destroy();
        session_start();
        require ('index.php');
        }
}