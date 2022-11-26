<?php ;
session_start();
$permit = $_SESSION['permission'];

?>
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
<link rel="manifest" href="favicon/site.webmanifest">
<link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

    <div id="menu" class="container-menu">
        <nav>
            <ul>
                <li><i class="bi bi-speedometer2"></i>&nbsp; <a href="admin.php">Dashbord</a></li>
                <li><i class="bi bi-archive"></i>&nbsp;<a <?php if($permit != "admin"){?> href="admin.php?msg=Vous n'avez pas d'accès ..." <?php }else{ ?> href="stock.php" <?php } ?> > Gestion Stock</a></li>
                <li><i class="bi bi-cart3"></i>&nbsp; <a  <?php if($permit != "admin"){?> href="admin.php?msg=Vous n'avez pas d'accès ..." <?php }else{ ?> href="gestionVente.php" <?php } ?>>Panier vente</a></li>
                <li><i class="bi bi-truck-flatbed"></i>&nbsp; <a <?php if($permit == "chauffeur"){?> href="admin.php?msg=Hey vous n'avez pas d'accès ici..." <?php }else{ ?>  href="livraison.php"<?php } ?>>Livraison</a></li>
                <li><i class="bi bi-truck-flatbed"></i>&nbsp; <a <?php if($permit == "simple"){?> href="admin.php?msg=Hey vous n'avez pas d'accès ici..." <?php }else{ ?>  href="livraisonChauffeur.php"<?php } ?>>Livr. Chaffeur</a></li>
                <li><i class="bi bi-graph-up"></i>&nbsp; <a <?php if($permit != "admin"){?> href="admin.php?msg=Vous n'avez pas d'acces..." <?php }else{ ?> href="rapport.php" <?php } ?>>Dresser Rapport</a></li>
                <li><i class="bi bi-gear"></i>&nbsp; <a <?php if($permit != "admin"){?> href="admin.php?msg=Vous n'avez pas d'acces..." <?php }else{ ?> href="parametre.php" <?php } ?>>Paramètre</a></li>
            </ul>
        </nav>
        <div class="deconnect">
            <a class="btn btn-warning" href="./deconnect.php?logout=0">Deconnecter <i class="bi bi-arrow-left-square-fill"></i></a>
        </div>
    </div>


<style>

*{ font-family:Arial, Helvetica, sans-serif; }

#menu{
    display: none;
    position: absolute;
    top: 60px;
    z-index: 1;
}

.container-menu{
    position: fixed;
    background-color: #343a40;
    width: 235px;
    height: 100%;
    top: 0;
    left: 0;
}


.agc{
    font-size:15px;
    border-bottom:white 2px solid;
    border-left:white 2px solid;
    padding:3px;
}


nav ul h6{
    color: #ffffff;
    text-decoration: none;
    margin-top: -15px;
    margin-bottom: 10px;
    color: rgb(177, 177, 12);
    font-weight: bold;
}

nav ul li{
    font-size: 20px;
    margin-bottom: 15px;
    list-style: none;
    margin:5px 0;
    background-color: rgba(0, 0, 0, 0.3) /* Green background with 30% opacity */;
    padding: 7px 15px;
    width: 230px;
    position: relative;
    left: -18px;
}

nav ul li a{
    color: black;
    text-decoration: none;
    font-size:20px;
    color: #ffffff;
}

.container-menu nav ul li a:hover{
    color: black;
    font-weight: bold;
}

.deconnect{
    position: relative;
    top: 280px;
    padding-bottom: 32px;
    color: red;
    margin-left: 35px;
}


.container-menu ul{
    text-decoration: none;
    color: #ffffff;
    padding: 0 20px;
}

.deconnect a{
    color: black;
    text-decoration: none;
}

.deconnect:hover{
    color: red;
    padding-left: 4px;
    transition: 0.6s;
    }

    i{
        padding-right: 7px;
    }


</style>

<script>
   
    function ToggloFunction() {
        const bouton = document.getElementById('menu');
        if (bouton.style.display === 'none') {
            bouton.style.display = 'block';
        } else {
            bouton.style.display = 'none';
        }
    }
</script>