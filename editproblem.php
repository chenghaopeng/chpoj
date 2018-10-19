<?php require("header.php");?>

<?php

    if($_SESSION["usergroup"]!=0){
        header("Location:problem.php");
    }
    
    if(!isset($_GET["id"])){
        header("Location:problem.php");
    }
    $id=$_GET["id"];
    $timlim=$memlim=$allowed=$open=0;
    $title=$descript=$sampin=$sampout=$hint="";
    $result="";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include("conn.php");
        $id=$_POST["id"];
        $title=$_POST["title"];
        $timlim=$_POST["timlim"];
        $memlim=$_POST["memlim"];
        $descript=$_POST["descript"];
        $sampin=$_POST["sampin"];
        $sampout=$_POST["sampout"];
        $hint=$_POST["hint"];
        $allowed=$_POST["allowed"];
        $open=$_POST["open"];
        if($id==0){
            $res=mysqli_query($conn,"insert into problem(title,timlim,memlim,descript,sampin,sampout,hint,allowed,open) VALUES('$title',$timlim,$memlim,'$descript','$sampin','$sampout','$hint',$allowed,$open)");
            if(!$res)$result="Insert New Error.";
            else header("Location:problem.php");
        }
        else{
            $res=mysqli_query($conn,"update problem set title='$title',timlim=$timlim,memlim=$memlim,descript='$descript',sampin='$sampin',sampout='$sampout',hint='$hint',allowed=$allowed,open=$open where id=$id");
            if(!$res)$result="Update Error.";
            else header("Location:problem.php");
        }
    }
    else{
        include("conn.php");
        $id=$_GET["id"];
        if($id==0){
            $timlim=1;$memlim=128;$allowed=0;$open=1;
            $title=$descript=$sampin=$sampout=$hint="";
        }
        else{
            $que=mysqli_query($conn,"select * from problem where id=".$id);
            if(mysqli_num_rows($que)==0){
                header("Location:problem.php");
            }
            $res=mysqli_fetch_array($que);
            $timlim=$res["timlim"];$memlim=$res["memlim"];$allowed=$res["allowed"];$open=$res["open"];
            $title=$res["title"];
            $descript=$res["descript"];
            $sampin=$res["sampin"];
            $sampout=$res["sampout"];
            $hint=$res["hint"];
        }
    }
    
?>

<br>
<form method="post" action="<?php echo 'editproblem.php?id='.$id; ?>">
    <p>
        <label for="id">ID:</label>
        <input name="id" type="text" value="<?php echo $id; ?>" readonly="readonly"/>
    </p>
    <p>
        <label for="title">Title:</label>
        <input name="title" type="text" value="<?php echo $title; ?>" autocomplete="off"/>
    </p>
    <p>
        <label for="timlim">Time Limit:</label>
        <input name="timlim" type="text" value="<?php echo $timlim; ?>" autocomplete="off"/>
    </p>
    <p>
        <label for="memlim">Memory Limit:</label>
        <input name="memlim" type="text" value="<?php echo $memlim; ?>" autocomplete="off"/>
    </p>
    <p>
        <label for="allowed">Allowed:</label>
        <input name="allowed" type="text" value="<?php echo $allowed; ?>" autocomplete="off"/>
    </p>
    <p>
        <label for="open">Open:</label>
        <input name="open" type="text" value="<?php echo $open; ?>" autocomplete="off"/>
    </p>
    <p>
        <label for="descript">Description:</label><br>
        <textarea name="descript" autocomplete="off" rows="15" cols="70"><?php echo $descript; ?></textarea>
    </p>
    <p>
        <label for="sampin">Sample Input:</label><br>
        <textarea name="sampin" autocomplete="off" rows="15" cols="70"><?php echo $sampin; ?></textarea>
    </p>
    <p>
        <label for="sampout">Sample Output:</label><br>
        <textarea name="sampout" autocomplete="off" rows="15" cols="70"><?php echo $sampout; ?></textarea>
    </p>
    <p>
        <label for="hint">Hint:</label><br>
        <textarea name="hint" autocomplete="off" rows="15" cols="70"><?php echo $hint; ?></textarea>
    </p>
    <p>
        <input type="submit" name="submit" value="  Insert / Update  " autocomplete="off"/>  
    <p>
    <p style="color: red;"><?php echo $result; ?></p>
</form>

<?php require("footer.php");?>