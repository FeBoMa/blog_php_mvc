<?php

class Category {

    // definimos tres atributos
    // los declaramos como públicos para acceder directamente $post->author
    //title, author, content, created, modified, image
    public $id;
    public $name;
    public $created;
    public $modified;

    public function __construct($id, $name, $created, $modified) {
        $this->id = $id;
        $this->name = $name;
        $this->created = $created;
        $this->modified = $modified;
    }

    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM categories');

        // creamos una lista de objectos post y recorremos la respuesta de la
        // consulta
        foreach ($req->fetchAll() as $category) {
            $list[] = new Category($category['id'], $category['name'], $category['created'], $category['modified']);
        }
        return $list;
    }

    public static function findCat() {
        if (!isset($_GET['id'])) {
            return call('pages', 'error');
        }
        $id = $_GET['id'];
        $db = Db::getInstance();
        // nos aseguramos que $id es un entero
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM categories WHERE id = :id');
        // preparamos la sentencia y reemplazamos :id con el valor de $id
        $req->execute(array('id' => $id));
        $category = $req->fetch();
        return new Category($category['id'], $category['name'], $category['created'], $category['modified']);
    }

    public static function insert() {

        if (!isset($_POST["name"])) {
            return call('pages', 'error');
        }
        $name = $_POST["name"];
        //echo $title, $author, $content, $image;
        $db = Db::getInstance();
        // nos aseguramos que $id es un entero
        $req = $db->prepare('INSERT INTO categories (name, created, modified) VALUES (:name, :created, :modified)');

        // preparamos la sentencia y reemplazamos :id con el valor de $id
        $fecha = date('Y-m-d H:i:s');
        $req->bindParam(":name", $name);
        $req->bindParam(":created", $fecha);
        $req->bindParam(":modified", $fecha);
        $req->execute();
    }

    public static function update() {
        if (!isset($_POST["id"]) && !isset($_POST["name"])) {
            return call('pages', 'error');
        }
        $id = $_POST["id"];
        $name = $_POST["name"];
        $db = Db::getInstance();
        // nos aseguramos que $id es un entero
        $req = $db->prepare('UPDATE categories SET name = :name, modified = :modified WHERE id = :id');
        //UPDATE `posts` SET `content` = 'content' WHERE `posts`.`id` = 2;
        // preparamos la sentencia y reemplazamos :id con el valor de $id

        $fecha = date('Y-m-d H:i:s');
        $req->bindParam(":name", $name);
        $req->bindParam(":modified", $fecha);
        $req->bindParam(":id", $id);
        $req->execute();
    }

    public static function delete() {
        if (!isset($_GET['id'])) {
            return call('pages', 'error');
        }
        $id = $_GET['id'];
        $db = Db::getInstance();
        // nos aseguramos que $id es un entero
        $req = $db->prepare('DELETE FROM categories WHERE id = :id');

        // preparamos la sentencia y reemplazamos :id con el valor de $id
        $req->bindParam(":id", $id);
        $req->execute();
    }

    function readCat() {
        $db = Db::getInstance();
        $stmt = $db->query('SELECT * FROM categories ORDER BY name');
        $stmt->execute();
        return $stmt;
    }

    function readNameCatId($idCat) {
        $db = Db::getInstance();
        $id = intval($idCat);
        $req = $db->prepare('SELECT name FROM categories WHERE id = :id');
        $req->execute(array('id' => $id));
        $catName = $req->fetch();
        return $catName['name'];
    }
}

?>