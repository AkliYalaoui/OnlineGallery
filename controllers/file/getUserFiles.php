<?php

    $currentFolder = urldecode($_GET['folder'] ?? "../storage");
    if(!is_dir($currentFolder))
        view("../exceptions/views/e.500.php");
    $myFiles = scandir($currentFolder);

    $myFiles = array_filter($myFiles,function ($oneFile){
        if (str_starts_with($oneFile,$_SESSION['name']))
            return true;
        return false;
    });

    $folders = array_filter($myFiles,function ($myFile) use ($currentFolder){
        if(is_dir("$currentFolder/$myFile"))
            return true;
        else
            return false;
    });

    $media = array_filter($myFiles,function ($myFile) use ($currentFolder){
       if(is_file("$currentFolder/$myFile"))
           return true;
       return false;
    });