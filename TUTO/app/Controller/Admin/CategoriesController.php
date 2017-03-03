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

class CategoriesController extends AppController {

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Category');
    }

    public function index() {
        $items = $this->Category->all();
        $this->render('admin.categories.index', compact('items'));
    }

    public function add() {
        $result = false;
        if (!empty($_POST)) {
            $result = $this->Category->create(
                [
                    'titre' => $_POST['titre'],
                ]);
        }
        if ($result) {
            return ($this->index());
        }
        $form = new BootstrapForm();
        $this->render('admin.categories.edit', compact('form'));
    }


    public function edit() {
        $result = false;
        if (!empty($_POST)) {
            $result = $this->Category->update($_GET['id'],
                [
                    'titre' => $_POST['titre'],
                ]);
        }
        if ($result) {
            return ($this->index());
        }
        $categorie = $this->Category->find($_GET['id']);
        $form = new BootstrapForm($categorie);
        $this->render('admin.categories.edit', compact('categorie', 'form'));
    }

    public function delete() {
        if (!empty($_POST)) {
            $result = $this->Category->delete($_POST['id']);
            return ($this->index());
        }
    }
}