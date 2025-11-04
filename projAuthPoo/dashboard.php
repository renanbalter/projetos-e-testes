<?php

require_once("templates/header.php");
require_once("dao/userdao.php");
require_once("dao/postdao.php");

$postDao = new PostDAO($conn, $BASE_URL);
var_dump($postDao->getPostByUserId($userData->id));
$posts = $postDao->getPostByUserId($userData->id);
?>

<body class="main-content">
    <header class="display-3 text-center mb-4"> Meus Posts </header>


    <?php if($posts): ?>
    <div class="row w-100 text-center fs-4 mb-4">
        <div class="col">ID</div>
        <div class="col">Título</div>    
        <div class="col">Ações</div>
    </div>

    <?php foreach($posts as $post): ?>
    <div class="row w-100 text-center fs-4 mb-4">
        <div class="col"><?= $post->id ?></div>
        <div class="col"><?= $post->title ?></div>
        <div class="col d-flex ">
            <form class="mx-auto" action="postprocess.php" method="POST">
                <input type="hidden" name="type" value="delete">
                <input type="hidden" name="id" value="<?= $post->id ?>">
                <button type="submit" class="btn text-white">
                Deletar<i class="fa-solid fa-xmark"></i>
                </button>
            </form>
            <div class="mx-auto">
            <a class="btn text-white pe-4" href="editpost.php?id=<?=$post->id?>">Editar<i class="fa-solid fa-gear"></i></a>
            </div>
        </div>
        
    </div>
    <?php endforeach; ?>
    <?php else: ?>
        <p class="display-2 text-center pt-4">Não há posts aqui.</p>
        <a href="newpost.php"><p class="class text-center">Clique aqui para criar um post...</p></a>
    <?php endif; ?>
    
</body>