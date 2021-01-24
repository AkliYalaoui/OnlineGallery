<?php

use JetBrains\PhpStorm\NoReturn;
use JetBrains\PhpStorm\Pure;

if(!function_exists('filter_inputs')){
    #[Pure] function filter_inputs(string $inputs,int $filter = FILTER_SANITIZE_STRING): ?string
    {
        $inputs = filter_var(trim($inputs),$filter);
        $inputs = htmlspecialchars($inputs);
        return ($inputs === "" ? null:$inputs);
    }
}

if(!function_exists('view')){
    #[NoReturn] function view(string $path):void{
        header("Location:$path");
        exit;
    }
}
if(!function_exists('logout')){
    #[NoReturn] function logout($redirect){
        session_unset();
        session_destroy();
        view($redirect);
    }
}
if(!function_exists("file_type")){
    #[Pure] function file_type(string $file):string{

        $type = pathinfo($file,PATHINFO_EXTENSION);

        if(in_array($type,["jpg","jpeg","png","gif"]))
            return "img";
        elseif ($type === "mp4")
            return "video";
        elseif ($type === "mp3")
            return "audio";
        else
            return "folder";
    }
}