<?php
    function format_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function create_d ir($path){
        is_dir($path) OR mkdir($path, 0777, true);
    }
    function write_file($path,$appe,$text){
        if($appe==true){
            $file=fopen($path,"a");
        }
        else{
            $file=fopen($path,"w");
        }
        fwrite($file,$text);
        fclose($file);
    }
?> 