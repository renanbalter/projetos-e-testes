<?php 

include_once("templates/header.php");

$userDao = new UserDAO($conn, $BASE_URL);

?>

<body id="authform">
  <div class="container">
<div class="row p-4">
  <div class="col-md-6" id="login-header">
    <!-- formulario de login -->
    <h1 class="content login-header">Login</h1>
    <form action="authprocess.php" method="POST" >
    <input type="hidden" name="type" value="login">
    <div class="form-group">
    <label for="email">Digite seu e-mail:</label>
    <input type="text" name="email" id="email">
    </div>
    <div class="form-group">
    <label for="username">Digite seu nome de usuário: </label>
    <input type="text" name="username" id="name">
    </div>
    <div class="form-group">
    <label for="password">Senha:</label>
    <input type="password" name="password" id="password">
    </div>
    <input type="submit" class="auth-btn" value="Entrar" id="">
    </form>
 </div>
 <!-- formulario de registro -->
 <div class="col-md-6">
    <h2 class="content register-header">Registrar</h2>
    <form action="authprocess.php" method="POST" >
    <input type="hidden" name="type" value="register">
    <div class="form-group">
    <label for="email"> Digite seu e-mail: </label>
    <input type="text" name="email" id="email">
    </div>
    <div class="form-group">
    <label for="username">Digite seu nome de usuário: </label>
    <input type="text" name="username" id="username">
    </div>
    <div class="form-group">
    <label for="password"> Senha: </label>
    <input type="password" name="password" id="password">
    </div>
    <div class="form-group">
    <label for="password"> Confirme sua senha: </label>
    <input type="password" name="confirmpassword" id="confirmpassword">
    </div>
    <input type="submit" class="auth-btn" value="Registrar" id="">
    </form>
</div>
</div>
</div>
    



    
</body>
</html>