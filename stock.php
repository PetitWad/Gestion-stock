<?php 
    require './data/connect.php';

    if(isset($_POST['stock']) || isset($_POST['small_storage'])){

        $stock = $_POST['stock'];
        $small_storage = $_POST['small_storage'];

            if($stock){
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
            }elseif($small_storage){
                //Verifier si le stock est sup a zerp
                header("Location: stock.php?msg=Migration to storage has successfull ✔");
            }else{
                header("Location: stock.php?msg=Please make the submit ");
            }   
    }

    if(isset($_POST['code_update'])){

        $code_update = $_POST['code_update'];

        //verification code barre identique pour modification
        $reqLister = "SELECT code_barre FROM dressup_stock WHERE code_barre = :code";
        $stateLister = $bd->prepare($reqLister);
        $stateLister->execute([
            'code'=>$code_update
        ]);

        foreach($stateLister->fetchAll() as $rowUpdate){
            $code = $rowUpdate['code_barre'];
        }

       if($code_update == $code){
        header("Location: modifier.php?code_update=".$code);
       }else{
        header("Location: stock.php?msgCodeUpdate= Barrecode est Invalid");
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
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
	<link rel="manifest" href="favicon/site.webmanifest">
	<link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<meta name="theme-color" content="#ffffff">    <title>Stock | Dress'up</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php require 'navbar.php';?>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="">
                <?php require 'dashboard.php' ?>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <img src="./images/stock.jpg" alt="image stock">
                        <form class="form-main" action="stock.php" method="POST">
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
                                                    <option value="Pixie 13x1">closure 1x6 Hl</option>
                                                    <option value="Pixie T-lace"> Frontal Hl</option>
                                                    <option value="Pixie Frontal">Pixie Cut</option>
                                                    <option value="Pixie 13x1">Pixie HI</option>
                                                    <option value="Pixie T-lace">Pixie Cut Curly</option>
                                                    <option value="Pixie Frontal">Pixie 13x1</option>
                                                    <option value="Pixie 13x1">Pixie T-lace 1b30</option>
                                                    <option value="Pixie Frontal">Pixie T-lace 1b27</option>
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
                                                    <option value="Pixie 13x1">Bang st</option>
                                                    <option value="Pixie Frontal">Bang Curly</option>
                                                    <option value="Curly">Curly</option>
                                                    <option value="Show">Show</option>
                                                </select>     
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                        <div class="mb-2">
                                                <label for="prix">Pouces</label>
                                                <input type="text" class="form-control" name="pouces" placeholder="Pouces">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                        <div class="mb-2">
                                                <label for="Quantite">Quantité</label>
                                                <input type="number" class="form-control" name="quantite" placeholder="Quantité" required>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <input type="submit" name="stock" class="btn btn-primary" value="Add to stock">
                                            <!-- <input type="submit" name="small_storage" class="btn btn-secondary" value="Add to small storage"> -->
                                            <!-- <a class="btn btn-secondary" href="small_storage">Add to small storage</a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
        </div>
     </div><br><!-- Fin formulaire -->
    <div class="container-fluid"><!-- Debut modification -->
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <h4 class="alert alert-warning">SCANNER POUR MODIFIER</h4>
                <form action="#" method="POST">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <div class="mb-2">
                                <?php if(isset($_GET['msgCodeUpdate'])){ ?>
                                    <strong><p class="text-danger"> <?= $_GET['msgCodeUpdate'] ?></p></strong>
                                <?php } ?>
                                <input type="text" name="code_update" class="form-control" required="required" placeholder="Scanner pour modifier">
                            </div>
                        </div>
                        <div class="col-4">
                              <button class="btn btn-warning" type="submi">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</body>
</html>

<style>
.form-main{
    margin-top: 13%;
    padding-top: 80px;
    padding-bottom: 40px;
    padding-left: 40px;
    padding-right: 20px;
    box-shadow: 2px 2px 3px 1px black;
}

img{
    position: absolute;
    left: 270px;
    top: 80px;
    width: 150px;
}
h4{text-align: center;}
</style>
