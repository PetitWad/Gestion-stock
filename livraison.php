<?php 
    require './data/connect.php';
    require './FonctionSQL.php';

    $date_vente2 = date('Y-m-d');

        $reqLister = "SELECT * FROM dressup_vente WHERE date_vente = :dateVente ORDER BY id DESC";
        $stateLister = $bd->prepare($reqLister);
        $stateLister->execute([
            'dateVente'=>$date_vente2
        ]);

        $allRow = $stateLister->fetchAll();   



    if(isset($_POST['code_barre'])){

        $codeInput = $_POST['code_barre'];
        // verification code barre dans la base
        $reqLister = "SELECT * FROM dressup_stock WHERE code_barre = :code ORDER BY id DESC";
        $stateLister = $bd->prepare($reqLister);
        $stateLister->execute([
            ':code'=>$codeInput
        ]);
      
        foreach($stateLister->fetchAll() as $rowSelect){
            $qnt_restant = $rowSelect['qnt_restant'];
            $codeBar = $rowSelect['code_barre'];
            $pouces = $rowSelect['pouces'];
            $categorie = $rowSelect['categorie']; 
            $texture = $rowSelect['texture']; 
        }

  
        if($codeBar == null){
            header("Location: livraison.php?error= Barre code n'existe pas ⛔"); 
        }else{
             $qnt = $qnt_restant;
             $qnt = $qnt_restant - 1;
             $req = 'UPDATE dressup_stock SET qnt_restant = :qnt WHERE code_barre = :code';
             $stateUpdate = $bd->prepare($req);
             $stateUpdate->bindParam(':qnt', $qnt);
             $stateUpdate->bindParam(':code', $codeBar);

             if($stateUpdate->execute()){
                 // Insertion de la table vente
                 $date_vente = date('d-M-y | H:i:s');
                 $reqVente = $bd->prepare("INSERT INTO dressup_vente VALUES(null, :code_barre, :categorie, :texture, :pouces, :date__, :date_vente)");
                 $reqVente->bindParam(':code_barre', $codeBar); 
                 $reqVente->bindParam(':categorie', $categorie); 
                 $reqVente->bindParam(':texture', $texture); 
                 $reqVente->bindParam(':pouces', $pouces);
                 $reqVente->bindParam(':date__', $date_vente);
                 $reqVente->bindParam(':date_vente', $date_vente2);
                 $reqVente->execute();
             }            
             header("Location: livraison.php?msg= la vente est effectuée ✔ ");
         }

}
   

?>


<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo_dress.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
	<link rel="manifest" href="favicon/site.webmanifest">
	<link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
    <title>Livraison | Dress'up</title>
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
            <div class="col-12 content">
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
                        <div class="col-9">
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
                       <h5 class="alert alert-primary" style="text-align: center;">VENTE JOURNALIER | <?=date('d-M-Y')?></h5><hr>
                    </div>
                    <div class="col"></div>
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
        margin-top: 7%;
    }

    .bar_filtre{
        margin-left: 140px;
    }

    .btn-filtre{
        margin-left: -25px;
    }


</style>
