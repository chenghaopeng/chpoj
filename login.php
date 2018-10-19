<?php

    session_start();
    
    header("Content-Type: text/html;charset=utf-8");
    
    if(isset($_SESSION["id"])){
        header("Location:index.php");
        exit();
    }
    
    require("function.php");
    
    $username=$password="";
    $result="";
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
        $username=format_input($_POST["username"]);
        $password=format_input($_POST["password"]);
        
        if($username=="")$result.="Username ";
        if($password=="")$result.="Password ";
        
        if($result==""){
            include("conn.php");
            $check=mysqli_query($conn,"select * from user where username='$username' and password='$password' limit 1");
            if($check_result=mysqli_fetch_array($check)){
                $_SESSION["id"]=$check_result["id"];
                $_SESSION["username"]=$check_result["username"];
                $_SESSION["truename"]=$check_result["truename"];
                $_SESSION["usergroup"]=$check_result["usergroup"];
                header("Location:index.php");
                exit();
            }
            else{
                $result="Incorrect Username or Password!";
            }
        }
        else $result.="is necessary!";
        
    }
    
?>

<?php require("header.php");?>

<form method="post" action="login.php">
    <p>
        <label for="username">Username:</label>
        <input name="username" type="text" value="<?php $username ?>" autocomplete="off"/>
    </p>
    <p>
        <label for="password">Password:</label>
        <input name="password" type="password" value="<?php $username ?>" autocomplete="off"/>
    <p>
    <p>
        <input type="submit" name="submit" value="  Login  "/>  
    <p>
    <p style="color: red;"><?php echo $result; ?></p>
</form>
<a href="signup.php">Sign up</a>

<?php require("footer.php");?>