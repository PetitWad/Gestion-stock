<?php 
session_start();
    require './data/connect.php';
    require './FonctionSQL.php';

    $table_stock = "dressup_stock";
    $nbr_aff = $_SESSION['nbr_aff'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
	<link rel="manifest" href="favicon/site.webmanifest">
	<link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
    <title>Dress'up | Print All</title>
</head>
<body onload="window.print()">
   <div class="container">
    <div class="row">
        <div class="col-12">
            <img src="images/logo_dressup.jpg" alt="">
        <table class="step table table-bordered table-sm table-striped">
                <thead  class="table-primary">
                    <th scope="col">Barre code</th>
                    <th scope="col">Pouces</th>
                    <th scope="col">catégorie</th>
                    <th scope="col">Texture</th>
                    <th scope="col">Qnt Initial</th>
                    <th scope="col">Qnt Restant</th>
                    <th scope="col">Dâte Enregistrer</th>
                </thead>
                <tbody>
                    <?php
                        if(isset($nbr_aff )){
                            FonctionSQL::Max_lister_Stock_rapport_print($table_stock, $nbr_aff);
                        }
                     
                      ?> 
                </tbody> 
            </table>

        </div>
    </div>
   </div> 
</body>
</html>

<style>
     a{ text-decoration: none; }
     img {
        margin-top: 20px;
        margin-bottom: 20px;
        margin-left: 50px;
        height: 100px;
        width: 400px;
     }
</style>