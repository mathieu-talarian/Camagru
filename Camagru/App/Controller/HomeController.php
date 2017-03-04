<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 04/03/2017
 * Time: 16:02
 */
namespace App\Controller;

class HomeController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $this->render('index', []);
    }

}