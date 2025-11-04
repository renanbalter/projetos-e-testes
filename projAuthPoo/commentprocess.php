<?php
require_once("db.php");
require_once("dao/commentdao.php");
require_once("dao/userdao.php");
require_once("dao/postdao.php");



$commentdao = new CommentDAO($conn, $BASE_URL);

$type = filter_input(INPUT_POST, "type");

if($type === "create") {
    $content = filter_input(INPUT_POST, "content");
    $users_id = filter_input(INPUT_POST, "users_id");
    $posts_id = filter_input(INPUT_POST, "posts_id");

    if($content && $posts_id && $users_id) {
        $comment = new Comment;

        $comment->content = $content;
        $comment->users_id = $users_id;
        $comment->posts_id = $posts_id;

        $commentdao->create($comment);

        header("Location: viewpost.php?id=$posts_id");
        exit();

    } else {
        $_SESSION["message"] = "Erro ao enviar comentário.";
    }
} 