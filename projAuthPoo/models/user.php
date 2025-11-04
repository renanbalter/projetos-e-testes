<?php

class User {
    public $id;
    public $email;
    public $username;
    public $token;
    public $password;

    public function generateToken() {
        return bin2hex(random_bytes(50));
    }

    public function generatePassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function redirectTo($place) {
        header("Location: $place");
    }

}

interface UserDAOInterface {


    public function newUser($data);
    public function create(User $user, $isAuth = false);
    public function update(User $user);
    public function findByEmail($email);
    public function findById($id);
    public function findByToken($token);
    public function verifyToken($isAuth = false);
    public function setSessionToken($token);
    public function destroyToken();
    public function authenticateUser($email,$username, $password);


}