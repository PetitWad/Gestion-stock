<?php 
require './data/connect.php';
  $code = intval($_GET['barcode']);
// Requete SQL qui donner les details du produit en question
  $reqListerStock = "SELECT * FROM dressup_stock WHERE code_barre = :code";
  $stateListerstock = $bd->prepare($reqListerStock);
  $stateListerstock->execute([
      'code'=>$code
  ]);

  $rslt = $stateListerstock->fetch();

  //Requete SQL qui affiche les livraison du produit en question
  $reqLister = "SELECT * FROM dressup_vente WHERE code_barre = :code ";
  $stateLister = $bd->prepare($reqLister);
  $stateLister->execute([
      'code'=>$code
  ]);

  $allRow = $stateLister->fetchAll();
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
    <title>Description Produit | Dress'up</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <?php require './dashboard.php'; ?>
            </div>
            <div class="col-8 section">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-2-4 alert alert-secondary">
                            <h6><strong class="text-danger">Details du produit</strong> | <?= $rslt['code_barre']?> <br> <?= $rslt['pouces']."\" ".$rslt['categorie']." ".$rslt['texture']." <br>"?> <span class="text-primary">Quantite initial = <?=$rslt['qnt_initial']?></span> <span class="text-danger">Quantite Restant = <?=$rslt['qnt_restant']?></span> <span style="float:right; position:relative; bottom: -20px">Date enregistement <?= $rslt['date__']?></span></h6>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <table class="step table table-bordered table-sm table-striped">
                            <thead  class="table-primary">
                                <th scope="col">Pouces</th>
                                <th scope="col">catégorie</th>
                                <th scope="col">Texture</th>
                                <th scope="col">Dâte Livraison</th>
                            </thead>
                            <tbody>
                            <?php if(isset($_POST['nbr_aff']) == false){ foreach($allRow as $rowSelect):?>
                            <tr>
                                <td><?= $rowSelect['pouces'] ?></td>
                                <td><?= $rowSelect['categorie'] ?></td>
                                <td><?= $rowSelect['texture'] ?></td>
                                <td><?= $rowSelect['date__'] ?></td>
                            </tr>
                            <?php endforeach; }?>
                        
                        </tbody> 
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<style>

    .section{
        position: relative;
        top: 120px;
    }
    h6{
        padding-left: 50px;
    }
</style>

