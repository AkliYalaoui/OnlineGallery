<?php
session_start();
require_once "../../vendor/helpers/helpers.php";

if($_SERVER['REQUEST_METHOD'] ===  "POST" && isset($_SESSION['id']) && isset($_POST['location']) && isset($_POST['new_folder'])){

    $currentPath = filter_inputs($_POST['location']);
    $new_folder = filter_inputs(str_replace("##","",$_POST['new_folder']));
    $path = "../../storage/";

    if(!$new_folder)
        view("../../exceptions/e.500.php");

    if($currentPath && is_dir("../$currentPath") && str_contains($currentPath,$_SESSION['name'])){
        $path = "../$currentPath/".$_SESSION['name']."##".$new_folder;
    }else{
        $path .= $_SESSION['name']."##".$new_folder;
    }

    is_dir($path)|| mkdir($path);
    view($_SERVER['HTTP_REFERER']);
}else{
    view("../../exceptions/e.500.php");
}