<?php 
    require './data/connect.php';
$dateVente = $_GET['dateVente'];

//@SQL requete qui  pour recupere le codebare avant delete
$reqSQLcode ="SELECT * FROM chauffeur WHERE date__ = :dateVente";
$stateCode = $bd->prepare($reqSQLcode);
$stateCode->execute([
    'dateVente'=>$dateVente
]);
$selectRow = $stateCode->fetch();
$code = $selectRow['code_barre'];


//@SQL requete qui permet de delete 
$reqSQLDelete =$bd->prepare("DELETE FROM chauffeur WHERE date__ = :dateVente");
$rstDlt = $reqSQLDelete->execute([
    ':dateVente'=>$dateVente
]);

if($rstDlt){
    //@SQL requete qui  pour recupere le codebare avant delete
    $reqSQLcode ="SELECT qnt_restant FROM dressup_stock WHERE code_barre = :code";
    $stateCode = $bd->prepare($reqSQLcode);
    $stateCode->execute([
        'code'=>$code
    ]);
        $row = $stateCode->fetch();
        $qnt_restant = $row['qnt_restant'];

        $qnt = $qnt_restant + 1;
        $req = 'UPDATE dressup_stock SET qnt_restant = :qnt WHERE code_barre = :code';
        $stateUpdate = $bd->prepare($req);
        $stateUpdate->bindParam(':qnt', $qnt);
        $stateUpdate->bindParam(':code', $code);
        $stateUpdate->execute();

    header("Location: gestionVente.php");
}


?>