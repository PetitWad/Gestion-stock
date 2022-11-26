<?php session_start();
require 'data/connect.php';
    if(isset($_POST['name'], $_POST['password'])){

        $name = $_POST['name'];
        $pwd = $_POST['password'];

        $req = "SELECT * FROM utilisateur WHERE nom = :nom AND password_user = :pwd";
        $state = $bd->prepare($req);
        $state->execute([
            ':nom'=> $name,
            ':pwd'=> $pwd
        ]);
        
       $rst = $state->fetch();
       $permit = $rst['permission'];

       if($name == $rst['nom'] && $pwd == $rst['password_user']){
			$_SESSION['permission']= $permit;
			header("Location: admin.php");
       }else{
        header("Location: index.php?error=Username or Passsword is incorrect");
       }

        
    }

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Login | Dressup</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./css/style.css">
	<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
	<link rel="manifest" href="favicon/site.webmanifest">
	<link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(images/acceuil.jpeg);">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Dress'up Haïti</h3>
			      		</div>
							<div class="w-100">
								<p class="social-media d-flex justify-content-end">
									<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
									<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
								</p>
							</div>
			      	</div>
					<form action="#" method="POST" class="signin-form">
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Username</label>
			      			<input type="text" name="name" class="form-control" placeholder="Username" required>
			      		</div>
                        <div class="form-group mb-3">
                            <label class="label" for="password">Password</label>
                        <input type="text" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group">
							<center>
								<?php if(isset($_GET['error'])){ ?>
									<strong><p class="text-danger"> <?= $_GET['error'] ?></p></strong>
								<?php } ?>	
							</center>
                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">Connect</button>
                        </div>
		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- <script src="js/main.js"></script> -->

	</body>
</html>

