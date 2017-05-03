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
        $this->loadModel('lk');
    }

    public function delete()
    {
        $errors = null;
        $id = $_POST['id'];
        $user_id = $_SESSION['auth'];
        $photo = $this->image->getDatabyPhoto($id);
        $photo_user_id = $photo->user_id;
        $photo_uniqid = $photo->contenu;
        if ($user_id === $photo_user_id) {
            $this->image->deletephoto($id);
            unlink($photo_uniqid);
            echo json_encode('Photo effacée');
        } else {
            echo json_encode('Vous ne pouvez pas effacer cette photo');
        }
    }

    public function nb_photo_like()
    {
        $p_id = $_POST['photo_id'];
        $rendu = $this->lk->likes_by_photo($p_id);
        if ($rendu) {
            echo $rendu;
        }
    }

    public function user_like_photo()
    {
        $p_id = $_POST['photo_id'];
        $u_id = $_SESSION['auth'];
        $rendu = $this->lk->if_user_like_photo($p_id, $u_id);
        if ($rendu)
            echo $rendu;
    }

    public function like()
    {
        $p_id = $_POST['photo_id'];
        $u_id = $_SESSION['auth'];
        $this->lk->new_like($p_id, $u_id);
    }

    public function dislike()
    {
        $p_id = $_POST['photo_id'];
        $u_id = $_SESSION['auth'];
        $this->lk->delete_like($p_id, $u_id);
    }
}