<?php
require './data/connect.php';
    
// if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pwd'])){
//     $nom = $_POST['nom'];
//     $prenom = $_POST['prenom'];
//     $mail = $_POST['email'];
//     $pwd = $_POST['pwd'];
//     $commune = $_POST['commune'];

//     // requete qui verifie la duplication du nouvel insertion
//     $reqSQL = "SELECT * FROM super_user WHERE super_user_code = :pwd LIMIT 1";
//     $taxtStatement = $bd->prepare($reqSQL);
//     $taxtStatement->execute([
//         ':pwd'=>$pwd
//     ]);

// $rowReq = $taxtStatement->fetchAll();
// foreach($rowReq as $rowSelect):
//     $nom_verifier = $rowSelect['super_user_nom'];
//     $prenom_verifier = $rowSelect['super_user_prenom'];
//     $email_verifier = $rowSelect['super_user_email'];
// endforeach;

//     $req = $bd->prepare("INSERT INTO super_user VALUES(:super_user_code, :super_user_nom, :super_user_prenom, :super_user_email, :commune)");
    
//     $req->bindParam(':super_user_code',$pwd); 
//     $req->bindParam(':super_user_nom',$nom); 
//     $req->bindParam(':super_user_prenom',$prenom); 
//     $req->bindParam(':super_user_email',$mail);
//     $req->bindParam(':commune',$commune);

//     if(isset($nom_verifier) == $nom && isset($prenom_verifier) == $prenom && isset($email_verifier) == $mail){
//         header("Location: compteSimpleUser.php?error= Person Already Exist ❌"); 
//     }else{
//         $exc = $req->execute();
//         if($exc){
//             $reqSQL = "SELECT * FROM super_user WHERE super_user_code = :pwd LIMIT 1";
//             $taxtStatement = $bd->prepare($reqSQL);
//             $taxtStatement->execute([
//                 ':pwd'=>$pwd,
//             ]);
//            $rstRow = $taxtStatement->fetch();
//         }  
        
//     }
    
// }


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
    <title>Création compte  </title>
</head>
<body>
<?php if(isset($exc)) : ?>
<div class="container alert alert-success">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-4">
            <h4>NOUVEAU COMPTE CRÉER</h4>
        </div>
        <div class="col-4">
            <h6>NOM COMPTET : <?php echo strtoupper($rstRow['super_user_nom']) .' '. ucfirst($rstRow['super_user_prenom']);  ?> </h6>
            <h6>MOT DE PASSE : <?php echo $rstRow['super_user_code'] ?> </h6> 
        </div>
        <div class="col-2"></div>
    </div>
</div>
<?php endif ?>

<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 compte">
            <div class="row">
                <!-- <div class="col-3"></div> -->
                <div class="col-6">
                    <p class="titre"><a href="compte.php">Créer un compte</a></p>
                </div>
                <div class="col-6">
                    <p class="titre one"><a href="cconnecter.php">Se connecter</a></p>
                </div>
                <!-- <div class="col-3"></div> -->
           </div>
            <form action="#" method="POST">
                <div class="row">
                    <div class="col">
                        <div class="mb-2">
                             <input type="text" name="nom" class="form-control" required  placeholder="Nom">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-2">
                             <input type="text" name="prenom" class="form-control" required  placeholder="Prenom">
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <input type="mail" name="email" class="form-control" required  placeholder="E-mail">
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-2">
                             <input type="text" name="pwd" class="form-control" required  placeholder="Password">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-2">
                             <input type="text" name="commune" class="form-control" required  placeholder="Commune">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <button class="mb-2 btn btn-primary">CONNECTER</button>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-3">
                        <a href="./index.php" class=" mb-2 btn btn-danger">RETOUR</a>
                    </div>
                </div><br>
            </form>
        </div>
        <div class="col-3"></div>
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