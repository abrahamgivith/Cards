<?php
    
    spl_autoload_register('Autoloader');

    function Autoloader($className){
        $path = "classes/";
        $exetension = ".class.php";
        $fullpath = $path.strtolower($className).$exetension;
        
        if(!file_exists($fullpath)){
            return false;
        }
        include_once $fullpath;
        
        
    }


?>
