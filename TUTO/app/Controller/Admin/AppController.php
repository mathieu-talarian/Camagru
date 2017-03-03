<?php
/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 02/03/2017
 * Time: 19:15
 */

namespace App\Controller\Admin;
use \App;
use Core\Auth\DBAuth;


class AppController extends \App\Controller\AppController {

    public function __construct()
    {
        parent::__construct();
        $app = App::getInstance();
        $auth = new DBAuth($app->getDB());
        ($app->getDB());
        if (!$auth->logged()) {
            $this->forbidden();
        }
    }

    public function index() {
        $this->render('admin.index');
    }
}