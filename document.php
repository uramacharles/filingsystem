<?php
include_once('controller/autoload.php');
include_once('controller/adminonlysessioncontrol.php');
include_once('controller/documents_edit_redirect_control.php');
?>
<?php
  $fetch = new documents;
    //$this->items = array("id","title","titlelink","document","category","attachment","confidential","date_updated");
    $returns = $fetch->getDocumentByTitle($_SESSION["file_address"],$_SESSION["file_id"]);
    $images = explode("#", $returns[5]);
    $imgcount = count($images);
  if(!is_array($returns)){
    header("location:documents.php");
  }
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
        <h2 class="page-header text-center" style="margin: 30px 20px"><span class="fa fa-edit"></span> <?php echo $returns[1]; ?></h2>
        <?php if(isset($_SESSION['message'])): ?>
          <div class="container well text-center w3-card-12">
              <h1 class="text"><?php echo $_SESSION['message']; ?></h1>
          </div>
        <?php else: ?>
          <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <div class="col-md-12">
          <?php include_once("controller/documents_edit_delete_control.php"); ?>
          <div class=" container well w3-card-24">
            <form action="<?php $_PHP_SELF; ?>" method="POST" id="postform" enctype="multipart/form-data">
              
              <div class="form-group col-md-12">
                  <label >Title</label>
                  <input type="hidden" name="file_id" value=" <?php echo $returns[0]; ?>" required="required" />
                  <input type="text" class="form-control col col-md-12" name="title" value=" <?php echo $returns[1]; ?>" placeholder="" required="required" />
              </div>

              <div class="form-group col-md-4 col-sm-6 col-xs-12" >
                  <label class="col-md-12 ">Category</label>
                  <button class="btn btn-style-five fa fa-folder"><?php echo " ".$returns[4]; ?></button>
              <hr>
              </div>
              <?php 
                  // Create a file to add the information in it. This will help us pre feed the iframe with the data for editing.
                $fd = new documents;
                $p = array('workdata');
                $pt = $fd->createDirectory($p);
                  $filename = $pt."/editable.php";
                  if(file_exists($filename)){
                    unlink($filename);
                  }
                  $file = fopen($filename, "w");
                  fwrite($file, $returns[3]);
               ?>
              <!--This is the template of the Text Editor-->
              <div class="form-group col-md-12 col-sm-12 col-xs-12 " onload="iFrameOn()">
                <label>Document *</label>
                <div id="edit_cb" style="width: 100%;padding: 1px">
                  <input type="button" onclick="iBold()" value="B" class="btn btn-primary" />
                  <input type="button" onclick="iItalic()" value="I" class="btn btn-primary"/>
                  <input type="button" onclick="iUnderline()" value="U" class="btn btn-primary"/>
                  <input type="number" id="FontSize" onclick ="iFontSize()" style="width: 4em;" />
                  <input type="button" onclick="iForeColor()" value="Color" class="btn btn-primary"/>
                  <input type="button" onclick="iHorizontalRule()" value="HR" class="btn btn-primary"/>
                  <input type="button" onclick="iUnorderedList()" value="Ul" class="btn btn-primary"/>
                  <input type="button" onclick="iOrderedList()" value="Ol" class="btn btn-primary"/>
                  <input type="button" onclick="iLink()" value="link" class="btn btn-primary"/>
                  <input type="button" onclick="iUnlink()" value="unlink" class="btn btn-primary"/>
                </div>
                <fieldset>
                  <textarea style="display: none;" name="document" id="description" placeholder="Description" tabindex="2" required="required" class="form-control" rows="10" required="required"></textarea>
                  <iframe  name="textEdit" class="form-control" id="textEdit" style="width:100%; height:20em;border-width: 1px;border-color: blue;" src="workdata/editable.php"></iframe>
                </fieldset>
              </div>
                <?php if($returns[6] == "YES"): ?>
              <div class="form-group col-md-3">
                  <label>Confidential:</label>
                  <input type="password" name="confpass" placeholder="Enter the password." required="required" />
              </div>
                <?php endif; ?>
              <div class="form-group" style="padding-bottom: 4em">
                <button type="submit" name="save_documents" class="btn btn-primary btn-style-four pull-right lead">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="row">
        <?php for($j=0;$j<$imgcount;$j++): ?>
          <div class="container default-portfolio-item col-md-3 col-sm-12 col-xs-12 ">
            <div class="inner-box" style="color:green;font-weight: bold;border-radius:5%; max-width: 15em;min-height: 8em;">
              <figure class="image-box">
                <img src="<?php $im = new documents;  echo $im->formatUrl($images[$j]); ?>" alt=""/>
              </figure>
              <div class="col-md-12">
                <form method="POST" action="<?php $_PHP_SELF; ?>" >
                  <input type="hidden" name="file_id" value="<?php echo $returns[0]; ?>" />
                  <input type="hidden" name="picture_url" value="<?php echo $images[$j]; ?>" />
                  <button type="submit" name="delete_picture" class="btn btn-style-one">Delete Picture</button>
                </form>
              </div>
            </div>
          </div>
        <?php endfor; ?>
      </div>
      <hr style="border-width: 0.5em; ">
      <div class="row">
        <h3>Add More Files:</h3>
      <form action="<?php $_PHP_SELF; ?>" method="POST" id="fileform" enctype="multipart/form-data">
        <div class="form-group col-md-3">
        <label>Select Other files*</label>
        <input type="hidden" name="file_id" value="<?php echo $returns[0]; ?>">
        <input type="file" id="images2" class="hidden form-control" name="files1[]" accept=".jpg, .png, .jpeg, .gif, .pdf, .docx" multiple="multiple" >
        <label for="images2" class="btn btn-style-two btn-md" >Select files</label>
        </div>

        <div class="form-group" style="padding-bottom: 4em">
        <button type="submit" name="addotherfile" class="btn btn-primary btn-style-four pull-right lead">Add File</button>
        </div>
      </form>       
      </div>
      <hr style="border-width: 0.5em; ">
      <div>
      <form action="<?php $_PHP_SELF; ?>" method="POST" id="fileform" enctype="multipart/form-data">

        <div class="form-group" style="padding-bottom: 4em">
        <input type="hidden" name="file_id" value="<?php echo $returns[0]; ?>">
        <button type="submit" name="viewactivity" class="btn btn-primary btn-style-four pull-right lead">View Activities</button>
        </div>
      </form> 
        
      </div>
    </div>
  </div>

  <?php include_once('footer.php'); ?>