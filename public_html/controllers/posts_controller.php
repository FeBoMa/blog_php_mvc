<?php

class PostsController {

    public function index() {
        // Guardamos todos los posts en una variable
        $posts = Post::all();
        require_once('views/posts/index.php');
    }

    public function show() {
        // esperamos una url del tipo ?controller=posts&action=show&id=x
        // si no nos pasan el id redirecionamos hacia la pagina de error, el id
        // tenemos que buscarlo en la BBDD

        // utilizamos el id para obtener el post correspondiente
        $post = Post::find();
        $catName = Category::readNameCatId($post->category_id);
        require_once('views/posts/show.php');
    }

    public function insert() {
        $catlist = Category::readCat();
        require_once('views/posts/formInsert.php');
    }

    public function formInsert() {
        $post = Post::insert();
        $catlist = Category::readCat();
        require_once('views/posts/formInsert.php');
    }

    public function update() {
        // utilizamos el id para obtener el post correspondiente
        $post = Post::find();
        $catlist = Category::readCat();
        require_once('views/posts/formUpdate.php');
    }

    public function formUpdate() {
        $post = Post::update();
        $posts = Post::all();
        require_once('views/posts/index.php');
    }

    public function delete() {
        // utilizamos el id para obtener el post correspondiente        
        $posts = Post::delete();
        $posts = Post::all();
        require_once('views/posts/index.php');
    }

}

?>