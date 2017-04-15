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
        if ($this->loggued() === 2)
        {
            $e = $this->user->findpseudowithid($_SESSION['auth']);
            $pseudo = $e->pseudo;
            $this->render('admin.index', compact('pseudo'));
        }
        else if ($this->loggued() === 1) {
            $e = $this->user->findpseudowithid($_SESSION['auth']);
            $pseudo = $e->pseudo;
            $this->render('user.index', compact('pseudo'));
        }
        else {
            $this->render('home', compact('pseudo'));
        }
    }


}