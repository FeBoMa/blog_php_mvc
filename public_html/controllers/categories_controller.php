<?php

class CategoriesController {

    public function indexCat() {
        // Guardamos todos los posts en una variable
        $categories = Category::all();
        require_once('views/category/indexCat.php');
    }

    public function showCat() {
        $category = Category::findCat();
        require_once('views/category/showCat.php');
    }

    public function insertCat() {
        require_once('views/category/formInsertCat.php');
    }

    public function formInsertCat() {
        $category = Category::insert();
        require_once('views/category/formInsertCat.php');
    }

    public function updateCat() {
        $category = Category::findCat();
        require_once('views/category/formUpdateCat.php');
    }

    public function formUpdateCat() {
        $category = Category::update();
        $categories = Category::all();
        require_once('views/category/indexCat.php');
    }

    public function deleteCat() {
        $category = Category::delete();
        $categories = Category::all();
        require_once('views/category/indexCat.php');
    }

}

?>