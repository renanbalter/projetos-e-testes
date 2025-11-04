<?php
require_once("templates/header.php");
require_once("dao/postdao.php");

$postDao = new PostDAO($conn, $BASE_URL);   



?>


<body class="main-content">
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- bootstrap js -->
     
    
    <p class="container display-1 text-center p-4">Veja as novidades do site:</p>
    
    
        <?php $posts = $postDao->findAllPosts(); ?>
        <?php var_dump($posts) ?>
        
        <?php foreach($posts as $post): ?> 

        <div class="card w-50 container my-5 bg-dark text-white post">
            <a href="<?= $BASE_URL?>viewpost.php?id=<?=$post->id?>" id="card-anchor">
            
            <div class="d-flex align-items-start"><?=$userDao->findById($post->users_id)->username?> </div>
            <div class="justify-content-center">

            <div class="card-title fs-3 col-auto text-break"> <?= $post->title ?> </div>
                
            </div>
            <div class="post-image mx-auto">
                <img src="img/posts/<?=$post->image?>" class="img-fluid rounded mb-3" alt="">               
            </div>
            <div class="pb-1">
            <p class="card-text"> <?= $post->content ?> </p>
            </div>  
        </div> 
        </a>
        <?php endforeach; ?>
</body>
</html>