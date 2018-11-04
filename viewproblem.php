<?php require("header.php");?>

<br>
<?php
    
    if(!isset($_GET["id"])){
        header("Location:problem.php");
        exit();
    }
    
    $code="";
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $code=$_POST["code"];
        if($code!=""){
            header("Location:message.php?s=Submit seccessfully~!");
            include("function.php");
            $tim=date("Y/m/d H:i:s");
            create_dir("./usercode/".$_GET["id"]."/".$_SESSION["id"]);
            write_file("./usercode/".$_GET["id"]."/".$_SESSION["id"]."/".$tim.".cpp",false,$code);
            write_file("./usercode/".$_GET["id"]."/".$_SESSION["id"]."/latest.cpp",false,$code);
            write_file("./usercode/".$_GET["id"]."/".$_SESSION["id"]."/latesttime.txt",false,$tim);
            write_file("./usercode/".$_GET["id"]."/".$_SESSION["id"]."/record.txt",true,$tim.PHP_EOL);
            write_file("./usercode/".$_GET["id"]."/record.txt",true,$_SESSION["username"]."=".$tim.PHP_EOL);
        }
        else header("Location:message.php?s=Failed to submit! Code is empty!");
    }
    
    include("conn.php");
    $id=$_GET["id"];
    $prob_query=mysqli_query($conn,"select * from problem where id=$id limit 1");
    if(mysqli_num_rows($prob_query)==0){
        echo "Invalid ID.";
        exit();
    }
    $prob=mysqli_fetch_array($prob_query,MYSQLI_ASSOC);
    if(!((($prob["allowed"]==$_SESSION["usergroup"]||$prob["allowed"]==0)&&$prob["open"]==1)||($_SESSION["usergroup"]==0))){
        echo "You have no authority.";
        exit();
    }
    
    $title=$prob["title"];
    $timlim=$prob["timlim"];
    $memlim=$prob["memlim"];
    $descript=$prob["descript"];
    $input=$prob["input"];
    $output=$prob["output"];
    $sampin=$prob["sampin"];
    $sampout=$prob["sampout"];
    $hint=$prob["hint"];
    
?>

<h1><?php if(isset($_GET["contest"])) echo "' ".$_GET["contest"]." ': "; echo $title; ?></h1>
<p>Time:<?php echo $timlim; ?>s Memory:<?php echo $memlim; ?>MB</p>
<h2>Description</h2>
<p><?php echo str_replace("\r","<br>",$descript)?:"NONE"; ?></p>
<h2>Input</h2>
<p><?php echo str_replace("\r","<br>",$input)?:"NONE"; ?></p>
<h2>Output</h2>
<p><?php echo str_replace("\r","<br>",$output)?:"NONE"; ?></p>
<h2>Sample Input</h2>
<p><?php echo str_replace("\r","<br>",$sampin)?:"NONE"; ?></p>
<h2>Sample Output</h2>
<p><?php echo str_replace("\r","<br>",$sampout)?:"NONE"; ?></p>
<h2>Hint</h2>
<p><?php echo str_replace("\r","<br>",$hint)?:"NONE"; ?></p>
<br>

<script>
    function showAndHide(){
        if(document.getElementById("sc").style.display!="none")document.getElementById("sc").style.display="none";
        else document.getElementById("sc").style.display="block";
    }
</script>
<a href="#" onclick="showAndHide()">Submit Code</a>
<p style="color: red;"><?php
if(is_dir("./usercode/".$_GET["id"]."/".$_SESSION["id"])){
    $tf=fopen("./usercode/".$_GET["id"]."/".$_SESSION["id"]."/latesttime.txt","r");
    $tim = fread($tf,filesize("./usercode/".$_GET["id"]."/".$_SESSION["id"]."/latesttime.txt"));
    fclose($tf);
    echo "Latest Submission: ".$tim;
}
else{
    echo "You have not submited any code.";
}
?></p>
<form id="sc" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" style="display: none;">
    <p>
        <textarea name="code" value="" autocomplete="off" rows="20" cols="80"></textarea>
    </p>
    <p>
        <input type="submit" name="submit" value="  Submit  " autocomplete="off"/>
    </p>
</form>

<?php require("footer.php");?>