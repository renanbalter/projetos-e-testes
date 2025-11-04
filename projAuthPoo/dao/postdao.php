<?php

require_once("models/post.php");
require_once("dao/userdao.php");
require_once("globals/url.php");
require_once("db.php");


$userDao = new UserDAO($conn, $BASE_URL);


class PostDAO implements PostDAOInterface {

    private $conn;
    private $url;

    public function __construct(PDO $conn, $url) {
        $this->conn = $conn;
        $this->url = $url;
    }

    public function newPost($data) {
        $post = new Post;

        $post->id = $data["id"];
        $post->title = $data["title"];
        $post->image = $data["image"];
        $post->content = $data["content"];
        $post->users_id = $data["users_id"];


        return $post;
    }

    public function create(Post $post) {
        $stmt = $this->conn->prepare("INSERT INTO posts(title, image, content, users_id) VALUES(:title, :image, :content, :users_id)");

        $stmt->bindParam(":title", $post->title);
        $stmt->bindParam(":image", $post->image);
        $stmt->bindParam(":content", $post->content);
        $stmt->bindParam(":users_id", $post->users_id);

        $stmt->execute();
        

    }

    public function update(Post $post) {
        $stmt = $this->conn->prepare("UPDATE posts SET title = :title, image = :image, content = :content, users_id = :users_id WHERE id = :id");

        $stmt->bindParam(":title", $post->title);
        $stmt->bindParam(":image", $post->image);
        $stmt->bindParam(":content", $post->content);
        $stmt->bindParam(":users_id", $post->users_id);
        $stmt->bindParam(":id", $post->id);

        $stmt->execute();

    }

    public function destroy($id) {
        $stmt = $this->conn->prepare("DELETE FROM posts WHERE id = :id");

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $_SESSION["message"] = "Post deletado com sucesso!";

        header("Location: dashboard.php");
        exit();

    }

    public function getLatestPosts() {

    }

    public function getPostByUserId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM posts WHERE users_id = :id"); 

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $data = $stmt->fetchAll();

        $posts = [];

        if($stmt->rowCount() > 0 ) {
            foreach($data as $postData) {
                $posts[] = $this->newPost($postData);
            }
        } else {
            return false;
        }

        return $posts;


    }

    public function findAllPosts() {
        $stmt = $this->conn->prepare("SELECT * FROM posts");

        $stmt->execute();

        $data = $stmt->fetchAll();

        $posts = [];

        if($stmt->rowCount() > 0) {

        foreach($data as $postData) {

        $posts[] = $this->newPost($postData);

        }

        return $posts;

        } else {
            return false;
        }
    }

    public function findById($id) {


        $stmt = $this->conn->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $data = $stmt->fetch();
        
        if($stmt->rowCount() > 0) {
        $post = $this->newPost($data);
        return $post;

        } else {
            return false;
        }
    }

    public function findByTitle($title) {
        $stmt = $this->conn->prepare("SELECT * FROM posts WHERE title LIKE :title");


        $stmt->bindValue(":title", '%'.$title.'%');

        $stmt->execute();

        $posts = [];

        if($stmt->rowCount() > 0) {
        
        $data = $stmt->fetchAll();

        foreach($data as $postData) {

        $posts[] = $this->newPost($postData);

        }

        return $posts;

        } else {
            return false;
        }
        


    }






}








?>