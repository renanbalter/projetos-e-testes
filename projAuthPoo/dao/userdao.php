<?php

require_once("models/user.php");


class UserDAO implements UserDAOInterface {

    private $conn;
    private $url;

    public function __construct(PDO $conn, $url) {
        $this->conn = $conn;
        $this->url = $url;
    }

    public function newUser($data) {

        $user = new User;

        $user->id = $data["id"];
        $user->email = $data["email"];
        $user->username = $data["username"];
        $user->password = $data["password"];
        $user->token = $data["token"];


        return $user;

    }

    public function update(User $user) {
        $stmt = $this->conn->prepare("UPDATE users SET username = :username, email = :email, token = :token WHERE id = :id");

        $stmt->bindParam(":username", $user->username);
        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":token", $user->token);
        $stmt->bindParam(":id", $user->id);

        try {
        $stmt->execute();
        
        } catch (Exception $e) {
            $_SESSION["message"] = "Erro! " . $e->getMessage();
        }

        
 
    }

    public function create(User $user, $authUser = false) {
        $stmt = $this->conn->prepare("INSERT INTO users(username, password, email, token) VALUES (:username, :password, :email, :token)");

        $stmt->bindParam(":username", $user->username);
        $stmt->bindParam(":password", $user->password);
        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":token", $user->token);

        $stmt->execute();

        if($authUser) {
            $this->setSessionToken($user->token);
        }

    }

    public function authenticateUser($email,$username,$password) {
        // procura o usuário pelo email inserido
        $user = $this->findByEmail($email);

        if($user) {
            
            if(password_verify($password, $user->password)) {

                if($username == $user->username) {

                    // gera token e coloca na sessao
                    $token = $user->generateToken();
                    $this->setSessionToken($token);

                    // atualiza o token do usuário
                    $user->token = $token;
                    $this->update($user);

                    return true;

                } else {
                    return false;
                }
            } else {
            return false;
            }

        } else {
            return false;
        }
    }

    public function findByEmail($email) {
        // checa se email ja existe no db
        if($email != "") {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");

        $stmt->bindParam(":email", $email);

        $stmt->execute();

         if($stmt->rowCount() > 0) {
            $data = $stmt->fetch();
            $user = $this->newUser($data);

            return $user;
        } else {
            return false;
        }
    } else {
        return false;
    }

    }

    public function findById($id) {
        if($id != "") {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $data = $stmt->fetch();
           if($data) {
            $user = $this->newUser($data);
            return $user;
          } else {
            return false;
          }
        }
    }

    public function findByToken($token) {
        if($token != "") {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");

            $stmt->bindParam(":token", $token);

            $stmt->execute();

              if($stmt->rowCount() > 0 ) {

                $data = $stmt->fetch();
            
                $user = $this->newUser($data);

                return $user;

            }
        }
        return false;

    }

    public function verifyToken($protected = false) {
        if (!empty($_SESSION["token"])) {

            $token = $_SESSION["token"];

            $user = $this->findByToken($token);

            if($user) {
            return $user;
        } else {
        return false;
        }
        }elseif($protected) {
            $_SESSION["message"] = "Faça autenticação para acessar a página.";
            header("Location: index.php");
            exit;
        } else{
        return false;
        }

    }


    public function setSessionToken($token) {

        $_SESSION["token"] = $token;

    }


    public function destroyToken() {

        $_SESSION["token"] = "";

    }

    public function changePassword(User $user) {

      $stmt = $this->conn->prepare("UPDATE users SET password = :password WHERE id = :id");

      $stmt->bindParam(":password", $user->password);
      $stmt->bindParam(":id", $user->id);

      $stmt->execute();

    }
}