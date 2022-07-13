<?php
include_once('controller/autoload.php');
include_once('controller/adminonlysessioncontrol.php');
include_once('controller/documents_edit_redirect_control.php');
?>
<?php
    $fetcher = new documents;
    //$this->items = array("id","activity","date");
    $user = $_SESSION['file_adminId'];
    $id = $_SESSION['file_id'];
    $pageControl = $fetcher->getConditionedPageVariables("document_activity","WHERE file_user ='$user' AND file_id = '$id'");
    $activities = $fetcher->getactivities($_SESSION["file_id"]);
    $returns = $fetcher->getDocumentByTitle($_SESSION["file_address"],$_SESSION["file_id"]);
    $cunt = count($activities);
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
        <div class="col-md-8 col-md-offset-2">

          <?php $check =0; $numbering = 0; ?>
          <?php for($i=0;$i<=$cunt-3;$i+=3):?> 
            <?php $numbering ++; ?>
            <?php if($check == 0 ):?>
              <div class="container col-md-12 fetchsubscribers1">
                <div class="col-md-1"><?php echo $numbering; ?></div>
                <div class="col-md-4 text-right">AS AT <span style="color:red;"> <?php echo $activities[$i+2] ?></span></div>
                <div class="col-md-6 text-right" ><?php echo  $activities[$i+1]; ?></div>
              </div>
              <?php $check += 1; ?>
            <?php else: ?>
              <div class="container col-md-12 fetchsubscribers2">
                <div class="col-md-1"><?php echo $numbering; ?></div>
                <div class="col-md-4 text-right">AS AT <span style="color:red;"> <?php echo $activities[$i+2] ?></span></div>
                <div class="col-md-6 text-right" ><?php echo  $activities[$i+1]; ?></div>
              </div>
              <?php $check -= 1; ?>
            <?php endif; ?>
            <hr style="border-width: 0.3em;">
          <?php endfor;?>
        </div>
      </div>

    </div>
  </div>

  <?php include_once('footer.php'); ?>