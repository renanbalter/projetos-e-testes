<?php

include_once("db.php");
include_once("dao/userdao.php");
include_once("models/user.php");
include_once("globals/url.php");

$userDao = new UserDao($conn, $BASE_URL);

$type = filter_input(INPUT_POST, "type");

if($type === "update") {
    $userData = $userDao->verifyToken();

    $email = filter_input(INPUT_POST, "email");
    $username = filter_input(INPUT_POST, "username");

    $userData->email = $email;
    $userData->username = $username;

    try {
    $userDao->update($userData);

    header("Location: index.php");
    } catch(Exception $e) {

    $_SESSION["message"] = "Erro: " . $e->getMessage();

    }

 
} elseif($type === "change-pw") {
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    $userData = $userDao->verifyToken();

    $id = $userData->id;

    if($password === $confirmpassword) {
        $user = new User();

        $finalpassword = $user->generatePassword($password);

        $user->password = $finalpassword;
        $user->id = $id;

        $userDao->changePassword($user);

        header("Location: profile.php");
        $_SESSION["message"] = "Senha alterada com sucesso!";



    } else {
        header("Location: profile.php");
        $_SESSION["message"] = "As senhas não batem!";
    }
} else {
    $_SESSION["message"] = "Informações inválidas!";
}