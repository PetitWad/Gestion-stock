<?php 
    require './data/connect.php';
$codebarre = intval($_GET['barcode']);

$reqSQLDelete =$bd->prepare("DELETE FROM dressup_stock WHERE code_barre = :code");
$rstDlt = $reqSQLDelete->execute([
    'code'=>$codebarre
]);

if($rstDlt){
    header("Location: rapport.php");
}
?>