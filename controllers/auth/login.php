<?php
session_start();

require_once "../../vendor/helpers/helpers.php";
require_once "../../vendor/classes/db.php";
require_once "../../vendor/classes/user.php";
require_once "../../config/app.php";

if($_SERVER['REQUEST_METHOD'] ===  "POST" && !isset($_SESSION['id']) && isset($_POST['email']) && isset($_POST['password']) ){
    $user = new User(con: $db?->getCon());
    if($user->login($_POST['email'],$_POST['password'])){
        view("../../views/gallery.php");
    }
        view('../../views/login.php?err=invalid-credentials');
}