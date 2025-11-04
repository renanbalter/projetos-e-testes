<?php
require_once("templates/header.php");
require_once("dao/postdao.php");
require_once("dao/commentdao.php");

$commentdao = new CommentDAO($conn, $BASE_URL);
$postDao = new PostDAO($conn, $BASE_URL);

$post = $postDao->findById($_GET["id"]);

$whoPosted = $userDao->findById($post->users_id)->username;

$comments = $commentdao->FindPostComments($post->id);


var_dump($comments);


?>


<body class="main-content">
    <?php if($userDao->verifyToken()): ?>
    <div class="container col-6 py-2">
        <p><?= $whoPosted ?></p>
    </div>
    <?php if($userData->id === $post->users_id): ?>
    <div class="d-flex justify-content-center">
    <a href="dashboard.php" class="editpost-btn">Este post pertence a você. Clique para editar ou deletar.</a>
    </div>
    <?php endif; ?>
<div class="post-content text-break w-50 mx-auto">
<header class="content fs-2"><?= $post->title ?></header>
</div>
<?php if($post->image):  ?>
<div class="container text-center ">
    <img src="img/posts/<?=$post->image?>" class="img-fluid rounded mb-3 viewpost-img" alt="">
</div>
<?php else: ?>
    <div class="py-1"></div>
<?php endif; ?>
<div class="post-content text-break w-50 mx-auto">
<p> <?= $post->content ?> </p>
</div>
</div>


<p class="container col-6">Veja os comentários:</p>
<div class="container col-6 pb-4">
<form action="commentprocess.php" method="POST">
    <input type="hidden" name="type" value="create">
    <input type="hidden" name="posts_id" value="<?= $post->id ?>">
    <input type="hidden" name="users_id" value="<?= $userData->id ?>">
    <div class="text-center w-100">
    <input type="text" class="form-control" name="content" id="content" placeholder="Dê a sua opinião...">
    </div>
</form>
</div>

<?php if($comments != ""): ?>
<?php foreach($comments as $comment): ?>
    <div class="container pb-3 border">

        <div class="pt-1"><?= $userDao->findById($comment->users_id)->username ?></div>
        <div class="pt-2"><?= $comment->content ?></div>

    </div>
<?php endforeach; ?>
<?php else: ?>
    <p class="display-1 text-center pt-4 text-white">Ainda não há comentários.</p>
<?php endif; ?>
<?php else: ?>
    <a href="auth.php" class="require-auth-btn"><p class="container display-3 p-4 text-center">Faça login para continuar.</p></a>

</body>
<?php endif; ?>