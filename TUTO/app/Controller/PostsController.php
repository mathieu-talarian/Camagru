<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 02/03/2017
 * Time: 18:13
 */

namespace App\Controller;

use Core\Controller\Controller;
use App;
use Core\Debug\Debug;

class PostsController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Post');
        $this->loadModel('Category');
    }

    public function index() {
        $posts = $this->Post->last();
        $categories = $this->Category->all();
        $this->render('posts.index', compact('posts', 'categories'));
    }

    public function category() {
        $categorie = $this->Category->find($_GET['id']);
        if ($categorie === false) {
            $this->notFound();
        }
        $articles = $this->Post->LastbyCategory($_GET['id']);
        $categories = $this->Category->all();
        $this->render('posts.category', compact('articles', 'categorie', 'categorie'));
    }

    public function single() {
        $article = $this->Post->FindWithCategory($_GET['id']);
        $this->render('posts.single', compact('article'));

    }
}