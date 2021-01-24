<?php
session_start();
require_once "../../vendor/helpers/helpers.php";
require_once "../../vendor/classes/file.php";

if( $_SERVER['REQUEST_METHOD'] === "POST" && isset($_SESSION['id']) && isset($_FILES['file']) && isset($_POST['location']) ){
    $file = new File($_FILES['file']);
    $currentPath = filter_inputs($_POST['location']);

    $count = 1;
    if(!is_dir("../".$currentPath) || (!str_contains($currentPath,$_SESSION['name']) && $currentPath !== "../storage") || !$file->store(str_replace("../storage/","",$currentPath, $count)."/".$_SESSION['name'].uniqid("##",true))){
        view("../../exceptions/e.500.php");
    }
    view($_SERVER['HTTP_REFERER']);
}