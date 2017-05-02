<?php
/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 04/03/2017
 * Time: 16:27
 */

namespace App\Controller;

use \App;
use Core\Debug\Debug;
use Core\HTML\BootstrapForm;


class UserController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('user');
        $this->loadModel('image');
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

    public function header($variables = []) {
        ob_start();
        extract($variables);
        require($this->viewPath . 'user/header.php');
        return (ob_get_clean());
    }

    protected function render_only ($view, $variables) {
        ob_start();
        extract($variables);
        require($this->viewPath . str_replace('.', '/', $view) . '.php');
        $content = ob_get_clean();
        echo $content;
    }

        protected function render($view, $variables = []) {
        ob_start();
        extract($variables);
        require($this->viewPath . str_replace('.', '/', $view) . '.php');
        $content = ob_get_clean();
        $header = $this->header($variables);
        $footer = $this->footer($variables);
        require($this->viewPath . 'template/' . $this->template . '.php');
    }

    public function getphotos (){
        $t = null;
        $r = $this->image->all_date();
        $taille = count($r);
        if (isset($_GET['g']) && $_GET['g']) {
            $pt = (intval($_GET['g']) - 1) * 10;
            $to = $pt + 9;
        }
        else {
            $pt = 0;
            $to = 9;
        }
            for ($i = $pt; $i < $taille && $i <= $to; $i++) {
                $t[] = $r[$i];
            }
        if ($t === null) {
            echo "[]";
            return ;
        }
        else {
            echo (json_encode($t));
        }
    }


    public function allphotos() {
        echo $this->image->json_all_date();
    }

    public function gallery() {
        $images = $this->image->all();
        $form = new BootstrapForm($_POST);
        $this->render('user.gallery', compact('images', 'form'));
    }

    public function galleryperso() {
       echo $this->image->FindImageswithId($_SESSION['auth']);
    }

    public static function Userlogout () {
        unset ($_SESSION['auth']);
        Header ('Location: index.php');
    }

    /**
     *
     */
    public function check_set_post() {
        if (
            isset($_POST['mask']) && $_POST['mask']
        ) {
            return (1);
        }
        return (0);
    }


    public function dlphoto () {
        if (!$this->check_set_post()) {
            echo (json_encode('Des donnees manquent'));
            return ;
        }
        else {
            echo(json_encode(' '));
        }
        $mask = $this->gest_image($_POST['mask']);
        $image = $this->gest_image($_POST['img']);
        $id_uniq = uniqid();
        $filepath = $this->file_path($_SESSION['auth'], $id_uniq);
        $mask_fp = $this->file_path('m', 'm');
        imagecopy($image, $mask, 0, 0, 0, 0, 400, 300);
        imagepng($mask, $mask_fp);
        imagepng($image, $filepath);
        imagedestroy($image);
        imagedestroy($mask);
        $this->image->create(
            [
                'user_id' => $_SESSION['auth'],
                'contenu' => $filepath,
                'date' => date("Y-m-d H:i:s"),
            ]
        );
    }

    private function file_path($user_id, $id_uniq) {
        if (!file_exists(ROOT . '/Public/Photos')) {
            mkdir(ROOT. '/Public/Photos');
        }
        if (!file_exists(ROOT . '/Public/Photos/' . $user_id)) {
            mkdir(ROOT . '/Public/Photos/' . $user_id);
        }
        return ('Public/Photos/' . $user_id . '/' . $id_uniq . '.png');
    }

    private function gest_image($dt) {
        $infos = explode(',', $dt);
        $image = str_replace('data:image/png;base64,', '', $dt);
        $image = str_replace(' ', '+', $image);
        $image = base64_decode($image);
        return (imagecreatefromstring($image));
    }

    public function compte () {
        $form = new BootstrapForm($_POST);
        $this->render('user.compte', compact('form'));
    }
}