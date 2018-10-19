<?php
    echo "<p>";
    if(isset($_GET["s"])){
        echo $_GET["s"];
    }
    else{
        echo "NONE";
    }
    echo "</p>";
    echo '<a href="#" onclick="javascript:history.back(-1);">Back</a>';
?>