<?php
include_once('controller/autoload.php');
?>
<?php $_SESSION['lastaddress']= $_SERVER['PHP_SELF']; ?>

<?php include_once("adheader.php"); ?>

  <body >
    <div class="w3-main" id="main">  
      <div class="w3-green container-fluid" style="padding-bottom: 20px;">
       <div class="w3-container w3-left">
           <h1 class="w3-text-white text-center">Law Filing System</h1>
        </div>
      </div>
    </div>
    <div class="container" id="hide">
      <div class="container well text-center w3-card-12">
          
        <h1 class="text">Register</h1>
        <span style="background: transparent;"><i class="fa fa-book" style="background-color: transparent;padding-top: 20px"></i></span>
        <?php include_once('controller/registercontrol.php'); ?>
        <p class="lead">
        <?php if(isset($_SESSION['message'])): ?>
          <b style="color: red"><?php if(isset($_SESSION["message"])){echo $_SESSION['message']; unset($_SESSION["message"]);} ?></b>
        <?php endif; ?>
        <?php if(isset($_SESSION['gotoactivation'])): ?>
            <a href="activation.php"><input type="button" class="btn btn-style-three" name="" value="Go To ACTIVATION"/></a>
        <?php endif; ?>
        </p>
        <div class="contact-form default-form col-md-6 col-md-offset-3">
          <div class="well w3-card-24" style="color:blue;">
            <div class="contact-form default-form">
                <form method="POST" action="<?php $_PHP_SELF; ?>" enctype="multipart/form-data">
                    <div class="row clearfix">
                    
                        <div class="form-group col-xs-12" >
                            <label>Name</label>
                            <input type="text" name="name" value="" placeholder="Name *">
                        </div>

                        <div class="form-group col-xs-12" >
                          <label>Username</label>
                            <input type="text" name="username" value="" placeholder="Username *">
                        </div>

                        <div class="form-group col-xs-12" >
                          <label>Password</label>
                            <input type="password" name="password" value="" placeholder="password *">
                        </div>

                        <div class="form-group col-xs-12" >
                            <label>Retype Password</label>
                            <input type="password" name="ret_password" value="" placeholder="retype password *">
                        </div>

                        <div class="form-group col-xs-12" >
                            <label>Email</label>
                            <input type="email" name="email" value="" placeholder="Recovery Email *">
                        </div>

                        <div class="form-group col-xs-12">
                            <div class="text-center"><button type="submit" name="addlawyer" class="theme-btn btn-style-one">Submit Now </button></div>
                            <span style="font-size: 15px;color: green"><a href="login.php">Click to Login.</a>(forgot password ?<a href="recover.php" style="color: green;text-decoration: underline"><i class="fa fa-pencil"></i>Click here</a>)</span>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>