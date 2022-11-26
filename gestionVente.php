<?php 
// session_start();
    require './data/connect.php';
    require './FonctionSQL.php';

        $reqLister = "SELECT * FROM dressup_vente ORDER BY id DESC";
        $stateLister = $bd->prepare($reqLister);
        $stateLister->execute();
        $allSelect = $stateLister->fetchAll();

        // Livraison chauffeur
        $reqListerChauff = "SELECT * FROM chauffeur ORDER BY id DESC";
        $stateListerChauff = $bd->prepare($reqListerChauff);
        $stateListerChauff->execute();
        $allSelectChauff = $stateListerChauff->fetchAll();


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
                <?php 
                require 'dashboard.php'
                 ?>
            </div>
            <div class="col-1"></div>
            <div class="col-10">
                <div class="row">
                    <div class="col-12"><h2>Gestion Livraison et de Retour</h2></div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="step table table-bordered table-sm table-striped">
                            <span> Fil d'attent de vente Dress'up <i class="bi bi-cart3"></i></span>
                            <thead  class="table-primary">
                                <tr>
                                    <th scope="col">Code</th>
                                    <th scope="col">Pouces</th>
                                    <th scope="col">catégorie</th>
                                    <th scope="col">Texture</th>
                                    <th scope="col">Dâte</th>
                                    <th scope="col">Retour</th>
                                </tr>   
                            </thead>
                            <tbody> 
                            <?php foreach($allSelect as $rowSelect){ ?>
                                <tr>
                                    <td><?= $rowSelect['code_barre'] ?></td>
                                    <td><?= $rowSelect['pouces'] ?></td>
                                    <td><?= $rowSelect['categorie'] ?></td>
                                    <td><?= $rowSelect['texture'] ?></td>
                                    <td><?= $rowSelect['date__'] ?></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="retour.php?dateVente=<?php echo $rowSelect['date__']?>"><i class="bi bi-x"></i></a></td>
                                </tr>
                            <?php }?>
                            </tbody> 
                        </table>
                        <a class="btn btn-success" href="vide.php">Valider les ventes</a>
                    </div>
                </div>
            </div> <!-- fin div container principal -->
        </div>
    </div>



    <div class="container-fluid tableau-deux">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <table class="step table table-bordered table-sm table-striped">
                            <span> Fil d'attent de vente Chauffeur<i class="bi bi-cart3"></i></span>
                            <thead  class="table-primary">
                                <tr>
                                    <th scope="col">Code</th>
                                    <th scope="col">Pouces</th>
                                    <th scope="col">catégorie</th>
                                    <th scope="col">Texture</th>
                                    <th scope="col">Dâte</th>
                                    <th scope="col">Retour</th>
                                </tr>   
                            </thead>
                            <tbody> 
                            <?php foreach($allSelectChauff as $rowSelectChauff){ ?>
                                <tr>
                                    <td><?= $rowSelectChauff['code_barre'] ?></td>
                                    <td><?= $rowSelectChauff['pouces'] ?></td>
                                    <td><?= $rowSelectChauff['categorie'] ?></td>
                                    <td><?= $rowSelectChauff['texture'] ?></td>
                                    <td><?= $rowSelectChauff['date__'] ?></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="retourChauff.php?dateVente=<?php echo $rowSelectChauff['date__']?>"><i class="bi bi-x"></i></a></td>
                                </tr>
                            <?php }?>
                            </tbody> 
                        </table>
                        <a class="btn btn-success" href="videChauff.php">Valider les ventes</a>
                    </div>
                    <div class="col-1"></div>
                </div>
            </div> <!-- fin div container principal -->
        </div>



</body>
</html>

<style>
 table{
    margin-left: 20px ;
 }

td a{
    text-decoration: none;
    font-size: 20px;
    color: red;
}

.tableau-deux{
    margin-top: 80px;
}

span{
    font-size: 18px;
}

h2{
    margin: 40px 10px;
}



</style>
