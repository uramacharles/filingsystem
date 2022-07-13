<?php
include_once('controller/autoload.php');
include_once('controller/adminonlysessioncontrol.php');
include_once('controller/uploads_edit_redirect_control.php');
?>
<?php 
if(! isset($_SESSION["conf"])){
  header("location:uploads.php");
}
?>
 
<?php include_once("adheader.php"); ?>
  <body >
<?php include_once('adminnav.php'); ?>

<div class="w3-main" id="main">
    <br><br>

  <div class="container" id="hide">
    <div class="container">
      <!--The folowing div takes care of the upload Writing and Saving-->

      <div class="row">
        <h2 class="page-header text-center" style="margin: 30px 20px"><span class="fa fa-edit"></span> Delete upload</h2>
        <?php if(isset($_SESSION['message'])): ?>
          <div class="container well text-center w3-card-12">
              <h1 class="text"><?php echo $_SESSION['message']; ?></h1>
          </div>
        <?php else: ?>
          <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <div class="col-md-12">
          <div class=" container well w3-card-24 col-md-6 col-md-offset-3">
          <?php include_once('controller/uploads_edit_delete_control.php'); ?>

          <?php if($conf == "YES"): ?>
            <form action="<?php $_PHP_SELF; ?>" method="POST" id="postform" enctype="multipart/form-data">
              <label style="color:blue;" class="col-md-12" >Supply the password you used to lock this file.?</label>
              <div class="form-control col-md-3">
                <label>Password</label>
                <input type="password" placeholder="******" title="The password you used to lock the file" name="confid" id="confid"/>
              </div>
              <div class="form-group" style="padding-bottom: 4em">
                <button type="submit" name="delete_conf" class="btn btn-primary btn-style-four pull-right lead">Delete</button>
              </div>
            </form>
            <?php if(isset($_SESSION["done"])): ?>
              <a href="uploads.php"><input type="button" class="btn btn-primary" value="Return To uploads"/></a>
            <?php endif; ?>
          <?php else: ?>
            <form action="<?php $_PHP_SELF; ?>" method="POST" id="postform" enctype="multipart/form-data">
              <div class="form-group col-md-12">
                <label >Are you sure You want to delete this file?</label>
              </div>
              <div class="form-group col-md-3">
                  <span>Yes:<input type="radio" class="form-control" name="confirm" value="YES" checked="checked" /></span>
              </div>
              <div class="form-group col-md-3">
                  <span>NO:<input type="radio" class="form-control" name="confirm" value="NO" /></span>
              </div>
              <div class="form-group" style="padding-bottom: 4em">
                <button type="submit" name="delete_noconf" class="btn btn-primary btn-style-four pull-right lead">Delete</button>
              </div>
            </form>
          <?php endif; ?>

          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include_once('footer.php'); ?>