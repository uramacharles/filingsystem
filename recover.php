<?php
  include_once('controller/autoload.php');
?>
<?php include_once('adheader.php'); ?>
  <body>
<?php //include_once('adminnav.php'); ?>

  <div class="container" id="hide" >

    <div class="container animated fadeInRight" >
      <h3 class="text-center" style="position: relative; z-index: 10; top : 20%; padding-bottom: 1em;padding-top: 2em;">  <a href="adminboard"> The House Of Laws </a> > <a href="index">Login</a> > Password Recovery</h3>
      <hr style="border-width: 2em; border-color: gray;" />
  <?php include_once('controller/adminrecoverycontrol.php'); ?>
          <!--Contact Section-->
      <section class="contact-section">
        <div class="auto-container">
            <div class="contact-form default-form col-xs-12 col-sm-6">
              <form action="<?php $_PHP_SELF; ?>" method="POST">
                <div class="top">
                  <h1>Type your recovery email</h1>
                  <h4>That is the email you registered with</h4>
                </div>
                <div class="form-area">
                  <div class="group">
                    <input type="email" class="form-control" placeholder="Recovery Email" name="recoveryemail" required>
                    <i class="fa fa-envelope-o"></i>
                  </div>
                  <button type="submit"  name="sendcode" class="btn btn-style-two btn-block">Send Recovery Code</button>
                </div>
              </form>
            </div>
            <div class="contact-form default-form col-xs-12 col-sm-6">
              <form action="<?php $_PHP_SELF; ?>" method="POST">
                <div class="top">
                  <h1>Type the recovery code sent to you</h1>
                </div>
                <div class="form-area">
                  <div class="group">
                    <input type="text" class="form-control fa fa-edit" placeholder="Recovery Code" name="recoverycode" required>
                    <i class="fa fa-user"></i>
                  </div>
                  <div class="group">
                    <input type="password" class="form-control" placeholder="Password" name="newpassword" required>
                    <i class="fa fa-key"></i>
                  </div>
                  <div class="group">
                    <input type="password" class="form-control" placeholder="Password again" name="retrynewpassword" required>
                    <i class="fa fa-key"></i>
                  </div>
                  <button type="submit"  name="recover" class="btn btn-style-one btn-block">Recover Account</button>
                </div>
              </form>
            </div>
        </div>
      </section>

    </div>
</div>
<?php include_once('footer.php'); ?>