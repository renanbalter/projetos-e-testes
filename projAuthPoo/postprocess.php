<?php

require_once("models/post.php");
require_once("dao/postdao.php");
require_once("globals/url.php");
require_once("dao/userdao.php");

$type = filter_input(INPUT_POST, "type");

$userDao = new UserDAO($conn, $BASE_URL);
$postDao = new PostDAO($conn, $BASE_URL);

$userData = $userDao->verifyToken();

$title = filter_input(INPUT_POST, "title");
$content = filter_input(INPUT_POST, "content");

$post = new Post;
if($type === "create") {
    if(!empty($title) && !empty($content)) {

        $post->title = $title;
        $post->content = $content;
        $post->users_id = $userData->id;

        if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            $imageInfo = getimagesize($_FILES["image"]["tmp_name"]);
            $imgTmpName = $_FILES["image"]["tmp_name"];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpeg", "image/jpg"];

            if(in_array($imageInfo["mime"], $imageTypes)) {

                if(in_array($imageInfo["mime"], $jpgArray)) {
                    $imageFile = imagecreatefromjpeg($imgTmpName);
                } else {
                    $imageFile = imagecreatefrompng($imgTmpName);    
                }

                if($imageFile) {
                $imageName = $post->generateImageName();
                imagejpeg($imageFile, "./img/posts/" . $imageName, 100);
                $post->image = $imageName;
                } else {
                    $_SESSION["message"] = "Erro ao enviar imagem.";
                    header("Location: postprocess.php");
                    exit();
                }
                
            } else {
                $_SESSION["message"] = "Tipo inválido de imagem, insira jpg ou png.";
                header("Location: newpost.php");
                exit();
            }

        }
        $postDao->create($post);
        $_SESSION["message"] = "Post criado com sucesso!";
        header("Location: newpost.php");
        exit();
    
    } else {
    $_SESSION["message"] = "é necessario adicionar pelo menos título e conteúdo do post!";
    }
} elseif($type === "delete") {
    $id = filter_input(INPUT_POST,"id");

    $postDao->destroy($id); 
} elseif($type === "edit") {
    $id = filter_input(INPUT_POST,"id");
    $users_id = filter_input(INPUT_POST,"users_id");
    $title = filter_input(INPUT_POST,"title");
    $content = filter_input(INPUT_POST,"content");

    $post->id = $id;
    $post->users_id = $users_id;
    $post->title = $title;
    $post->content = $content;

    if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            $imageInfo = getimagesize($_FILES["image"]["tmp_name"]);
            $imgTmpName = $_FILES["image"]["tmp_name"];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpeg", "image/jpg"];

            if(in_array($imageInfo["mime"], $imageTypes)) {
                if(in_array($imageInfo["mime"], $jpgArray)) {
                    $imageFile = imagecreatefromjpeg($imgTmpName);
                } else {
                    $imageFile = imagecreatefrompng($imgTmpName);    
                }

                if($imageFile) {
                $imageName = $post->generateImageName();
                imagejpeg($imageFile, "./img/posts/" . $imageName, 100);
                $post->image = $imageName;
                } else {
                    $_SESSION["message"] = "Erro ao enviar imagem.";
                    header("Location: postprocess.php");
                    exit();
                }
                
            } else {
                $_SESSION["message"] = "Tipo inválido de imagem, insira jpg ou png.";
                header("Location: editpost.php");
                exit();
            }
            
    }
    $postDao->update($post);

}


