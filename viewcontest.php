<?php require("header.php");?>

<br>
<?php
    
    if(!isset($_GET["id"])){
        header("Location:contest.php");
        exit();
    }
    
    include("conn.php");
    $id=$_GET["id"];
    $que=mysqli_query($conn,"select * from contest where id=$id limit 1");
    if(mysqli_num_rows($que)==0){
        echo "Invalid ID.";
        exit();
    }
    $res=mysqli_fetch_array($que);
    if($res["open"]!=1&&$_SESSION["usergroup"]!=0){
        echo "You have no authority.";
        exit();
    }
    $title=$res["title"];
    $problem=explode(",",$res["problem"]);
    $ug=$_SESSION["usergroup"];
    echo "<h1>".$title."</h1>";
    $str="select * from problem where (allowed='$ug' or allowed=0) and open=1 and (id=$problem[0]";
    for($i=1;$i<count($problem);$i++)$str.=" or id=$problem[$i]";
    $str.=")";
    $que=mysqli_query($conn,$str);
    echo "<p>Number of problems you can submit: ".mysqli_num_rows($que)."<p>";
    while($currow=mysqli_fetch_array($que,MYSQLI_ASSOC)){
        echo "<p>".PHP_EOL;
        echo $currow["id"].'.  ';
        echo "<a href='viewproblem.php?id=".$currow["id"]."&contest=".$title."'>".$currow["title"]."</a>";
        if($ug==0){
            echo "<a href='editproblem.php?id=".$currow["id"]."'>Edit ";
            echo $currow["open"]==0? "×":"√";
            echo "(".($currow["allowed"]==0?"ALL":$currow["allowed"]).")";
            echo "</a>";
        }
        echo "</p>".PHP_EOL;
    }
    
?>

<?php require("footer.php");?>