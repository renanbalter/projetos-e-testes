<?php

include_once("db.php");
include_once("dao/userdao.php");
include_once("models/user.php");
include_once("globals/url.php");

// filter_input(tipo_da_requisicao, nome_do_campo, filtro_opcional) vai retornar o value do post...
$type = filter_input(INPUT_POST, "type");

$userDao = new UserDAO($conn, $BASE_URL);

$user = new User();

if($type == "register") {
    $email = filter_input(INPUT_POST, "email");
    $username = filter_input(INPUT_POST, "username");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // confirmação de dados
    if($email && $username && $password && $confirmpassword) {
        //confirmação de senha
        if($password === $confirmpassword) {
            //olhar se email ja esta na db
            if($userDao->findByEmail($email) === false) {

                // criar token e senha(criptografada)
                $userToken = $user->generateToken();
                $finalpassword = $user->generatePassword($password);

                $user->email = $email;
                $user->username = $username;
                $user->password = $finalpassword;
                $user->token = $userToken;

                $auth = true;

                $userDao->create($user, $auth);
                $_SESSION["message"] = "Usuário criado com sucesso!";


            } else {
                $_SESSION["message"] = "Email já cadastrado.";
            }

        } else {
            $_SESSION["message"] = "Senhas não são iguais.";
        }

    } else {
        $_SESSION["message"] = "Preencha todos os campos.";
    }
    header("Location: auth.php");

} elseif($type == "login") {
    $email = filter_input(INPUT_POST, "email");
    $username = filter_input(INPUT_POST, "username");
    $password = filter_input(INPUT_POST, "password");

    // verificar se os campos estao preenchidos
    if($email && $username && $password) {

        // autentica usuário 
        if($userDao->authenticateUser($email,$username, $password)) {
            $_SESSION["message"] = "Seja bem vindo!";
            header("Location: index.php");
            exit();
        } else {
            $_SESSION["message"] = "Usuário e/ou senha não encontrados.";
            header("Location: auth.php");
            exit();
        }
        

    } else {
        $_SESSION["message"] = "Preencha todos os campos.";
        header("Location: auth.php");
        exit();
    }


}