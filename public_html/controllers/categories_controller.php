<?php

class CategoriesController {

    public function indexCat() {
        // Guardamos todos los posts en una variable
        $categories = Category::all();
        require_once('views/category/indexCat.php');
    }

    public function showCat() {
        // esperamos una url del tipo ?controller=posts&action=show&id=x
        // si no nos pasan el id redirecionamos hacia la pagina de error, el id
        // tenemos que buscarlo en la BBDD
        if (!isset($_GET['id'])) {
            return call('pages', 'error');
        }
        // utilizamos el id para obtener el post correspondiente
        $category = Category::findCat($_GET['id']);
        require_once('views/category/showCat.php');
    }

    public function insertCat() {
        require_once('views/category/formInsertCat.php');
    }

    public function formInsertCat() {
        $name = $_POST["name"];
        if (!isset($name)) {
            return call('pages', 'error');
        }
        $category = Category::insert($name);

        require_once('views/category/formInsertCat.php');
    }

    public function updateCat() {
        if (!isset($_GET['id'])) {
            return call('pages', 'error');
        }
        // utilizamos el id para obtener el post correspondiente
        $category = Category::findCat($_GET['id']);
        require_once('views/category/formUpdateCat.php');
    }

    public function formUpdateCat() {
        $id = $_POST["id"];
        $name = $_POST["name"];

        if (!isset($id) && !isset($name)) {
            return call('pages', 'error');
        }
        $category = Category::update($id, $name);

        $categories = Category::all();
        require_once('views/category/indexCat.php');
    }

    public function deleteCat() {
        if (!isset($_GET['id'])) {
            return call('pages', 'error');
        }
        // utilizamos el id para obtener el post correspondiente     
        $category = Category::delete($_GET['id']);
        $categories = Category::all();
        require_once('views/category/indexCat.php');
    }

}

?>