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
        $errors = null;
        $id = $_POST['id'];
        $user_id = $_SESSION['auth'];
        $photo_user_id = $this->image->getUserIdByPhoto($id)->user_id;
        Debug::getInstance()->vd($user_id);
        Debug::getInstance()->vd($photo_user_id);
        if ($user_id === $photo_user_id) {
            $this->image->deletephoto($id);
            $errors = "photo deleted";
        }
        else {
            $errors[] =  "You can't delete this photo";
        }
    }
}