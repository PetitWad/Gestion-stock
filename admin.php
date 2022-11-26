<?php 
   require 'data/connect.php';
   require 'FonctionSQL.php';


       // verification code barre identique
$reqLister = "SELECT * FROM dressup_stock WHERE qnt_restant > 0 ORDER BY id DESC ";
$stateLister = $bd->prepare($reqLister);
$stateLister->execute();
    
$allRow = $stateLister->fetchAll();

//Requete SQl qui lister la somme des stock dispo
$req = "SELECT SUM(qnt_initial) as stock_initial, MAX(date__) as derniere_date,  SUM(qnt_restant) as en_stock  FROM dressup_stock ORDER BY id DESC";
$state = $bd->prepare($req);
$state->execute();
$reslt = $state->fetch();
    


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
    <link rel="shortcut icon" type="image/x-icon" href="images/logo_dress.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
	<link rel="manifest" href="favicon/site.webmanifest">
	<link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
    <title>Accueil | Dress'up</title>
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
                <!-- <center> -->
                <div class="row blok-img">
                    <div class="col-4 card"> 
                        <div class="text">
                            <strong> Stock initial </strong>
                            <p><?=$reslt['stock_initial']?> cheveux en stock Depuis le <?=$reslt['derniere_date']?></p>
                        </div>
                    </div>
                    <div class="col-4 card"> 
                        <div class="text">
                            <strong> En stock </strong>
                            <p><?=$reslt['en_stock']?> cheveux en stock</p>
                        </div>
                    </div>
                    <div class="col-4 card">
                        <div class="text">
                            <strong> Livraison Total | <?=$reslt['stock_initial'] - $reslt['en_stock']?></strong>
                            <p><?=$reslt['derniere_date']?></p>
                        </div>
                    </div>
                </div>
                <!-- </center> -->
                <form action="./index.php" method="POST">
                    <div class="row bar_filtre">
                        <div class="col-1">
                            <div class="mb-2">
                                <select style="padding-right: 10px; width: 70px;" name="nbr_aff" class="form-select" aria-label="Default select" > 
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="75">75</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-2"><input class="btn btn-primary" type="submit" value="Filtrer"></div>
                        <div class="col-8"></div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-10">
                        <table class="step table table-bordered table-sm table-striped">
                            <thead  class="table-primary">
                                <th scope="col">Pouces</th>
                                <th scope="col">catégorie</th>
                                <th scope="col">Texture</th>
                                <th scope="col">Quantité en stock</th>
                                <th scope="col">Dâte</th>
                            </thead>
                            <tbody> 
                        <?php if(isset($_POST['nbr_aff']) == false){ foreach($allRow as $rowSelect):?>
                            <tr>
                                <td><?= $rowSelect['pouces'] ?></td>
                                <td><?= $rowSelect['categorie'] ?></td>
                                <td><?= $rowSelect['texture'] ?></td>
                                <td><?= $rowSelect['qnt_restant'] ?></td>
                                <td><?= $rowSelect['date__'] ?></td>
                            </tr>
                        <?php endforeach; }else{?>
                            <?php 
                                $table_stock = 'dressup_stock';
                                $nbr = intval($_POST['nbr_aff']);
                                FonctionSQL::Max_lister_Stock($table_stock, $nbr);
                              }?>
                             </tbody> 
                        </table>
                    </div>
                    <!-- <div class="col-7"></div> -->
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<style>
    .blok-img{
        display: flex;
        justify-content: space-around;
        margin-top: 20px;
    
    }

    .card{
        padding-top: 20px;
        height: 200px;
        width: 260px;
        margin-right: 25px;
        box-shadow: 2px 1px 2px 1px black;
        text-align: center;
        font-weight: bold;
    }

    .card:nth-child(1){
       background-image: url(./images/1.jpeg);
       background-position-x: center;
       background-size: cover;

    }

    .card:nth-child(1) strong{
       color: blue;
       font-size: 25px;
    }

    .text{
        text-align: center;
        margin-top: 20px;
        height: 90px;
        background: rgba(0, 0, 0, 0.5);
        border-radius: 7px;
    }
    p{color: white;}

    .card:nth-child(2){
       color: blue;
       background-image: url('./images/2.jpeg');
       background-repeat: none;
       background-size: cover;
       background-position-x: center;
    }

    .card:nth-child(2) strong{
       color: green;
       font-size: 25px;
    }

    .card:nth-child(3){
       color: orange;
       background-image: url('./images/3.jpeg');
       background-repeat: none;
       background-size: cover;
       background-position-x: center;
    }

    .card:nth-child(3) strong{
        font-size: 22px;
       color: orange;

    }

    table{
        position: relative;
        left: 110px;
        top: 50px;
    }

    .bar_filtre{
        position: relative;
        top: 50px;
        margin-left: 100px;
    }

    a{
        text-decoration: none;
    }


@media only screen and (max-width: 1154px) {

    .card{
      width: 220px;
    }

    .card:nth-child(1), .card:nth-child(2), .card:nth-child(3){
      margin-left: 2px;
    }


}
@media only screen and (max-width: 990px) {
    *{
        font-size: 16px;
    }

    .card{
       position: relative;
       left: 5px;
       width: 200px;
    }


    table{
        position: relative;
        left: 50px;
    }


}

</style>