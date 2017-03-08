<?php
/**
 * Created by PhpStorm.
 * User: mmoullec
 * Date: 3/8/17
 * Time: 3:43 PM
 */

namespace App\Controller;


class AdminController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        if (isset($_SESSION['admin']) && $_SESSION['auth'])
            return $this->render('admin.index', []);
        return $this->forbidden();
    }

    public static function Adminlogout() {
        unset ($_SESSION['auth']);
        unset ($_SESSION['admin']);
        header('Location: index.php');
    }
}