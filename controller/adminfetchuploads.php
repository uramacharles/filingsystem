<?php 
    $getter = new uploads;
    $user= $_SESSION["file_adminId"];

 ?>
<?php  if(isset($_POST["search"])||isset($_SESSION["searchitem"])): ?>
    <?php
        if(isset($_POST["search"])){
            $terms = filter_input(INPUT_POST, "searchitem");
        }else{
            $terms = $_SESSION["searchitem"];
        }
        $_SESSION['category'] = "search";
        $getter->setText("searchitem",$terms);
        $pageControl = $getter->getConditionedPageVariables("uploads","WHERE file_user = '$user'");
        $up_array = $getter->relayuploads();
        //This is to trace the type of publications that will be returned to ease pagination
    ?>
<?php elseif(isset($_GET["ct"])): ?>
<?php 
        $_SESSION["ct"] = $titl = htmlentities(filter_input(INPUT_GET, "ct"));
        $_SESSION['category'] = $titl;
        $getter->setText("category",$titl);
        $pageControl = $getter->getConditionedPageVariables("uploads","WHERE file_user = '$user' AND category = '$titl'");
        $up_array = $getter->relayuploads();
        //This is to trace the type of publications that will be returned to ease pagination
 ?>    
<?php else: ?>
<?php
    $_SESSION['category'] = "all";
    $pageControl = $getter->getConditionedPageVariables("uploads","WHERE file_user = '$user'");
    $up_array = $getter->relayuploads();
?>
<?php endif; ?>

<?php
        //$this->items = array("id","title","titlelink","confidential","attachment","date_updated");
    $count = count($up_array);
 if(empty($up_array)): ?>
    <h3 style="color: green; padding-bottom: 2em; font-weight: bold;">No upload is added yet. Please do so.</h3>
 <?php else:?>
    <?php $check =0; $numbering = 0; ?>
    <?php for($i=0;$i<=$count-6;$i+=6):?>
        <?php $numbering ++; ?>
        <?php if($check == 0 ):?>
            <div class="container col-md-12 fetchsubscribers1">
                <div class="col-md-1">
                    <?php echo $numbering; ?>
                    <?php if ($up_array[$i+3] =="YES"): ?>
                        <i class="fa fa-lock"></i>
                    <?php else: ?>
                        <i class="fa fa-unlock"></i>
                    <?php endif ?>
                </div>
                <div class="col-md-5" ><?php echo  $up_array[$i+1]; ?></div>

                <div class="col-md-2">
                    <form method="POST" action="<?php $_PHP_SELF; ?>" >
                        <input type="hidden" name="file_id" value="<?php echo $up_array[$i]; ?>" />
                        <input type="hidden" name="file_prone" value="<?php echo $up_array[$i+3]; ?>" />
                        <input type="hidden" name="file_address" value="<?php echo $up_array[$i+4]; ?>" />
                        <button type="submit" name="view_upload" class="btn btn-style-two fa fa-eye">View File</button>
                    </form>
                </div>
                <div class="col-md-2">
                    <form method="POST" action="<?php $_PHP_SELF; ?>" >
                        <input type="hidden" name="file_id" value="<?php echo $up_array[$i]; ?>" />
                        <input type="hidden" name="file_prone" value="<?php echo $up_array[$i+3]; ?>" />
                        <input type="hidden" name="file_address" value="<?php echo $up_array[$i+4]; ?>" />
                        <button type="submit" name="download_upload" class="btn btn-style-two fa fa-download">Download</button>
                    </form>
                </div>
                <div class="col-md-1">
                    <form method="POST" action="<?php $_PHP_SELF; ?>" >
                        <input type="hidden" name="file_id" value="<?php echo $up_array[$i]; ?>" />
                        <input type="hidden" name="file_prone" value="<?php echo $up_array[$i+3]; ?>" />
                        <button type="submit" name="delete_upload" class="btn btn-style-one">Delete</button>
                    </form>
                </div>
                <div>
                    <form action="<?php $_PHP_SELF; ?>" method="POST" id="fileform">
                        <div class="form-group" style="padding-bottom: 4em">
                            <input type="hidden" name="file_id" value="<?php echo $up_array[$i]; ?>">
                            <button type="submit" name="viewactivity" class="btn btn-primary btn-style-three pull-right lead fa fa-eye" style="color:blue;">View Activities</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php $check += 1; ?>
        <?php else: ?>
            <div class="container col-md-12 fetchsubscribers2">
                <div class="col-md-1">
                    <?php echo $numbering; ?>
                    <?php if ($up_array[$i+3] =="YES"): ?>
                        <i class="fa fa-lock"></i>
                    <?php else: ?>
                        <i class="fa fa-unlock"></i>
                    <?php endif ?>
                </div>
                <div class="col-md-5"><?php echo $up_array[$i+1]; ?></div>
                <div class="col-md-2">
                    <form method="POST" action="<?php $_PHP_SELF; ?>" >
                        <input type="hidden" name="file_id" value="<?php echo $up_array[$i]; ?>" />
                        <input type="hidden" name="file_prone" value="<?php echo $up_array[$i+3]; ?>" />
                        <input type="hidden" name="file_address" value="<?php echo $up_array[$i+4]; ?>" />
                        <button type="submit" name="view_upload" class="btn btn-style-two fa fa-eye">View File</button>
                    </form>
                </div>
                <div class="col-md-2">
                    <form method="POST" action="<?php $_PHP_SELF; ?>" >
                        <input type="hidden" name="file_id" value="<?php echo $up_array[$i]; ?>" />
                        <input type="hidden" name="file_prone" value="<?php echo $up_array[$i+3]; ?>" />
                        <input type="hidden" name="file_address" value="<?php echo $up_array[$i+4]; ?>" />
                        <button type="submit" name="download_upload" class="btn btn-style-two fa fa-download">Download</button>
                    </form>
                </div>
                <div class="col-md-1">
                    <form method="POST" action="<?php $_PHP_SELF; ?>" >
                        <input type="hidden" name="file_id" value="<?php echo $up_array[$i]; ?>" />
                        <input type="hidden" name="file_prone" value="<?php echo $up_array[$i+3]; ?>" />
                        <button type="submit" name="delete_upload" class="btn btn-style-one">Delete</button>
                    </form>
                </div>
                <div>
                    <form action="<?php $_PHP_SELF; ?>" method="POST" id="fileform">
                        <div class="form-group" style="padding-bottom: 4em">
                            <input type="hidden" name="file_id" value="<?php echo $up_array[$i]; ?>">
                            <button type="submit" name="viewactivity" class="btn btn-primary btn-style-three pull-right lead fa fa-eye" style="color:blue;">View Activities</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php $check -= 1; ?>
        <?php endif; ?>
        <hr style="border-width: 0.3em;">
    <?php endfor;?>
<?php endif;?>