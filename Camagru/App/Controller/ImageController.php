<?php
/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 19/04/2017
 * Time: 16:38
 */

namespace App\Controller;


use Core\Debug\Debug;

class ImageController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('user');
        $this->loadModel('image');
    }

    public function delete() {
        Debug::getInstance()->post;
        Debug::getInstance()->get;
    }
}