<?php require("header.php");?>

<?php
    
    include("conn.php");
    if($_SESSION["usergroup"]==-1){
        echo "You have no authority.";
    }
    else{
        $ug=$_SESSION["usergroup"];
        $strquery="select * from problem where (allowed=$ug or allowed=0) and open=1";
        if($ug==0)$strquery="select * from problem";
        $resquery=mysqli_query($conn,$strquery);
        echo "<p>Number of problems you can submit: ".mysqli_num_rows($resquery)."<p>";
        while($currow=mysqli_fetch_array($resquery,MYSQLI_ASSOC)){
            echo "<p>".PHP_EOL;
            echo $currow["id"].'.  ';
            echo "<a href='viewproblem.php?id=".$currow["id"]."'>".$currow["title"]."</a>";
            if($ug==0){
                echo "<a href='editproblem.php?id=".$currow["id"]."'>Edit ";
                echo $currow["open"]==0? "×":"√";
                echo "(".($currow["allowed"]==0?"ALL":$currow["allowed"]).")";
                echo "</a>";
            }
            echo "</p>".PHP_EOL;
        }
        if($ug==0)echo "<a href='editproblem.php?id=0'>New</a>";
    }
    
?>
    

<?php require("footer.php");?>