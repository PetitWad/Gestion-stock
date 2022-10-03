<?php 
    require './data/connect.php';

    if(isset($_POST['code_barre'], $_POST['nbr_article'])){
        $barcode = $_POST['code_barre'];
        $nbrArticle = $_POST['nbr_article'];
        $panier = array();

        array_push($panier, $barcode, $nbrArticle);
                
        
    // verification code barre identique
    $reqLister = "SELECT * FROM dressup_stock WHERE code_barre = :code";
    $stateLister = $bd->prepare($reqLister);
    $stateLister->execute([
        'code'=>$barcode,
    ]);
    
    foreach($stateLister->fetchAll() as $rowSelect){
      $quantite = $rowSelect['quantite'];
      $categorie = $rowSelect['categorie']; 
    }
    
    var_dump($quantite);
    exit();

  
    if($quantite == 0){
        header("Location: stock.php?error= Stock $categorie est inferieure à zéro ");
        // header("Location: vente.php?error= Stock $categorie est inferieure à zéro ");
    }else{
        $qnt = $quantite -1;
        $req = 'UPDATE dressup_stock SET quantite = :qnt WHERE code_barre = :code';
        $stateUpdate = $bd->prepare($req);
        $stateUpdate->bindParam(':qnt', $qnt);
        $stateUpdate->bindParam(':code', $barcode);
        $stateUpdate->execute();
    }

}
   

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Stock | Dress'up</title>
</head>
<body>
    <div class="container-fluid">
    <!-- <img style="width: 150px; position:relative; bottom: 130px; left: 330px" src="./images/vente.png" alt=""> -->
        <div class="row">
            <div class="col-3">
                <?php require 'dashboard.php' ?>
            </div>
            <div class="col-9 content">
                <div class="row">
                    <div class="col-6">
                        <form action="./vente.php" method="POST">
                            <div class="row">
                                <div class="col-7">
                                    <label for="">Code barre</label>
                                    <div class="mb-2"> <input type="text" name="code_barre" class="form-control" placeholder="Scanner code barre"></div>
                                </div>
                                <div class="col-5">
                                    <label for="">Quantité article</label>
                                    <div class="mb-2"> <input type="number" name="nbr_article" class="form-control" value="1"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6"><button class="btn btn-primary" name="push_panier"><i class="bi bi-cart3"></i> Ajouter au panier</button> </div>
                            </div>
                            
                        </form>
                            <?php if(isset($_GET['error'])){ ?>
                                <strong><p class="text-danger"> <?= $_GET['error'] ?></p></strong>
                            <?php } ?>
                    </div>
                    <div class="col-6"></div>
                </div>
            </div>   
        </div>
    </div>
</body>
</html>

<style>
    .content{
        margin-top: 12%;
    }

</style>
