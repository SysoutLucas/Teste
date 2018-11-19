<?php

namespace App\View;

class View {
    
    function __construct(){
        //
    }

    function render($template,$args = []){
        extract($args);
        $file = dirname(__DIR__).'\\template\\'.$template.'.php';
        if(!file_exists($file)){
            $file = dirname(__DIR__).'\\template\\notfound.php';
        }
        include $file;
    }
}