<?php
    require './data/connect.php';
    require './FonctionSQL.php';
    
    $reqSQL = "SELECT * FROM dressup_stock ORDER BY id DESC";
    $revenuStatement = $bd->prepare($reqSQL);
    $revenuStatement->execute();
    $rowReqAll = $revenuStatement->fetchAll();

    $table_stock = "dressup_stock";


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
	<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
	<link rel="manifest" href="favicon/site.webmanifest">
	<link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">    <title>Rapport | Dress'up</title>
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
                <?php require './dashboard.php'; ?>
            </div>
            <div class="col-1"></div>
            <div class="col-10 section-deux">
                <div class="row form-recheche">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="col-10">
                                    <input type="text" name="var_search" class="form-control" placeholder="Scanner pour rechercher">
                                </div>
                                <div class="col-2">
                                    <input type="submit" name="search" class="btn btn-primary" value="Search">
                                </div>
                            </div>
                        </form>
                        <?php if(isset($_POST['search'], $_POST['var_search']) && !empty($_POST['var_search'])){ ?>
                            <table class="step table table-bordered table-sm table-striped mt-4 tabSearch">
                                <thead  class="table-primary">
                                    <th scope="col">Barre code</th>
                                    <th scope="col">Pouces</th>
                                    <th scope="col">catégorie</th>
                                    <th scope="col">Texture</th>
                                    <th scope="col">Qnt Initial</th>
                                </thead>
                                <tbody>
                                    <?php FonctionSQL::Rechercher($_POST['var_search'])  ?> 
                                </tbody> 
                            </table>
                        <?php } ?>
                    </div>
                <div class="col-1"></div>
            </div>
            <div class="col-1"></div>
            <table class="step table table-bordered table-sm table-striped">
                <thead  class="table-primary">
                    <th scope="col">Barre code</th>
                    <th scope="col">Pouces</th>
                    <th scope="col">catégorie</th>
                    <th scope="col">Texture</th>
                    <th scope="col">Qnt Initial</th>
                    <th scope="col">Qnt Restant</th>
                    <!-- <th scope="col">Vente suplus</th> -->
                    <th scope="col">Dâte Enregistrer</th>
                    <th scope="col">Delete</th>
                </thead>
                <tbody>  
                    <?php foreach($rowReqAll as $rowReq){ 
                            $lien_desc = "desc_produit.php?barcode= ".$rowReq ['code_barre'];
                            $lien_del = "delete.php?barcode= ".$rowReq['code_barre'];
                    ?>  
                    <tr>
                        <th scope="col"><a href="<?= $lien_desc ?>"> <?=$rowReq ['code_barre'] ?></a></th>
                        <th scope="col"> <?=$rowReq ['pouces']?></th>
                        <th scope="col"><?=$rowReq ['categorie']?></th>
                        <th scope="col"><?=$rowReq ['texture']?></th>
                        <th scope="col"><?=$rowReq ['qnt_initial']?></th>  
                         <th scope="col"><?=$rowReq ['qnt_restant']?></th>
                        <th scope="col"><?=$rowReq ['date__']?></th>
                        <th scope="col">&nbsp;&nbsp;&nbsp;&nbsp;<a class="color:red" href="<?=$lien_del?>"><i class="bi bi-trash-fill"></i></a></th>
                    </tr>
                    <?php }?>
                    <div class="col-2 btn-print print_stock"><a href="print_all.php" class="btn btn-primary">Print</a></div>
                </tbody> 
            </table>
            </div>
            </div>
        </div>
    </div>
</body>
</html>

<style>
    .section-deux{
       position: relative;
       top: 100px;
    }

    .form-recheche{
        margin-bottom: 50px;
    }
    .btn-filtre{
        position: relative;
        left: 30px;
    }

    .btn-print{
        position: relative;
        left: 50px;
    }

    a{ text-decoration: none; }
    a i{ color: red; }

    .print_stock{
        position: relative;
        bottom: 5px;
        left: 92%;
    }


</style>
