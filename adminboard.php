<?php
include_once('controller/autoload.php');
include_once('controller/adminonlysessioncontrol.php');
?>
<?php include_once("adheader.php"); ?>
  <body >
<?php include_once('adminnav.php'); ?>

<div class="w3-main" id="main">
    <br><br>
  <div class="w3-green container-fluid" style="padding-bottom: 20px;">     
    <a href="adminboard.php" class="btn btn-light w3-xlarge w3-left " style="margin-top: 3px; color: white;"><i class="fa fa-th-list"></i></a>
    <div class="w3-container w3-left">
      <h1 class="w3-text-white">Law-firm Filing System</h1>
    </div>
  </div>

  <div class="container" id="hide">

    <div class="container well text-center w3-card-12"> 
        <span class=" w3-center "> <i class=" fa fa-check"></i></span>
        
        <h1 class="text">Welcome <span id="admin"><?php if(isset($_SESSION['file_admin_name'])){echo $_SESSION['file_admin_name'];}?></span>!!!</h1>
        <span><i class="fa fa-user" style="background-color: transparent;padding-top: 20px;"></i></span>
        <p class="lead"><b style="color: green">You have been successfully logged in.</b><br /><br />You can view your recent updates below.</p>
    </div>

    <div class="container">

      <!--The folowing div takes care of the Category.-->

      <div class="row wow fadeIn">

        <div class="row">
          <h2 class="page-header text-center" style="margin: 30px 20px"><span class="fa fa-edit"></span> Add Post Categories</h2>
          <div class="col-md-12">
            <div class="well w3-card-24">
                  <?php include_once('controller/category_control.php'); ?>
              <span class="alert-danger"></span>
              <form action="<?php $_PHP_SELF; ?>" method="POST" id="stafform" enctype="multipart/form-data">
                <div class="form-group col-md-3">
                    <label > Name</label>
                    <input type="text" class="form-control col col-md-12" name="name" placeholder="" />
                </div>

                <div class="form-group" style="padding-bottom: 4em">
                  <button type="submit" name="addcategory" class="btn btn-primary btn-style-four pull-right lead">Add Category</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="row"> 
          <h2 class="page-header text-center" style="margin: 30px 20px"><span class="fa fa-edit"></span> Categories:</h2>
          <div class="col-sm-12 ">
            <div class="well w3-card-24 fetchsubscribersdiv animated bounceInUp ">
                <?php include_once('controller/adminfetchcategory.php'); ?>
            </div>
          </div>
        </div>
        <div class="styled-pagination text-center">
          <span id="result"></span>
          <hr style="border-width: 0.5em; ">
          <div class="row col-xs-12 text-right">
            <?php 
              echo $pageControl;
            ?>
          </div>
        </div>
        
      </div>




    </div>
  </div>

  <?php include_once('footer.php'); ?>