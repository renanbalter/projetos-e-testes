<?php

require_once("templates/header.php");


?>

<body class="profile-body">
    <p class="display-1 text-center" style="padding-left:0; padding-right:50; margin:0;"> Novo Post </p>

    <div class="container container-fluid d-flex justify-content-center align-items-center">
        
    <form action="postprocess.php" method="POST" class="w-100 text-center" enctype="multipart/form-data" style="max-width: 400px; padding-top:25;">
                    <input type="hidden" name="type" value="create">
                    
                    <div class="form-group">
                        <label for="title">Título:</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Digite o título do post...">
                    </div>

                    <div class="form-group">
                        <label for="image">Imagem:</label>
                        <input type="file" class="form-control-file" name="image" id="image">
                    </div>

                    <div class="form-group">
                        <label for="content">Digite o conteúdo do post:</label>
                        <textarea class="form-control" name="content" id="content" rows="7" placeholder=""> </textarea>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" class="update-btn" value="Postar">
                    </div>
    </form>
</div>







</body>