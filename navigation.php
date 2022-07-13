    <body style="">
           <!-- Preloader -->
    <div class="preloader"></div>

     <!-- Main Header / Light Version-->
    <header class="main-header light-version navbar-inverse">
        <!-- Main Box --> 
    	<div class="main-box">
        	<div class="auto-container">
            	<div class="outer-container clearfix">
                    <!--Logo Box-->
                    <div class="container col-md-2 visible-lg visible-md " style="min-height: 5em; overflow-y: hidden;z-index:0;">
                            <a href="index"><figure class="image-box col col-xs-12" style="margin-left: -2em;"><img src="asset/images/banner.png" alt="logo Picture." style="height:6em;"></figure></a>
                    </div> 
                    
                    <!--Nav Outer-->
                    <div class="nav-outer clearfix col-md-10" style="">
                        <!-- Main Menu -->
                        <nav class="main-menu">
                            <div class="navbar-header"  style="position: absolute; top: 2em;">
                                <!-- Toggle Button -->   	
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar" ></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="navbar-collapse collapse clearfix">
                                <form action="<?php $_PHP_SELF; ?>" method="POST" class="container">
                                    <ul class="navigation clearfix"  style="font-size: 10px;">
                                        <li><a href="register.php">Register</a></li>
                                        <li >
                                            <input type="submit" class="btn btn-default " name="<?php echo $state;?>" value="<?php echo $state;?>"/>
                                        </li>
                                     </ul>
                                </form>
                            </div>
                        </nav><!-- Main Menu End-->
                        
                    </div><!--Nav Outer End-->
                    
                    <!-- Hidden Nav Toggler -->
                    <div class="nav-toggler">
                    <button class="hidden-bar-opener"><span class="icon fa fa-bars"></span></button>
                    </div><!-- / Hidden Nav Toggler -->
                    
            	</div>    
            </div>
        </div>
    
    </header>
    <!--End Main Header -->
    
    
    <!-- Hidden Navigation Bar -->
    <section class="hidden-bar right-align">
        
        <div class="hidden-bar-closer">
            <button class="btn"><i class="fa fa-close"></i></button>
        </div>
        
        <!-- Hidden Bar Wrapper -->
        <div class="hidden-bar-wrapper">
    
            <!--Logo Box-->
            <div class="container col-md-2 " style="min-height: 5em; overflow-y: hidden;z-index:0; margin-right:0em;padding-top: 3em;">
                    <a href="index"><figure class="image-box col col-xs-12" style="margin-left: -2em;margin-right: 0em"><img src="asset/images/banner.png" alt="logo Picture." style="height:6em;"></figure></a>
            </div> 
            <!-- .Side-menu -->
            <div class="side-menu">
                <form action="<?php $_PHP_SELF; ?>" method="POST" class="container">
                    <!-- .navigation -->
                    <ul class="navigation">
                        <li><a href="register.php">Register</a></li>
                        <li><input type="submit" class="btn btn-default " name="<?php echo $state;?>" value="<?php echo $state;?>"/></li>
                    </ul>
                </form>
            </div><!-- /.Side-menu -->
        
            <div class="social-icons">
                <ul>
                    <li><a href="https://m.facebook.com/The-House-of-Laws-Firm-202630200461946/"><i class="fa fa-facebook"></i></a></li>
                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                    <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        
        </div><!-- / Hidden Bar Wrapper -->
    </section>
    <!-- / Hidden Bar -->
