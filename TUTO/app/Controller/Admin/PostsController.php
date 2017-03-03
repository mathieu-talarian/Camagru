<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 02/03/2017
 * Time: 19:14
 */

namespace App\Controller\Admin;
use \App;
use Core\HTML\BootstrapForm;

class PostsController extends AppController {

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Post');
    }

    public function index() {
        $posts = $this->Post->all();
        $this->render('admin.posts.index', compact('posts'));
    }

    public function add() {
        $result = false;
        if (!empty($_POST)) {
            $result = $this->Post->create(
                [
                    'titre' => $_POST['titre'],
                    'contenu' => $_POST['contenu'],
                    'categorie_id' => $_POST['categorie_id']
                ]);
        }
        if ($result) {
            return ($this->index());
        }
        $this->loadModel('Category');
        $categorie = $this->Category->extract_list('id', 'titre');
        $form = new BootstrapForm($_POST);
        $this->render('admin.posts.edit', compact('categorie', 'form'));
    }

    public function edit() {
        $result = false;
        if (!empty($_POST)) {
            $result = $this->Post->update($_GET['id'],
                [
                    'titre' => $_POST['titre'],
                    'contenu' => $_POST['contenu'],
                    'categorie_id' => $_POST['categorie_id']
                ]);
        }
        if ($result) {
            return ($this->index());
        }
        $post = $this->Post->find($_GET['id']);
        $this->loadModel('Category');
        $categorie = $this->Category->extract_list('id', 'titre');
        $form = new BootstrapForm($post);
        $this->render('admin.posts.edit', compact('categorie', 'form'));
    }

    public function delete() {
        if (!empty($_POST)) {
            $result = $this->Post->delete($_POST['id']);
            return ($this->index());
        }
    }
}