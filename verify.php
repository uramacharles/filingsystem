<?php
include_once('controller/autoload.php');
include_once('controller/adminlogincontrol.php');
?>
<?php include_once("adheader.php"); ?>
  <body >
<div class="w3-main" id="main">  
  <div class="w3-green container-fluid" style="padding-bottom: 20px;">
   <div class="w3-container w3-left">
      <h1 class="w3-text-white text-center">Law-firm Filing System</h1>
    </div>
  </div>
</div>
<div class="container" id="hide">
  <div class="container well text-center w3-card-12"> 
      <span><i class="fa fa-user" style="background-color: transparent;padding-top: 20px;"></i></span>
      <p class="lead">
      <?php if(isset($_SESSION['message'])): ?>
        <b style="color: red"><?php if(isset($_SESSION["message"])){echo $_SESSION['message']; unset($_SESSION["message"]);} ?></b>
      <?php else: ?>
        <b style="color: green">Second Level Login.</b>
    <?php endif; ?>
      </p>
        <div class="contact-form default-form col-md-6 col-md-offset-3">
            <form method="post" action="<?php $_PHP_SELF; ?>" id="contact-form" enctype="multipart/form-data">
                <div class="row clearfix">
                
                    <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                        <input type="text" name="username" value="" placeholder="Username *">
                    </div>

                    <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                        <input type="password" name="password" value="" placeholder="password *">
                    </div>

                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="text-center"><button type="submit" name="login" class="theme-btn btn-style-one">Login </button></div>
                    </div>
                </div>
            </form>
        </div>
  </div>
</div>
  </body>
</html>