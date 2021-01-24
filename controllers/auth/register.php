<?php
session_start();

require_once "../../vendor/helpers/helpers.php";
require_once "../../vendor/classes/db.php";
require_once "../../vendor/classes/user.php";
require_once "../../config/app.php";

if($_SERVER['REQUEST_METHOD'] ===  "POST" && !isset($_SESSION['id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) ){
    $user = new User(con: $db?->getCon());
    $name = str_replace(" ","",$_POST['name']);
    $name = str_replace("##","",$name);
    if($user->create($name,$_POST['email'],$_POST['password'])){
        view("../../views/gallery.php");
    }
    view('../../views/register.php?old_name='.$name.'&old_email='.$_POST['email'].'&err_type='.$user->error['type'].'&err_msg='.urlencode($user->error['msg']));
}
