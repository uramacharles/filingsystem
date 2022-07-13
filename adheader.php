<?php
$_SESSION['lastaddress']= $_SERVER['PHP_SELF'];
if(isset($_SESSION['file_state'])){
    $state = $_SESSION['file_state'];
}else{
    $state="Login";
}
if(isset($_POST['Logout'])){
    $log = new login;
    $log->logout();
}
if(isset($_POST['Login'])){
    $log = new login;
    $log->tologin();    
}
?>
<?php include_once('controller/fetch_category_control.php');  ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Lawfirm Filing System.</title>
<!--For sweet alert-->
<script src="asset/css/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="asset/css/sweetalert/dist/sweetalert.css">
<!-- Stylesheets -->
<link href="asset/css/bootstrap.css" rel="stylesheet">
<link href="asset/css/revolution-slider.css" rel="stylesheet">
<link href="asset/css/style.css" rel="stylesheet">
<link rel="shortcut icon" href="asset/images/logo.png" type="image/x-icon">
<link rel="icon" href="asset/images/logo.png" type="image/x-icon">

<link href="asset/css/hover.css" rel="stylesheet" type="text/css"/>
<link href="asset/css/w3.css" rel="stylesheet">
<link href="asset/css/admin.css" rel="stylesheet" type="text/css"/>

<link href="asset/css/responsive.css" rel="stylesheet">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
</head>