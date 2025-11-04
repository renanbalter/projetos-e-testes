<?php
require_once("templates/header.php");
require_once("dao/postdao.php");

$postDao = new Postdao($conn, $BASE_URL);

$id = filter_input(INPUT_GET,"id");

$post = $postDao->findById($id);
?>

<body class="profile-body">
    <p class="display-1 text-center" style="padding-left:0; padding-right:50; margin:0;"> Edição de Post </p>

    <div class="container container-fluid d-flex justify-content-center align-items-center">
        
    <form action="postprocess.php" method="POST" class="w-100 text-center" enctype="multipart/form-data" style="max-width: 400px; padding-top:25;">
                    <input type="hidden" name="type" value="edit">
                    <input type="hidden" name="id" value="<?= $post->id ?>">
                    <input type="hidden" name="users_id" value="<?= $post->users_id ?>">
                    
                    <div class="form-group">
                        <label for="title">Título:</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="<?= $post->title ?>">
                    </div>

                    <div class="form-group">
                        <label for="image">Nova Imagem:</label>
                        <input type="file" class="form-control-file" name="image" id="image">
                    </div>

                    <div class="form-group">
                        <label for="content">Digite o novo conteúdo do post:</label>
                        <textarea class="form-control" name="content" id="content" rows="7" placeholder="<?= $post->content ?>"></textarea>
                        
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" class="update-btn" value="Finalizar">
                    </div>
    </form>
</div>