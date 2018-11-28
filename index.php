<?php
	session_start();
?>
<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Swiss Medica ||Nabavka</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    
    <link rel="stylesheet" href="assets/js/Lightweight-Chart/cssCharts.css"> 
    <script src="assets/js/jquery-1.10.2.js"></script>
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

 

</head>


<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><strong><i class="fas fa-shopping-cart"></i> NABAVKA</strong></a>
				
		<div id="sideNav" href="">
		<i class="fa fa-bars icon"></i> 
		</div>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
<?php    
    include('navbar_side.php');
?>
        <div id="page-wrapper">
		    <div class="header"> 
                <h1 class="page-header">
                    Dashboard <small>Welcome Ana</small>
                </h1>
				    <ol class="breadcrumb">
					  <li><a href="#">Pocetna</a></li>
					  
					  <li class="active">Logovanje</li>
					</ol> 
									
		    </div>
            <div id="page-inner">
                <div class='login'>
                    
                </div>
            <?php
							if(!isset($_SESSION['sesijaIdKorisnik']))
							{
							?>
							<div class='logovanje'>
								<div class='forma'>
									<center><p><h3><b>LOGIN</b> <i class="fas fa-sign-in-alt loginIcon"></i></p></h3></center>

								<div class='card-body'>
									<form action='' method='POST' class='loginForma'>
                                        <label><i class='fa fa-user' aria-hidden='true'></i></label><input type='text' id="tbKorisnickoIme"name='tbKorisnickoIme' class='form-control username' placeholder='E-mail:' onfocusout='proveraEmail();'>
                                        <span id="spanEmail"></span><br/>
                                        <label><i class='fa fa-unlock-alt' aria-hidden='true'></i></label><input type='password' id="tbLozinka" name='tbLozinka' class='form-control password' placeholder='*********'  onfocusout='proveraLozinka();'>
                                        <span id="spanLozinka"></span><br/>
										<input type='submit' class='btn btn-primary login' name='btnLogin' value='Log In'/>
									</form>
                                    <script src="assets/js/provera.js"></script>
								</div>
								</div>
							</div>
						<?php
							}
						?>
						  
						<?php
							if(isset($_POST['btnLogin']))
							{
								$korIme=trim($_POST['tbKorisnickoIme']);		
								$lozinka2=$_POST['tbLozinka'];
                                $lozinka=md5($lozinka2);
                                
                                $reEmail   ="/^[a-zA-Z0-9\.\-]+@[a-zA-Z0-9\.\-]+$/";
                                $reLozinka ="/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/";
                                        
                                $errors = array();
                                if(!preg_match($reEmail, $korIme)){
                                    #echo "<div class='alert alert-danger' role='alert'>Ne ispravan unos naziva proizvoda!</div>";
                                    array_push($errors,"<div class='alert alert-danger' role='alert'>Neispravna email adresa!</div>");
                                }
                                if(!preg_match($reLozinka, $lozinka2)){
                                    #echo "<div class='alert alert-danger' role='alert'>Ne ispravan unos naziva proizvoda!</div>";
                                    array_push($errors,"<div class='alert alert-danger' role='alert'>Lozinka mora da sadrzi minimum 8 karaktera, jedno slovo i jedan specijalan karakter!</div>");
                                }
                                if(empty($errors)){
                                    include_once('connection.php');
                                    $database = new Connection();
                                    $db = $database->open();
                                    
                                    $sql = "SELECT * FROM korisnici WHERE username=? AND 
                                    lozinka=? ";
                                    $query = $db->prepare($sql);
                                    $query->execute(array($korIme,$lozinka));
                                  
                                    if($query->rowCount() >= 1) {
                                        $row=$query->fetch();
                                        @$_SESSION['sesijaIdKorisnik']=$row['id_korisnik'];	
                                        //$_SESSION['user'] = $user;
                                        //$_SESSION['time_start_login'] = time();
                                        echo "<script> window.location.replace('ulazRobe.php') </script>";
                                      }
                                    else{
                                        $result='<div class="alert alert-danger">Ne postoji korisnik sa tim e-mailom ili lozinkom!</div>';
                                        echo $result;
                                    }
                                }
                                else{
                                    foreach($errors as $error){
                                      echo $error;
                                    }
                                }
								
							
							}
						?>
            </div>
<?php
    include('footer.php');
?>