<?php
    $fetch = new register;
    $results = $fetch->adminFetchProfile();
    //$this->items = array("id","name","username1","username2","date","email","chamber_name","imagepath","description");
?>
<div class="container">
    <div class="container">
        <div class="col-sm-5 wow fadeIn">
            <h2 class="page-header text-center" style="margin: 30px 20px"><span class="fa fa-edit"></span> Edit First Username And Password</h2>
            <div class="well w3-card-24">
                <div class="contact-form default-form">
                    <form method="post" action="<?php $_PHP_SELF; ?>" >
                        <div class="row clearfix">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                                <label>Username</label>
                                <input type="text" name="username" value="<?php echo $results[2];?>" placeholder="Username *">
                            </div>

                            <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                                <label>Old Password</label>
                                <input type="password" name="old_password" value="" placeholder="Old Password *">
                            </div>

                            <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                                <label>New Password</label>
                                <input type="password" name="new_password" value="" placeholder="New Password *">
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <div class="text-center"><button type="submit" name="changefirst" class="theme-btn btn-style-one">Make Change To The First Password</button></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-5 wow fadeIn">
            <h2 class="page-header text-center" style="margin: 30px 20px"><span class="fa fa-edit"></span> Edit Second Username And Password</h2>
          <div class="well w3-card-24">
            <div class="contact-form default-form">
                <form method="post" action="<?php $_PHP_SELF; ?>" >
                    <div class="row clearfix">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                            <label>Username</label>
                            <input type="text" name="username" value="<?php echo $results[3];?>" placeholder="Username *">
                        </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                            <label>Old Password</label>
                            <input type="password" name="old_password" value="" placeholder="Old Password *">
                        </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                            <label>New Password</label>
                            <input type="password" name="new_password" value="" placeholder="New Password *">
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <div class="text-center"><button type="submit" name="changesecond" class="theme-btn btn-style-one">Make Change To The Second Password</button></div>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
    <div class="container">
        <div class="col-sm-5 wow fadeIn">
            <h2 class="page-header text-center" style="margin: 30px 20px"><span class="fa fa-edit"></span> Edit Name And Description</h2>
          <div class="well w3-card-24">
            <div class="contact-form default-form">
                <form method="post" action="<?php $_PHP_SELF; ?>" >
                    <div class="row clearfix">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                            <label>Name:</label>
                            <input type="text" name="name" value="<?php echo $results[1];?>" placeholder="Name *">
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                            <label>Chamber Name:</label>
                            <input type="text" name="chamber_name" value="<?php echo $results[6];?>" placeholder="Name *">
                        </div>


                        <?php 
                              // Create a file to add the information in it. This will help us pre feed the iframe with the data for editing.
                            $fd = new register;
                            $p = array('workdata');
                            $pt = $fd->createDirectory($p);
                              $filename = $pt."/editable.php";
                              if(file_exists($filename)){
                                unlink($filename);
                              }
                              $file = fopen($filename, "w");
                              fwrite($file, $results[8]);
                        ?>

                        <!--This is the template of the Text Editor-->
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 " onload="iFrameOn()">
                          <label>Short description *</label>
                          <div id="edit_cb" style="width: 100%;padding: 1px">
                            <input type="button" onclick="iBold()" value="B"  class="btn btn-success"/>
                            <input type="button" onclick="iItalic()" value="I" class="btn btn-success"/>
                            <input type="button" onclick="iUnderline()" value="U" class="btn btn-success"/>
                            <input type="number" id="FontSize" onclick ="iFontSize()" style="width: 4em;" />
                            <input type="button" onclick="iForeColor()" value="Color" class="btn btn-success"/>
                            <input type="button" onclick="iHorizontalRule()" value="HR" class="btn btn-success"/>
                            <input type="button" onclick="iUnorderedList()" value="Ul" class="btn btn-success"/>
                            <input type="button" onclick="iOrderedList()" value="Ol" class="btn btn-success"/>
                            <input type="button" onclick="iLink()" value="link" class="btn btn-success"/>
                            <input type="button" onclick="iUnlink()" value="unlink" class="btn btn-success"/>
                            <input type="button" onclick="iImage()" value="image" class="btn btn-success"/>
                          </div>
                            <textarea style="display: none;" name="description" id="description" placeholder="Description" tabindex="2" required="required" rows="10"></textarea>
                            <iframe class="form-control" style="width:100%;border-width: 1px;border-color: blue; min-height: 20em;" name="textEdit" id="textEdit" src="workdata/editable.php"></iframe>
                        </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <div class="text-center"><button type="submit" name="details" class="theme-btn btn-style-one">Save Changes</button></div>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
        <div class="col-sm-5 wow fadeIn">
            <h2 class="page-header text-center" style="margin: 30px 20px"><span class="fa fa-edit"></span> Edit Email</h2>
            <div class="well w3-card-24">
                <div class="contact-form default-form">
                    <form method="post" action="<?php $_PHP_SELF; ?>" >
                        <div class="row clearfix">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                            	<label>Email:</label>
                                <input type="text" name="email" value="<?php echo $results[5];?>" placeholder="Email *">
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <div class="text-center"><button type="submit" name="changeemail" class="theme-btn btn-style-one">Change Recovery Email</button></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5 wow fadeInBig">
            <hr style="border-width: 1em; border-color:red;" />
            <h2 class="page-header text-center" style="margin: 30px 20px"><span class="fa fa-edit"></span>Change Picture:</h2>
            <div class="well w3-card-24" style="min-height: 10em;">
                <div class="contact-form default-form">
                    <form method="POST" action="<?php $_PHP_SELF; ?>" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Picture*</label>
                          <input type="file" id="images" class="hidden form-control" name="admin_image" accept=".jpg, .png, .jpeg, .gif">
                          <label for="images" class="btn btn-style-two btn-md" >Select picture</label>
                        </div>                        
                        <div class="form-group">
                            <button type="submit" name="savenewpix" class="btn btn-style-five btn-md pull-right lead">Change Picture</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>