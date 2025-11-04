<?php
require_once("dao/postdao.php");
require_once("dao/userdao.php");
require_once("globals/url.php");
require_once("models/comment.php");
require_once("db.php");

$userDao = new UserDAO($conn, $BASE_URL);

class CommentDAO implements CommentDAOInterface {
    private $conn;
    private $url;
    

    public function __construct($conn, $url) {
        $this->conn = $conn;
        $this->url = $url;
    }

    public function newComment($data) {
        $comment = new Comment;

        $comment->id = $data["id"];
        $comment->content = $data["content"];
        $comment->posts_id = $data["posts_id"];
        $comment->users_id = $data["users_id"];

        return $comment;

    }

    public function create($comment) {
        $stmt = $this->conn->prepare("INSERT INTO comments(content, users_id, posts_id) VALUES(:content, :users_id, :posts_id)");

        $stmt->bindParam(":content", $comment->content);
        $stmt->bindParam(":users_id", $comment->users_id);
        $stmt->bindParam(":posts_id", $comment->posts_id);

        $stmt->execute();
        
    }

    public function FindPostComments($posts_id) {
        $comments = [];

        $stmt = $this->conn->prepare("SELECT * FROM comments WHERE posts_id = :posts_id");
        $stmt->bindParam(":posts_id", $posts_id);
        $stmt->execute();

        $data = $stmt->fetchAll();

        if($stmt->rowCount() > 0) {

            foreach($data as $commentData) {

            $comments[] = $this->newComment($commentData);

            }

            
            return $comments;
        } else {
            return [];
        }

    }













}










?>