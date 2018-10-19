<?php

    session_start(); 

    if(!isset($_SESSION['id'])){
        $php_self = substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],"/")+1);
        if($php_self!="signup.php"&&$php_self!="login.php"){
            header("Location:login.php");
            exit();
        }
    }

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title><?php
            $php_self = substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],"/")+1);
            $pagename="";
            switch($php_self){
                case "index.php":
                    $pagename="Home";
                    break;
                case "login.php":
                    $pagename="Login";
                    break;
                case "problem.php":
                    $pagename="Problem";
                    break;
                case "contest.php":
                    $pagename="Contest";
                    break;
                case "my.php":
                    $pagename="My";
                    break;
                case "signup.php":
                    $pagename="Sign up";
                    break;
                case "viewproblem.php":
                    $pagename="Problem: ".$_GET["id"];
                    break;
                case "viewcontest.php":
                    $pagename="Contest: ".$_GET["id"];
                    break;
                case "editproblem.php":
                    $pagename="Edit Problem: ".$_GET["id"];
                    break;
                case "editcontest.php":
                    $pagename="Edit Contest: ".$_GET["id"];
                    break;
            }
            $pagename.=" - chpoj";
            echo $pagename;
        ?></title>
        <style>
            a, a:visited{
                color: blue;
                margin: 0 7px 0 0;
            }
            a:active {
                color: red;
            }
        </style>
    </head>
    <body>
        <h1><?php echo $pagename; ?></h1>
        <p>Hello<?php if(isset($_SESSION["id"]))echo ", ".$_SESSION["truename"]; ?>!</p>
        <?php
            if(isset($_SESSION["id"])){
                echo '<p>'.PHP_EOL;
                echo '<a href="index.php">Home</a>'.PHP_EOL.
                    '<a href="problem.php">Problem</a>'.PHP_EOL.
                    '<a href="contest.php">Contest</a>'.PHP_EOL.
                    '<a href="my.php">My</a>'.PHP_EOL;
                echo '<a href="logout.php">Logout</a>'.PHP_EOL;
                echo '<p>';
            }
        ?>