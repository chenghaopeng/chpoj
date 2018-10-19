<?php require("header.php");?>

<?php

    if($_SESSION["usergroup"]!=0){
        header("Location:contest.php");
    }
    
    if(!isset($_GET["id"])){
        header("Location:contest.php");
    }
    $id=$_GET["id"];
    $open=0;
    $title=$problem="";
    $result="";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include("conn.php");
        $id=$_POST["id"];
        $title=$_POST["title"];
        $problem=$_POST["problem"];
        $open=$_POST["open"];
        if($id==0){
            $res=mysqli_query($conn,"insert into contest(title,problem,open) VALUES('$title','$problem',$open)");
            if(!$res)$result="Insert New Error.";
            else header("Location:contest.php");
        }
        else{
            $res=mysqli_query($conn,"update contest set title='$title',problem='$problem',open=$open where id=$id");
            if(!$res)$result="Update Error.";
            else header("Location:contest.php");
        }
    }
    else{
        include("conn.php");
        $id=$_GET["id"];
        if($id==0){
            $open=1;
            $title=$problem="";
        }
        else{
            $que=mysqli_query($conn,"select * from contest where id=".$id);
            if(mysqli_num_rows($que)==0){
                header("Location:contest.php");
            }
            $res=mysqli_fetch_array($que);
            $title=$res["title"];
            $problem=$res["problem"];
            $open=$res["open"];
        }
    }
    
?>

<br>
<form method="post" action="<?php echo 'editcontest.php?id='.$id; ?>">
    <p>
        <label for="id">ID:</label>
        <input name="id" type="text" value="<?php echo $id; ?>" readonly="readonly"/>
    </p>
    <p>
        <label for="title">Title:</label>
        <input name="title" type="text" value="<?php echo $title; ?>" autocomplete="off"/>
    </p>
    <p>
        <label for="problem">Problem:</label>
        <input name="problem" type="text" value="<?php echo $problem; ?>" autocomplete="off"/>
    </p>
    <p>
        <label for="open">Open:</label>
        <input name="open" type="text" value="<?php echo $open; ?>" autocomplete="off"/>
    </p>
    <p>
        <input type="submit" name="submit" value="  Insert / Update  " autocomplete="off"/>  
    <p>
    <p style="color: red;"><?php echo $result; ?></p>
</form>

<?php require("footer.php");?>