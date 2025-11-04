<?php

require_once("templates/header.php");
$userDao->verifyToken(true);

?>

<body class="profile-body">
    <div class="username me-4 my-4">
        <div class="text-center mb-4"id="profile-userinfo">
            <header class="display-5"><?= $userData->username ?></header>
            <p class="ms-3">Atualize seus dados:</p>
        </div>

        <div class="container ">
        <div class="row p-3 ms-4 mx-auto justify-content-center align-items-center">
            <div class="update-form col-md-5">
                <form action="profileprocess.php" method="POST" class="w-100" style="max-width: 400px;">
                    <input type="hidden" name="type" value="update">
                    
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="text" name="email" id="email" placeholder="<?= $userData->email ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="username">Nome de usuário:</label>
                        <input type="text" name="username" id="name" placeholder="<?= $userData->username ?>">
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" class="update-btn" value="Alterar">
                    </div>
                </form>
            </div> <!-- .update-form -->
            <div class="password-form col-md-5">
                <form action="profileprocess.php" method="POST" class="w-100" style="max-width: 400px;">
                    <input type="hidden" name="type" value="change-pw">
                        <div class="form-group mb-3">
                            <label for="password">Trocar senha:</label>
                            <input type="password" name="password" id="password" placeholder="Digite a nova senha...">
                        </div>
                        <div class="form-group mb-3">
                            <label for="confirmpassword">Confirme sua senha:</label>
                            <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Repita a nova senha...">
                        </div>
                        <div class="form-group">
                        <input type="submit" class="update-btn" value="Alterar senha">
                    </div>




                </form>


            </div>

        </div> <!-- .row -->
    </div> <!-- .container -->
</div> <!-- .username -->
</body>