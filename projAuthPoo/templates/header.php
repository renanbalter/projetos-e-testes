<?php

require_once("db.php");
require_once("dao/userdao.php");
require_once("globals/url.php");

$userDao = new UserDAO($conn, $BASE_URL);

$userData = $userDao->verifyToken();

var_dump($_SESSION);
var_dump($userData);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css  -->
    <link rel="stylesheet" href="css/styles.css" class="css">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>ProjAuthPoo</title>
</head>

<header class="main-header">
        <nav class="navbar navbar-expand-lg bg-dark">
            <a href="<?=$BASE_URL?>index.php" class="navbar-brand ms-2">XD</a>
            <form action="search.php" method="GET" id="search-form" class="form-inline my-2 my-lg-0 d-flex align-items-center container-sm">
                <input type="text" name="search" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar..." aria-label="Search">
                <button class="button" id="search-btn" type="submit" >
                <i class="fas fa-search"></i>
                </button>
            </form>
            <?php if($userData): ?>
            <div class="navbar-item ms-auto me-1">
                <a href="newpost.php" class="navbar-link fw-bold" id="post-btn">Postar</a>
            </div>
            <div class="navbar-item ms-auto me-1">
                <a href="dashboard.php" class="navbar-link fw-bold" id="post-btn">Meus Posts</a>
            </div>
            <div class="navbar-item ms-auto me-1">
                <a href="profile.php" class="navbar-link fw-bold"><?= $userData->username ?></a>
            </div>
            <div class="navbar-item ms-auto me-4">
                <a href="logout.php" class="navbar-link fw-bold">Logout</a>
            </div>
            <?php else: ?>
                <div class="navbar-item ms-auto me-4">
                <a href="auth.php" class="navbar-link fw-bold">Entrar/Cadastrar</a>
                </div>
            <?php endif; ?>
        </nav>
        <?php if(isset($_SESSION["message"])): ?>
            <p id="msg" class=""><?=$_SESSION["message"]?></p>
            <?php unset($_SESSION["message"]); ?>
        <?php endif; ?>
</header>