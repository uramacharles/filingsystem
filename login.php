<?php
include_once('controller/autoload.php');
include_once('controller/adminfirstlogin.php');
?>
<?php include_once("adheader.php"); ?>


  <body >
    <div class="w3-main" id="main">  
      <div class="w3-green container-fluid" style="padding-bottom: 20px;">
       <div class="w3-container w3-left">
           <h1 class="w3-text-white text-center">Law-Firm Filing System</h1>
        </div>
      </div>
    </div>
    <div class="container" id="hide">
      <div class="container well text-center w3-card-12">
          <h1 class="text">Welcome <span id="admin">Sir</span>!!!</h1>
          <span style="background: transparent;"><i class="fa fa-user" style="background-color: transparent;padding-top: 20px"></i></span>
          <p class="lead">
          <?php if(isset($_SESSION['message'])): ?>
            <b style="color: red"><?php echo $_SESSION['message']; ?></b>
          <?php else: ?>
            <b style="color: green">Login to continue.</b>
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
                            <span style="font-size: 15px;color: green"><a href="register.php">Click to register.</a>(forgot password ?<a href="recover.php" style="color: green;text-decoration: underline"><i class="fa fa-pencil"></i>Click here</a>)</span>
                        </div>
                    </div>
                </form>
            </div>
      </div>
    </div>
  </body>
</html>