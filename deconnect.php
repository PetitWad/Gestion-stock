<?php  
if(isset($_GET['logout']))
{
    $logout = $_GET['logout'];
    if($logout == 0){
        session_destroy();
        header("Location: index.php");
    }
}    
?>