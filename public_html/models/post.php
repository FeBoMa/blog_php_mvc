<?php

class Post {

    // definimos tres atributos
    // los declaramos como públicos para acceder directamente $post->author
    //title, author, content, created, modified, image
    public $id;
    public $title;
    public $author;
    public $content;
    public $created;
    public $modified;
    public $image;
    public $category_id;

    public function __construct($id, $title, $author, $content, $created, $modified, $image, $category_id) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->content = $content;
        $this->created = $created;
        $this->modified = $modified;
        $this->image = $image;
        $this->category_id = $category_id;
    }

    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM posts');

        // creamos una lista de objectos post y recorremos la respuesta de la
        // consulta
        foreach ($req->fetchAll() as $post) {
            $list[] = new Post($post['id'], $post['title'], $post['author'], $post['content'], $post['created'], $post['modified'], $post['image'], $post['category_id']);
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
        return new Post($post['id'], $post['title'], $post['author'], $post['content'], $post['created'], $post['modified'], $post['image'], $post['category_id']);
    }

    public static function insert($title, $author, $content, $image, $catId) {
        //echo $title, $author, $content, $image;
        $db = Db::getInstance();
        // nos aseguramos que $id es un entero
        $req = $db->prepare('INSERT INTO posts (title, author, content, created, modified, image, category_id) VALUES (:title, :author, :content, :created, :modified, :image, :category_id)');

        // preparamos la sentencia y reemplazamos :id con el valor de $id
        $fecha = date('Y-m-d H:i:s');
        $req->bindParam(":title", $title);
        $req->bindParam(":author", $author);
        $req->bindParam(":content", $content);
        $req->bindParam(":created", $fecha);
        $req->bindParam(":modified", $fecha);
        $req->bindParam(":image", $image);
        $req->bindParam(":category_id", $catId);
        $req->execute();
        Post::uploadPhoto($image);
    }

    public static function update($id, $title, $author, $content, $image, $actuFoto, $catId) {
        $db = Db::getInstance();
        // nos aseguramos que $id es un entero
        $req = $db->prepare('UPDATE posts SET title = :title, author = :author, content = :content, modified = :modified, image = :image, category_id = :category_id WHERE id = :id');
        //UPDATE `posts` SET `content` = 'content' WHERE `posts`.`id` = 2;
        // preparamos la sentencia y reemplazamos :id con el valor de $id

        $fecha = date('Y-m-d H:i:s');
        $req->bindParam(":title", $title);
        $req->bindParam(":author", $author);
        $req->bindParam(":content", $content);
        $req->bindParam(":modified", $fecha);
        $req->bindParam(":image", $image);
        $req->bindParam(":category_id", $catId);
        $req->bindParam(":id", $id);
        $req->execute();
        if ($actuFoto) {
            Post::uploadPhoto($image);
        }
    }

    public static function delete($id) {
        $db = Db::getInstance();
        // nos aseguramos que $id es un entero
        $req = $db->prepare('DELETE FROM posts WHERE id = :id');

        // preparamos la sentencia y reemplazamos :id con el valor de $id
        $req->bindParam(":id", $id);
        $req->execute();
    }

    function uploadPhoto($imgFich) {
        $result_message = "";

        // now, if image is not empty, try to upload the image
        if ($imgFich) {

            // sha1_file() function is used to make a unique file name
            $target_directory = "uploads/";

            $target_file = $target_directory . $imgFich;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

            // error message is empty
            $file_upload_error_messages = "";
            // make sure that file is a real image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                // submitted file is an image
            } else {
                $file_upload_error_messages .= "<div>Submitted file is not an image.</div>";
            }

// make sure certain file types are allowed
            $allowed_file_types = array("jpg", "jpeg", "png", "gif");
            if (!in_array($file_type, $allowed_file_types)) {
                $file_upload_error_messages .= "<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
            }

// make sure file does not exist
            if (file_exists($target_file)) {
                $file_upload_error_messages .= "<div>Image already exists. Try to change file name.</div>";
            }

// make sure submitted file is not too large, can't be larger than 1 MB
            if ($_FILES['image']['size'] > (1024000)) {
                $file_upload_error_messages .= "<div>Image must be less than 1 MB in size.</div>";
            }

// make sure the 'uploads' folder exists
// if not, create it
            if (!is_dir($target_directory)) {
                mkdir($target_directory, 0777, true);
            }
            // if $file_upload_error_messages is still empty
            if (empty($file_upload_error_messages)) {
                // it means there are no errors, so try to upload the file
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    // it means photo was uploaded
                } else {
                    $result_message .= "<div class='alert alert-danger'>";
                    $result_message .= "<div>Unable to upload photo.</div>";
                    $result_message .= "<div>Update the record to upload photo.</div>";
                    $result_message .= "</div>";
                }
            }

// if $file_upload_error_messages is NOT empty
            else {
                // it means there are some errors, so show them to user
                $result_message .= "<div class='alert alert-danger'>";
                $result_message .= "{$file_upload_error_messages}";
                $result_message .= "<div>Update the record to upload photo.</div>";
                $result_message .= "</div>";
            }
        }

        return $result_message;
    }

    function readCat() {
        /*
          $list = [];
          $db = Db::getInstance();
          $req = $db->query('SELECT * FROM categories ORDER BY name');

          // creamos una lista de objectos post y recorremos la respuesta de la
          // consulta
          foreach ($req->fetchAll() as $cat) {
          $list[] = new Post($cat['id'], $cat['name'], $cat['created'], $cat['modified']);
          }
          return $list;
         */
        $db = Db::getInstance();
        //select all data
        $stmt = $db->query('SELECT * FROM categories ORDER BY name');
        $stmt->execute();
        return $stmt;
    }

}

?>