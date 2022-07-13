<?php
  include_once('controller/autoload.php');
  //include_once('controller/adminonlysessioncontrol.php');
?>
<?php include_once('adheader.php'); ?>
  <body>
<?php //include_once('adminnav.php'); ?>

  <div class="container" id="hide" >

    <div class="container animated fadeInRight" >
      <h3 class="text-center" style="position: relative; z-index: 10; top : 20%; padding-bottom: 1em;padding-top: 2em;">  <a href="index.php"> Law-firm Filing System</a> > <a href="login.php">Login</a> > Account activation</h3>
      <hr style="border-width: 2em; border-color: gray;" />
  <?php include_once('controller/adminactivationcontrol.php'); ?>
          <!--Contact Section-->
      <section class="contact-section">
        <div class="auto-container">
            <div class="contact-form default-form col-xs-12 col-sm-6">
              <form action="<?php $_PHP_SELF; ?>" method="POST">
                <div class="top">
                  <h1>If you have not recieved an email type your account email</h1>
                  <h4>That is the email you registered with</h4>
                </div>
                <div class="form-area">
                  <div class="group">
                    <input type="email" class="form-control" placeholder="Activation Email" name="activationemail" required>
                    <i class="fa fa-envelope-o"></i>
                  </div>
                  <button type="submit"  name="sendcode" class="btn btn-style-two btn-block">Send Activation Code</button>
                </div>
              </form>
            </div>
            <div class="contact-form default-form col-xs-12 col-sm-6">
              <form action="<?php $_PHP_SELF; ?>" method="POST">
                <div class="top">
                  <h1>Type the activation code sent to you</h1>
                </div>
                <div class="form-area">
                  <div class="group">
                    <input type="text" class="form-control fa fa-edit" placeholder="Activation Code" name="activationcode" required>
                    <i class="fa fa-user"></i>
                  </div>
                  <button type="submit"  name="activate" class="btn btn-style-one btn-block">Activate Account</button>
                </div>
              </form>
            </div>
        </div>
      </section>

    </div>
</div>
<?php include_once('footer.php'); ?>