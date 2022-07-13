<?php
	$getter = new category;
	$id = $_SESSION["file_adminId"];
	$pageControl = $getter->getConditionedPageVariables("category","WHERE file_user = '$id'");
	$category = $getter->getcategory();
	$tems = array("id","name","planename");
	$count = count($category);
 if(empty($category)): ?>
 	<h3 style="color: green; padding-bottom: 2em; font-weight: bold;">No category is added yet. Please do so.</h3>
 <?php else:?>
 	<?php $check =0; $numbering = 0; ?>
	<?php for($i=0;$i<=$count-3;$i+=3):?>
		<?php $numbering ++; ?>
		<?php if($check == 0 ):?>
			<div class="container col-md-12 fetchsubscribers1">
				<div class="col-md-1"><?php echo $numbering; ?></div>
				<div class="col-md-9" ><?php echo  $category[$i+2]; ?></div>
				<div class="col-md-2">
					<form method="POST" action="<?php $_PHP_SELF; ?>" >
						<input type="hidden" name="categoryid" value="<?php echo $category[$i]; ?>" />
						<button type="submit" name="delete_category" class="btn btn-style-one">Delete</button>
					</form>
				</div>
			</div>
			<?php $check += 1; ?>
		<?php else: ?>
			<div class="container col-md-12 fetchsubscribers2">
				<div class="col-md-1"><?php echo $numbering; ?></div>
				<div class="col-md-9"><?php echo $category[$i+2]; ?></div>
				<div class="col-md-2">
					<form method="POST" action="<?php $_PHP_SELF; ?>" >
						<input type="hidden" name="categoryid" value="<?php echo $category[$i]; ?>" />
						<button type="submit" name="delete_category" class="btn btn-style-one">Delete</button>
					</form>
				</div>
			</div>
			<?php $check -= 1; ?>
		<?php endif; ?>
		<hr style="border-width: 0.3em;">
	<?php endfor;?>
<?php endif;?>