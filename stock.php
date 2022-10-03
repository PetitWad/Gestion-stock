<?php 
    require './data/connect.php';

    if(isset($_POST['submit'])){
        $barcode = $_POST['barcode'];
        $texture = $_POST['texture'];
        $categorie = $_POST['categorie'];
        $qnt = $_POST['quantite'];
        $pouces = $_POST['pouces'];
        $date_enregistre = date('d-M-y | H:i');

    //verification code barre identique
    $reqLister = "SELECT code_barre FROM dressup_stock WHERE code_barre = :code";
    $stateLister = $bd->prepare($reqLister);
    $stateLister->execute([
        'code'=>$barcode
    ]);

    $rslt = $stateLister->fetch();

        $req = $bd->prepare("INSERT INTO dressup_stock VALUES(null, :code_barre, :categorie, :texture, :pouces, :qnt_initial, :qnt_restant, :date__)");

        $req->bindParam(':code_barre', $barcode); 
        $req->bindParam(':categorie', $categorie); 
        $req->bindParam(':texture', $texture); 
        $req->bindParam(':qnt_initial', $qnt); 
        $req->bindParam(':qnt_restant', $qnt); 
        $req->bindParam(':pouces', $pouces);
        $req->bindParam(':date__', $date_enregistre);

        if($rslt == true){
            header("Location: stock.php?error= Ce code barre est déjà exister 🚫");
        }else{
            $req->execute();
            header("Location: stock.php?msg=Enregistrement effectuer ✔");
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
        <div class="row">
            <div class="col-3">
                <?php require 'dashboard.php' ?>
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-9">
                        <img src="./images/stock.jpg" alt="image stock">
                        <form action="stock.php" method="POST">
                            <div class="col-12">
                                <div class="row">
                                   <?php if(isset($_GET['msg'])){ ?>
                                         <strong><p class="text-success"> <?= $_GET['msg'] ?></p></strong>
                                    <?php }elseif(isset($_GET['error'])){ ?>
                                        <strong><p class="text-danger"> <?= $_GET['error'] ?></p></strong>
                                    <?php } ?>
                                    <div class="row">
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label for="Barre code">Barre code</label>
                                            <input  type="text" class="form-control" name="barcode" placeholder="Code Barre" required>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                        <div class="mb-2">
                                                <label for="Categorie">Catégorie</label>
                                                <select class="form-select" aria-label="Default select" name="categorie" id="" required>
                                                    <option value="Lace Frontal">Lace Frontal</option>
                                                    <option value="Full Lace">Full Lace</option>
                                                    <option value="T-lace">T-lace</option>
                                                    <option value="Lace 360 degré">Lace 360 degré </option>
                                                    <option value="Closure 1x6">Closure 1x6</option>
                                                    <option value="Closure 4x4">Closure 4x4</option>  
                                                    <option value="Pixie 13x1">Pixie 13x1</option>
                                                    <option value="Pixie T-lace">Pixie T-lace</option>
                                                    <option value="Pixie Frontal">Pixie Frontal</option>
                                                </select>     
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label for="Categorie">Texture</label>
                                                <select class="form-select" aria-label="Default select" name="texture" id="" required>
                                                    <option value="Straight">Straight</option>
                                                    <option value="Body Wave">Body Wave</option>
                                                    <option value="Jerry Curly">Jerry Curly</option>
                                                    <option value="Kinky Curly">Kinky Curly</option>
                                                    <option value="Deep Curly">Deep Curly</option>
                                                </select>     
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                        <div class="mb-2">
                                                <label for="prix">Pouces</label>
                                                <input type="text" class="form-control" name="pouces" placeholder="Pouces" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                        <div class="mb-2">
                                                <label for="Quantite">Quantité</label>
                                                <input type="number" class="form-control" name="quantite" placeholder="Quantité" required>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <input type="submit" name="submit" class="btn btn-primary" value="Enregistrer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<style>
    form{
        margin-top: 17%;
        padding-top: 80px;
        padding-bottom: 40px;
        padding-left: 40px;
        padding-right: 20px;
        box-shadow: 2px 2px 3px 1px black;
    }

  img{
    position: fixed;
    left: 655px;
    top: 48px;
    width: 150px;
    }
</style>
