
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<div class="container-menu">
    <h4>Dress'up Haïti</h4> <hr>
    <nav>
        <ul>
            <li><i class="bi bi-speedometer2"></i>&nbsp; <a href="index.php">Dashbord</a></li>
            <li><i class="bi bi-archive"></i>&nbsp; <a href="stock.php">Gestion Stock</a></li>
            <li><i class="bi bi-cart3"></i>&nbsp; <a href="#">Gestion Vente</a></li>
            <li><i class="bi bi-truck-flatbed"></i>&nbsp; <a href="livraison.php">Livraison</a></li>
            <li><i class="bi bi-graph-up"></i>&nbsp; <a href="rapport.php">Dresser Rapport</a></li>
            <li><i class="bi bi-gear"></i>&nbsp; <a href="rapport.php">Paramètre</a></li>
        </ul>
    </nav>
    <div class="deconnect">
         <a class="btn btn-warning" href="../fonctions/deconnect.php">Deconnecter <i class="bi bi-arrow-left-square-fill"></i></a>
    </div>
</div>



<style>

*{ font-family:Arial, Helvetica, sans-serif; }

.container-menu{
    position: fixed;
    background: hwb(230 15% 36% / 0.941);
    width: 235px;
    height: 100%;
    top: 0;
    left: 0;
}

.container-menu h4{
    font-size: 27px;
    color: #ffffff;
    margin-top: 16px;
    margin-bottom: 14px;
    margin-left: 15px;
  

   
}

hr{
    color: #ffffff;
    height: 30px;
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
    top: 60px;
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