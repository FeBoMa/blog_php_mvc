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
        if (!isset($_GET['id'])) {
            return call('pages', 'error');
        }
        // utilizamos el id para obtener el post correspondiente
        $post = Post::find($_GET['id']);
        require_once('views/posts/show.php');
    }

    public function insert() {
        $catlist = Post::readCat();
        require_once('views/posts/formInsert.php');
    }

    public function formInsert() {
        $title = $_POST["title"];
        $author = $_POST["author"];
        $content = $_POST["content"];
        $image = !empty($_FILES["image"]["name"]) ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
        $catId = $_POST["category_id"];

        if (!isset($title) && !isset($author) && !isset($content) && !isset($image) && !isset($catId)) {
            return call('pages', 'error');
        }
        $post = Post::insert($title, $author, $content, $image, $catId);
        $catlist = Post::readCat();
        require_once('views/posts/formInsert.php');
    }

    public function update() {
        if (!isset($_GET['id'])) {
            return call('pages', 'error');
        }
        // utilizamos el id para obtener el post correspondiente
        $post = Post::find($_GET['id']);
        $catlist = Post::readCat();
        require_once('views/posts/formUpdate.php');
    }

    public function formUpdate() {
        $id = $_POST["id"];
        $title = $_POST["title"];
        $author = $_POST["author"];
        $content = $_POST["content"];
        $image = !empty($_FILES["image"]["name"]) ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
        if (empty($image)) {
            $actuFoto = false;
            $image = $_POST["imageDefault"];
        } else if ($image != $_POST["imageDefault"]) {
            $actuFoto = true;
        }
        $catId = $_POST["category_id"];

        if (!isset($id) && !isset($title) && !isset($author) && !isset($content) && !isset($image) && !isset($catId)) {
            return call('pages', 'error');
        }
        $post = Post::update($id, $title, $author, $content, $image, $actuFoto, $catId);

        $posts = Post::all();
        require_once('views/posts/index.php');
    }

    public function delete() {
        if (!isset($_GET['id'])) {
            return call('pages', 'error');
        }
        // utilizamos el id para obtener el post correspondiente        
        $posts = Post::delete($_GET['id']);
        $posts = Post::all();
        require_once('views/posts/index.php');
    }

    public function readCat() {
        // esperamos una url del tipo ?controller=posts&action=show&id=x
        // si no nos pasan el id redirecionamos hacia la pagina de error, el id
        // tenemos que buscarlo en la BBDD
        // utilizamos el id para obtener el post correspondiente
        $post = Post::readCat();
        //require_once('views/posts/show.php');
    }

}

?>