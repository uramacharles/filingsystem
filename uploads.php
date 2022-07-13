<?php
include_once('controller/autoload.php');
include_once('controller/adminonlysessioncontrol.php');
include_once('controller/uploads_edit_redirect_control.php');
?>
<?php
  /*-====================================================
  To redirect to the verification page if it is confidential
  ===================================================*/
  if(isset($_POST["delete_upload"])) {
    $_SESSION["conf"] = filter_input(INPUT_POST, "file_prone");
    $_SESSION["fid"] = filter_input(INPUT_POST, "file_id");
    header("location:udelete.php");
  }
  /*================================
  To Unset the done state session for a return button
  ========================================*/
  unset($_SESSION["done"]);
?> 
<?php include_once("adheader.php"); ?>
  <body >
<?php include_once('adminnav.php'); ?>

<div class="w3-main" id="main">
    <br><br>

  <div class="container" id="hide">
    <div class="container">
      <!--The folowing div takes care of the Document Writing and Saving-->

      <div class="row">
        <h2 class="page-header text-center" style="margin: 30px 20px"><span class="fa fa-edit"></span> Upload your files</h2>
        <?php if(isset($_SESSION['message'])): ?>
          <div class="container well text-center w3-card-12">
              <h1 class="text"><?php echo $_SESSION['message']; ?></h1>
          </div>
        <?php else: ?>
          <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <div class="col-md-12">
          <div class=" container well w3-card-24">
            <?php include_once('controller/uploads_control.php'); ?>
            <span class="alert-danger"></span>

            <form action="<?php $_PHP_SELF; ?>" method="POST" id="postform" enctype="multipart/form-data">
              
              <div class="form-group col-md-3">
                  <label >Title</label>
                  <input type="text" class="form-control col col-md-12" name="title" placeholder="" required="required" />
              </div>
              
              <div class="form-group col-md-3">
                <label>Confidential?</label>
                <span>Yes?</span>
                <input type="radio" id="conf" class="" name="confidential" value="YES" />
                <span>No?</span>
                <input type="radio" id="noconf" class="" name="confidential" value="NO" checked="checked" />
              </div>

              <div class="form-group col-md-3" id="confpass" style="display: none; color: blue;">
                  <label >Choose Password (Make sure it is left empty if you don't need it to be locked)</label>
                  <input type="password" class="form-control col col-md-12" name="confpassword" placeholder="Password" />
              </div>
              
              <div class="form-group col-md-3">
                <label>Files to Upload</label>
                <input type="file" id="attach" class="hidden form-control" name="attachments[]" accept=".jpg, .png, .jpeg, .gif, .pdf, .docx, .doc" multiple="multiple" >
                <label for="attach" class="btn btn-style-two btn-md" >Select Uploads</label>
              </div>

              <div class="form-group col-md-4 col-sm-6 col-xs-12" >
                  <label class="col-md-12 ">Category</label>
                  <select name="category" class="form-control " required="required">
                    <?php for($p=0;$p<=$catcount-3;$p+=3): ?>
                      <option value="<?php echo $category[$p+1]; ?>"><?php echo $category[$p+2]; ?></option>
                    <?php endfor; ?>
                  </select>
              </div>
              
              <div class="form-group" style="padding-bottom: 4em">
                <button type="submit" name="add_uploads" class="btn btn-primary btn-style-four pull-right lead">Upload</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="row">  <!--Fetch the Newsletters with edit and delete functionalities-->
        <h2 class="page-header text-center" style="margin: 30px 20px"><span class="fa fa-edit"></span>Uploaded documents:</h2>
        <div class="col-sm-12 ">
          <?php include_once('controller/uploads_edit_delete_control.php'); ?>
          <div class="well w3-card-24 fetchsubscribersdiv animated bounceInUp ">
            <legend style="background-color: gray">
              <div> 
                  <form method="POST" action="<?php $_PHP_SELF; ?>" id="searchform">
                      <div class="form-group" style="padding-top: 1em;padding-left: 0.5em">
                          <input type="search" id="search" name="searchitem" value="" placeholder="Search Now">
                          <button type="submit" name="search"><span class="icon fa fa-search"></span></button>
                      </div>
                  </form>
              </div>
            </legend>
              <?php include_once('controller/adminfetchuploads.php'); ?>
          </div>
        </div>
      </div>
      <!-- Styled Pagination -->
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

  <?php include_once('footer.php'); ?>