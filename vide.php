<?php 
    require './data/connect.php';

$reqSQLDelete =$bd->prepare("TRUNCATE TABLE dressup_vente");
$rstDlt = $reqSQLDelete->execute();

if($rstDlt){
    header("Location: gestionVente.php");
}
?>