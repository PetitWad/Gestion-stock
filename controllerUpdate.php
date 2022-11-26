<?php 
    require './data/connect.php'; 
    
    $qnt_restant =0;

    $req = 'UPDATE dressup_stock SET categorie =:categorie, texture = :texture, pouces = :pouces, qnt_initial = :qnt_initial, qnt_restant = :qnt_restant WHERE code_barre = :code';
    $stateUpdate = $bd->prepare($req);
    $stateUpdate->bindParam(':code', $_POST['barcode']);
    $stateUpdate->bindParam(':categorie', $_POST['categorie']);
    $stateUpdate->bindParam(':texture', $_POST['texture']);
    $stateUpdate->bindParam(':pouces', $_POST['pouces']);
    $stateUpdate->bindParam(':qnt_initial', $_POST['qnt_initial']);
    $stateUpdate->bindParam(':qnt_restant', $qnt_restant);
    $updateOk= $stateUpdate->execute();

    if($updateOk){
        header("Location: stock.php?msg=Modifier avec succès");
    }
    else{
        header("Location: modifier.php?msg=La modification est echoué");
    }
                