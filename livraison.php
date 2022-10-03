<?php 
    require './data/connect.php';
    require './FonctionSQL.php';

    $date_vente = date('d-M-y | H:');
    $date_vente2 = date('Y-m-d');

        $reqLister = "SELECT * FROM dressup_vente WHERE date_vente = :dateVente";
        $stateLister = $bd->prepare($reqLister);
        $stateLister->execute([
            'dateVente'=>$date_vente2
        ]);

        $allRow = $stateLister->fetchAll();   



    if(isset($_POST['code_barre'])){
        $barcode = $_POST['code_barre'];
        
        // verification code barre identique
        $reqLister = "SELECT * FROM dressup_stock WHERE code_barre = :code";
        $stateLister = $bd->prepare($reqLister);
        $stateLister->execute([
            'code'=>$barcode,
        ]);
    
        foreach($stateLister->fetchAll() as $rowSelect){
        $qnt_restant = $rowSelect['qnt_restant'];
        $codebar = $rowSelect['code_barre'];
        $pouces = $rowSelect['pouces'];
        $categorie = $rowSelect['categorie']; 
        $texture = $rowSelect['texture']; 
        }

  
        if($codebar == null){
            header("Location: livraison.php?error= Barre code n'existe pas ⛔"); 
        }elseif($qnt_restant == 0){
            header("Location: livraison.php?error= Stock $categorie texture $texture de $pouces pouces est inferieure à zéro 🚫");   
        }else{
            $qnt = $qnt_restant - 1;
            $req = 'UPDATE dressup_stock SET qnt_restant = :qnt WHERE code_barre = :code';
            $stateUpdate = $bd->prepare($req);
            $stateUpdate->bindParam(':qnt', $qnt);
            $stateUpdate->bindParam(':code', $barcode);

            if($stateUpdate->execute()){
                // Insertion de la table vente
                $date_vente = date('d-M-y | H:i');
                $reqVente = $bd->prepare("INSERT INTO dressup_vente VALUES(null, :code_barre, :categorie, :texture, :pouces, :date__, :date_vente)");
                $reqVente->bindParam(':code_barre', $barcode); 
                $reqVente->bindParam(':categorie', $categorie); 
                $reqVente->bindParam(':texture', $texture); 
                $reqVente->bindParam(':pouces', $pouces);
                $reqVente->bindParam(':date__', $date_vente);
                $reqVente->bindParam(':date_vente', $date_vente2);

                $reqVente->execute();
                header("Location: livraison.php?msg= Livraison $categorie texture $texture de $pouces pouces est effectué ✔ ");
            }            
            
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
    <title>Livraison | Dress'up</title>
</head>
<body>
    <div class="container-fluid">
    <!-- <img style="width: 150px; position:relative; bottom: 130px; left: 330px" src="./images/vente.png" alt=""> -->
        <div class="row">
            <div class="col-3">
                <?php require 'dashboard.php' ?>
            </div>
            <div class="col-9 content">
                <form action="./livraison.php" method="POST">
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-6">
                            <div class="mb-2"> <input type="text" name="code_barre" class="form-control" placeholder="Scanner code barre"></div>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-primary" name="push_panier">Livrer <i class="bi bi-truck-flatbed"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-10">
                        <center>
                            <?php if(isset($_GET['msg'])){ ?>
                                <strong><p class="text-success"> <?= $_GET['msg'] ?></p></strong>
                            <?php }elseif(isset($_GET['error'])){ ?>
                                <strong><p class="text-danger"> <?= $_GET['error'] ?></p></strong>
                            <?php } ?>
                        </center>
                        </div>
                        <div class="col"></div>
                    </div>
                </form>
                <div class="row mt-4">
                    <div class="col"></div>
                    <div class="col-10">
                       <h5 class="alert alert-primary" style="text-align: center;">LISTE VENTE POUR CE JOUR | <?=date('d-M-Y')?></h5><hr>
                    </div>
                    <div class="col"></div>
                </div>
                <div class="row bar_filtre">
                <form action="#" method="POST">
                    <div class="row">
                        <div class="col-2">
                            <div class="mb-2"> 
                                <select style="padding-right: 10px; width: 70px;" name="nbr_aff" class="form-select" aria-label="Default select"> 
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="75">75</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-2 btn-filtre"><input class="btn btn-primary" type="submit" value="Filtrer"></div>
                        <div class="col-8"></div>
                    </div>
                </form>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <table class="step table table-bordered table-sm table-striped">
                            <thead  class="table-primary">
                                <th scope="col">Pouces</th>
                                <th scope="col">catégorie</th>
                                <th scope="col">Texture</th>
                                <th scope="col">Dâte</th>
                            </thead>
                            <tbody>
                            <?php if(isset($_POST['nbr_aff']) == false){ foreach($allRow as $rowSelect):?>
                            <tr>
                                <td><?= $rowSelect['pouces'] ?></td>
                                <td><?= $rowSelect['categorie'] ?></td>
                                <td><?= $rowSelect['texture'] ?></td>
                                <td><?= $rowSelect['date__'] ?></td>
                            </tr>
                            <?php endforeach; }else{?>
                            <?php 
                                $table_vente = 'dressup_vente';
                                $nbr = intval($_POST['nbr_aff']);
                                FonctionSQL::Max_lister_Vente($table_vente, $nbr);
                              }?>
                        </tbody> 
                        </table>
                    </div>
                    <!-- <div class="col-7"></div> -->
                </div>
            </div>
                </div>
            </div>   
        </div>
    </div>
</body>
</html>

<style>
    .content{
        margin-top: 10%;
        margin-left: -18px;
    }

    .bar_filtre{
        margin-left: 140px;
    }

    .btn-filtre{
        margin-left: -25px;
    }


</style>
