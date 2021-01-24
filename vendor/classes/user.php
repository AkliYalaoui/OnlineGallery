<?php


use JetBrains\PhpStorm\NoReturn;
use JetBrains\PhpStorm\Pure;

class User
{
    public array $error = [];
    public function __construct(private PDO $con){}
    public function create(string $name, string $email, string $password):bool{
        $name = filter_inputs($name);
        $email = filter_inputs($email,FILTER_SANITIZE_EMAIL);
        $password = filter_inputs($password);
        if(strlen($name) < 8){
            $this->error['type'] = "name";
            $this->error['msg'] = "name must contain at least 4 characters";
        }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $this->error['type'] = "email";
            $this->error['msg'] = "please provide a valid email";
        }
        elseif(strlen($password) < 8){
            $this->error['type'] = "password";
            $this->error['msg'] = "password must contain at least 8 characters";
        }
        if(count($this->error) > 0){
            return false;
        }
        $password = sha1($password);
        $stmt = $this->con->prepare("INSERT INTO `user` (`name`,`email`,`password`) VALUES (:name,:email,:password)");
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':password',$password);
        return $stmt->execute();
    }
    public function login(string $email, string $password):bool{
        $email = filter_inputs($email,FILTER_SANITIZE_EMAIL);
        $password = filter_inputs($password);
        $password = sha1($password);
        $stmt = $this->con->prepare("SELECT * FROM `user` WHERE email= ? AND password=? LIMIT 1");
        $stmt->bindParam(1,$email);
        $stmt->bindParam(2,$password);
        if($stmt->execute()){

            $user = $stmt->fetch();

            if(!$user){
                return false;
            }else{
                $_SESSION['id'] = $user["id"];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                return true;
            }
        }
        return false;
    }
    #[NoReturn] public function logout($redirect){
        session_unset();
        session_destroy();
        view($redirect);
    }
}