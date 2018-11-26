<?php

class Post {

    // definimos tres atributos
    // los declaramos como públicos para acceder directamente $post->author
    public $id;
    public $author;
    public $content;

    public function __construct($id, $author, $content) {
        $this->id = $id;
        $this->author = $author;
        $this->content = $content;
    }

    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM posts');

        // creamos una lista de objectos post y recorremos la respuesta de la
        // consulta
        foreach ($req->fetchAll() as $post) {
            $list[] = new Post($post['id'], $post['author'], $post['content']);
        }
        return $list;
    }

    public static function find($id) {
        $db = Db::getInstance();
        // nos aseguramos que $id es un entero
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM posts WHERE id = :id');
        // preparamos la sentencia y reemplazamos :id con el valor de $id
        $req->execute(array('id' => $id));
        $post = $req->fetch();
        return new Post($post['id'], $post['author'], $post['content']);
    }

    public static function insert($title, $author, $content,$image) {
        $db = Db::getInstance();
        // nos aseguramos que $id es un entero
        $req = $db->prepare('INSERT INTO posts (title, author, content, created, modified, image) VALUES (:title, :author, :content, :created, :modified, :image)');

        // preparamos la sentencia y reemplazamos :id con el valor de $id
        $req->bindParam(":title", $title);
        $req->bindParam(":author", $author);
        $req->bindParam(":content", $content);
        $req->bindParam(":created", $created);
        $req->bindParam(":modified", $modified);
        $req->bindParam(":image", $image);
        $req->execute();
    }
    
    public static function update($id, $author, $content) {
        $db = Db::getInstance();
        // nos aseguramos que $id es un entero
        $req = $db->prepare('UPDATE posts SET author = :author, content = :content WHERE id = :id');

        // preparamos la sentencia y reemplazamos :id con el valor de $id
        
        $req->bindParam(":id", $id);
        $req->bindParam(":author", $author);
        $req->bindParam(":content", $content);       
        $req->execute();
    }
    
    
    
        public static function delete($id) {
        $db = Db::getInstance();
        // nos aseguramos que $id es un entero
        $req = $db->prepare('DELETE FROM posts WHERE id = :id');

        // preparamos la sentencia y reemplazamos :id con el valor de $id
        $req->bindParam(":id", $id);    
        $req->execute();
    }
    
    
}

?>