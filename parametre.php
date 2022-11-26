<?php
require './data/connect.php';
    
if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pwd'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pwd = $_POST['pwd'];
    $premission = $_POST['typeCompte'];

    // requete qui verifie la duplication du nouvel insertion
    $reqSQL = "SELECT * FROM utilisateur WHERE password_user = :pwd LIMIT 1";
    $taxtStatement = $bd->prepare($reqSQL);
    $taxtStatement->execute([
        ':pwd'=>$pwd
    ]);

$rowReq = $taxtStatement->fetchAll();
foreach($rowReq as $rowSelect):
    $nom_verifier = $rowSelect['nom'];
    $prenom_verifier = $rowSelect['nomComplet'];
    $pwd_verifier = $rowSelect['password_user'];
endforeach;

    $req = $bd->prepare("INSERT INTO utilisateur VALUES(null, :password_user, :nom, :nomComplet, :permission)");

    $req->bindParam(':password_user',$pwd); 
    $req->bindParam(':nom',$nom); 
    $req->bindParam(':nomComplet',$prenom);
    $req->bindParam(':permission',$premission); 

    if(isset($nom_verifier) == $nom && isset($prenom_verifier) == $prenom && isset($pwd_verifier) == $pwd){
        header("Location: parametre.php?error= Person Already Exist ❌"); 
    }else{
        $exc = $req->execute();
        if($exc){
            $reqSQL = "SELECT * FROM utilisateur WHERE password_user = :pwd LIMIT 1";
            $taxtStatement = $bd->prepare($reqSQL);
            $taxtStatement->execute([
                ':pwd'=>$pwd,
            ]);
           $rstRow = $taxtStatement->fetch();
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
    <link rel="stylesheet" href="../pages/revenu_imposable.php"/>
	<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
	<link rel="manifest" href="favicon/site.webmanifest">
	<link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
    <title>Création compte </title>
</head>
<body>
<div class="container-fluid">
        <div class="row">
            <?php require 'navbar.php';?>
        </div>
    </div>
    <div class="class">
        <?php require 'dashboard.php' ?>
    </div>
<?php if(isset($exc)) : ?>
<div class="container alert alert-success">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-4 optionCompte">
            <div class="row">
                <div class="col"><h4 class="text-primary">NOUVEAU COMPTE CRÉER</h4></div>
                <!-- <div class="col">
                    Options
                <ul id="sousMenuDeroulant"> 
                    <li><a href="#">Modifier Compte</a></li>
                    <li><a href="#">Lister Compte</a></li>
                    <li><a href="#"></a>Supprimer Compte</li>
                </ul></div> -->
            </div>
        </div>
        <div class="col-4">
            <h6>User: <?php echo strtoupper($rstRow['nom']);  ?> </h6>
            <h6>Password : <?php echo $rstRow['password_user'] ?> </h6> 
        </div>
        <div class="col-2"></div>
    </div>
</div>
<?php endif ?>
<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 compte">
            <div class="row">
             <h4 class="text-primary">Créer un Compte</h4>
           </div>
            <form action="#" method="POST">
                <?php if(isset($_GET['error'])){ ?>
                    <p style="text-align: center;" class="alert alert-danger"> <?php echo $_GET['error'] ?> </p>
                <?php } ?> 
                <div class="row">
                    <div class="col">
                        <div class="mb-2">
                             <input type="text" name="nom" class="form-control" required  placeholder="Count user">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-2">
                             <input type="text" name="prenom" class="form-control" required  placeholder="Fullname">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-2">
                            <select name="typeCompte" class="form-select" >
                                <option>Choisir le type du compte</option>
                                <option value="admin">Admin</option>
                                <option value="simple">Simple utilisateur</option>
                                <option value="chauffeur">Chauffeur</option>
                            </select> 
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <input type="password" name="pwd" class="form-control" required  placeholder="Password">
                </div>
                <div class="row">
                    <div class="col-8">
                        <button class="mb-2 btn btn-primary">CRÉER COMPTE</button>
                    </div>
                    <div class="col-4"></div>
                </div><br>
            </form>
        </div>
        <div class="col-1"></div>
    </div>
</div>
</body>
</html>

<style>
    .container{
        margin-top: 3%;   
    }

    .compte{
        box-shadow: 1px 0px 4px 2px blue;
        padding: 30px;

    }

    .titre{
        text-align: center;
        padding: 3px;
        margin-bottom: 30px;
    }

    /* .optionCompte{
        display: flex;
    }

    #sousMenuDeroulant li a{
        color: red;
    } */

    a{
        text-decoration: none;
        font-size: 18px;
        font-weight: bold;
    }

    .one, .one a{
        background-color: gray;
        color: white;
        padding: 10px;
        border-radius: 3px;
    }

    .btn{
        font-size: 17px;
        margin-top: 3px;
    }
</style>