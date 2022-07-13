<?php 
    $getter = new documents;
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
        $pageControl = $getter->getConditionedPageVariables("documents","WHERE file_user = '$user'");
        $doc_array = $getter->relayDocuments();
        //This is to trace the type of publications that will be returned to ease pagination
    ?>
<?php elseif(isset($_GET["ct"])): ?>
<?php 
        $_SESSION["ct"] = $titl = htmlentities(filter_input(INPUT_GET, "ct"));
        $_SESSION['category'] = $titl;
        $getter->setText("category",$titl);
        $pageControl = $getter->getConditionedPageVariables("documents","WHERE file_user = '$user' AND category = '$titl'");
        $doc_array = $getter->relayDocuments();
        //This is to trace the type of publications that will be returned to ease pagination
 ?>    
<?php else: ?>
<?php
    $_SESSION['category'] = "all";
    $pageControl = $getter->getConditionedPageVariables("documents","WHERE file_user = '$user'");
    $doc_array = $getter->relayDocuments();
?>
<?php endif; ?>

<?php
    //$tems = array("id","title","titlelink","confidential","date_updated");
    $count = count($doc_array);
 if(empty($doc_array)): ?>
    <h3 style="color: green; padding-bottom: 2em; font-weight: bold;">No document is added yet. Please do so.</h3>
 <?php else:?>
    <?php $check =0; $numbering = 0; ?>
    <?php for($i=0;$i<=$count-5;$i+=5):?>
        <?php $numbering ++; ?>
        <?php if($check == 0 ):?>
            <div class="container col-md-12 fetchsubscribers1">
                <div class="col-md-1"><?php echo $numbering; ?></div>
                <div class="col-md-6" ><?php echo  $doc_array[$i+1]; ?></div>
                <div class="col-md-1">
                    <?php if ($doc_array[$i+3] =="YES"): ?>
                        <i class="fa fa-lock"></i>
                    <?php else: ?>
                        <i class="fa fa-unlock"></i>
                    <?php endif ?>
                </div>

                <div class="col-md-2">
                    <form method="POST" action="<?php $_PHP_SELF; ?>" >
                        <input type="hidden" name="file_address" value="<?php echo $doc_array[$i+2]; ?>" />
                        <input type="hidden" name="file_id" value="<?php echo $doc_array[$i]; ?>" />
                        <input type="hidden" name="file_prone" value="<?php echo $doc_array[$i+3]; ?>" />
                        <button type="submit" name="edit_document" class="btn btn-style-four">View File</button>
                    </form>
                </div>
                <div class="col-md-1">
                    <form method="POST" action="<?php $_PHP_SELF; ?>" >
                        <input type="hidden" name="file_id" value="<?php echo $doc_array[$i]; ?>" />
                        <input type="hidden" name="file_prone" value="<?php echo $doc_array[$i+3]; ?>" />
                        <button type="submit" name="delete_document" class="btn btn-style-one">Delete</button>
                    </form>
                </div>
            </div>
            <?php $check += 1; ?>
        <?php else: ?>
            <div class="container col-md-12 fetchsubscribers2">
                <div class="col-md-1"><?php echo $numbering; ?></div>
                <div class="col-md-6"><?php echo $doc_array[$i+1]; ?></div>
                <div class="col-md-1">
                    <?php if ($doc_array[$i+3] =="YES"): ?>
                        <i class="fa fa-lock"></i>
                    <?php else: ?>
                        <i class="fa fa-unlock"></i>
                    <?php endif ?>
                </div>
                <div class="col-md-2">
                    <form method="POST" action="<?php $_PHP_SELF; ?>" >
                        <input type="hidden" name="file_address" value="<?php echo $doc_array[$i+2]; ?>" />
                        <input type="hidden" name="file_id" value="<?php echo $doc_array[$i]; ?>" />
                        <input type="hidden" name="file_prone" value="<?php echo $doc_array[$i+3]; ?>" />
                        <button type="submit" name="edit_document" class="btn btn-style-four">View File</button>
                    </form>
                </div>
                <div class="col-md-1">
                    <form method="POST" action="<?php $_PHP_SELF; ?>" >
                        <input type="hidden" name="file_id" value="<?php echo $doc_array[$i]; ?>" />
                        <input type="hidden" name="file_prone" value="<?php echo $doc_array[$i+3]; ?>" />
                        <button type="submit" name="delete_document" class="btn btn-style-one">Delete</button>
                    </form>
                </div>
            </div>
            <?php $check -= 1; ?>
        <?php endif; ?>
        <hr style="border-width: 0.3em;">
    <?php endfor;?>
<?php endif;?>