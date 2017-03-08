<?php
/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 04/03/2017
 * Time: 16:27
 */

namespace App\Controller;

use \App;


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

    public static function Userlogout () {
        unset ($_SESSION['auth']);
        Header ('Location: index.php');
    }
}