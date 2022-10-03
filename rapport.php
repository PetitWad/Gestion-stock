<?php session_start();
    require './data/connect.php';
    require './FonctionSQL.php';

    $table_stock = "dressup_stock";

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
    <title>Rapport | Dress'up</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <?php require './dashboard.php'; ?>
            </div>
            <div class="col-8 section-deux">
                <div class="row form-recheche">
                    <div class="col"></div>
                    <div class="col-8">
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
                    <div class="col"></div>
                </div>
                <div class="row">
                    <div class="col-4">
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
                            <div class="col-2 btn-filtre"><input class="btn btn-primary" name="filtre" type="submit" value="Filtrer"></div>
                            <div class="col-2 btn-print"><a href="print_all.php?" class="btn btn-primary">Print</a></div>
                        </div>
                    </form>
                    </div>
                </div>
            <table class="step table table-bordered table-sm table-striped">
                <thead  class="table-primary">
                    <th scope="col">Barre code</th>
                    <th scope="col">Pouces</th>
                    <th scope="col">catégorie</th>
                    <th scope="col">Texture</th>
                    <th scope="col">Qnt Initial</th>
                    <th scope="col">Qnt Restant</th>
                    <th scope="col">Dâte Enregistrer</th>
                    <th scope="col">Delete</th>
                </thead>
                <tbody>
                    <?php
                        if(isset($_POST['nbr_aff'], $_POST['filtre'])){
                            $nbr_aff = intval($_POST['nbr_aff']);
                            $_SESSION['nbr_aff'] = $nbr_aff;
                            FonctionSQL::Max_lister_Stock_rapport($table_stock, $nbr_aff);
                        }
                     
                      ?> 
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

</style>
