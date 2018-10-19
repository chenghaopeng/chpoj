<?php   
    $conn = mysqli_connect("localhost","chp","85203203") or die("Database access error:".mysql_error());  
    mysqli_select_db($conn,"oj_chper_cn") or die("Database visit error:".mysql_error());  
    mysqli_query($conn , "set names utf8");
?>