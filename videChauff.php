<?php 
    require './data/connect.php';

$reqSQLDelete =$bd->prepare("TRUNCATE TABLE chauffeur");
$rstDlt = $reqSQLDelete->execute();

if($rstDlt){
    header("Location: gestionVente.php");
}
?>