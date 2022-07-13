<?php
  include_once('controller/autoload.php');
  include_once('controller/adminonlysessioncontrol.php');
  include_once("controller/admin_fetch_profile.php");
?>
<?php include_once('adheader.php'); ?>
  <body>
<?php include_once('adminnav.php'); ?>

<div class="w3-main" id="main">
  <?php 
    include_once('controller/registercontrol.php');
   ?>

  <div class="container" id="hide" >

    <div class="container wow fadeInLeft" >
      <h1 class="text-center" style="position: relative; z-index: 10; top : 20%; text-decoration: underline;text-decoration-style: double; padding-bottom: 0.2em;padding-top: 2em;"><a href="adminboard.php">Law-Firm Filing System</a> >View Profile</h1>
        <div class="col-sm-12 ">
          <div class="well w3-card-24 wow fadeInBig ">

            <!--Page Title-->
            <section class="row page-title" style="background-image:url(<?php echo $imagepath; ?>); padding-bottom: 2em; min-height: 50em;">
              <div class="mask2"></div>
                <div class=" container col-md-12" style="padding-top: 2em">
                  <figure >
                      <img class="image-box col-md-4 col-md-offset-4 col" style="border-width: 0.5em;border-color: white;border-style: inset; border-radius: 50%;" src="<?php echo  $imagepath; ?>" alt="Staff's Picture."/>
                  </figure>
                </div>
                <div class="container col-md-12">
                    <h1><?php echo $staffname; ?> </h1>
                </div>

                <div class="col-md-12" style="background-color:transparent;">
                  <br><br>
                  <hr style="border-width: 0.3em; color:white" class="col-md-6 col-md-offset-3" />
                  <div class="row col-md-12" style="color:#ffffbb; font-size: 20px">
                    <label class="col-md-12"> Email:</label>
                    <div class="col-md-12"><?php echo $email; ?></div>
                  </div>
                  <div class="row col-md-12 pull-right lead" style=" padding-top: 2em">
                    <button type="button" class="showtoggle bth btn-style-five">View more</button>
                  </div>
                </div>
            </section>

            <div class="container animated wow fadeInRight col-md-6 col-md-offset-3 profprev" >
              <h3 class="text-center" style="position: relative; z-index: 10; top : 20%; padding-bottom: 1em;padding-top: 2em;">  <a href="index"> Law-Firm Filing System</a> > <a href=""> Profile</a></h3>
              <hr style="border-width: 2em; border-color: gray;" />
              <div class="row" style="padding: 2em">
                  <h3 class="text-center" style="color:red;text-decoration: underline;text-decoration-style: double;">About  <?php  echo $name; ?></h3>
                  <div style="font-size:15px; text-align: justify;min-height: 20em;">
                    <?php echo $profile; ?>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('footer.php'); ?>