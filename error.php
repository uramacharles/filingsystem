<?php session_start(); ?>
 <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>The House Of Laws.</title>
<!--For sweet alert-->
<script src="asset/css/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="asset/css/sweetalert/dist/sweetalert.css">
<!-- Stylesheets -->
<link href="asset/css/bootstrap.css" rel="stylesheet">
<link href="asset/css/revolution-slider.css" rel="stylesheet">
<link href="asset/css/style.css" rel="stylesheet">
<link rel="shortcut icon" href="asset/images/logo.png" type="image/x-icon">
<link rel="icon" href="asset/images/logo.png" type="image/x-icon">
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link href="asset/css/responsive.css" rel="stylesheet">
<link href="asset/css/hover.css" rel="stylesheet" type="text/css"/>
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>
  <body >
      <div class="container text-center col-md-12" style="padding-top: 2em;height: 100%; background-size: cover; background-image: url(asset/images/error.jpg);background-color: transparent; ">
        <div class=" container w3-card-24 col-md-6 col-md-offset-3" style="background-color: white; opacity: 0.7;">
            
            <h1 class="page-header text-center text" style="font-size: 200px;font-weight:bold; letter-spacing:0.1em; font-family: cursive">404</h1>

            <?php if(isset($_SESSION['trialnum'])){unset($_SESSION['trialnum']);} ?>
            <h1 class="page-header text-center text" style="padding-top: 50px;color: red;"><?php if(isset($_SESSION['warning'])){echo $_SESSION['warning'];} ?></h1>
            <p class="text-center lead"><?php if(isset($_SESSION['message'])){echo $_SESSION['message'];} ?></p>
            <p class="text-center"><b>You can click on this<a href="<?php echo $_SESSION['lastaddress']; ?>" style="background-color: white;color: green;"> LINK </a>to go back to the last page</b></p>
        </div>
      </div>
        
    <footer class="container w3-green">
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="asset/js/bootstrap.min.js"></script>
    </footer>
  </body>
</html>