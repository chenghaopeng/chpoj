<?php

    session_start();
    
    require("function.php");
    
    $username=$password=$truename=$school=$qq="";
    $result="";
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
        $username=format_input($_POST["username"]);
        $password=format_input($_POST["password"]);
        $truename=format_input($_POST["truename"]);
        $school=format_input($_POST["school"]);
        $qq=format_input($_POST["qq"]);
        
        if($username=="")$result.="Username ";
        if($password=="")$result.="Password ";
        if($truename=="")$result.="Name ";
        if($school=="")$result.="School ";
        if($qq=="")$result.="QQ ";
        
        if($result==""){
            include("conn.php");
            $check_exist=mysqli_query($conn,"select id from user where username='$username' limit 1");
            if(mysqli_num_rows($check_exist)>0){
                $result="The Username is occupied!";
            }
            else{
                $insert_data=mysqli_query($conn,"insert into user(username,password,truename,school,qq,usergroup) VALUES('$username','$password','$truename','$school','$qq',-1)");
                if(!$insert_data){
                    $result='Failed to insert data!';
                }
                else{
                    header("Location:index.php");
                }
            }
        }
        else $result.="is necessary!";
        
    }

?>

<?php require("header.php");?>

<form method="post" action="signup.php">
    <p>
        <label for="username">Username:</label>
        <input name="username" type="text" value="<?php $username ?>" autocomplete="off"/>
    </p>
    <p>
        <label for="password">Password:</label>
        <input name="password" type="password" value="<?php $password ?>" autocomplete="off"/>
    <p>
    <p>
        <label for="truename">Name:</label>
        <input name="truename" type="text" value="<?php $name ?>" autocomplete="off"/>
    <p>
    <p>
        <label for="school">School:</label>
        <input name="school" type="text" value="<?php $school ?>" autocomplete="off"/>
    <p>
    <p>
        <label for="qq">QQ:</label>
        <input name="qq" type="text" value="<?php $qq ?>" autocomplete="off"/>
    <p>
    <p>
        <input type="submit" name="submit" value="  Sign up  " autocomplete="off"/>  
    <p>
    <p style="color: red;"><?php echo $result; ?></p>
</form>
<a href="index.php">Login</a>

<?php require("footer.php");?>