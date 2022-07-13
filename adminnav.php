           <!-- Preloader -->
    <div class="preloader"></div>

  <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle pull-left" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="adminboard.php">Dashboard</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user"></i>Admin  <i class="fa fa-caret-down"></i></a>
          <ul class="dropdown-menu">
            <li><a href="profile.php"><i class="fa fa-eye"></i> View Profile</a></li>
            <li><a href="editadmin.php"><i class="fa fa-eye"></i>Edit Profile</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="adminboard.php"><i class="fa fa-folder"></i> category</a>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-book"></i>  Work Page  <i class="fa fa-caret-down"></i></a>
          <ul class="dropdown-menu">
            <li><a href="documents.php"><i class="fa fa-upload"></i> Work Place </a></li>
            <li><a href="uploads.php"><i class="fa fa-upload"></i> Upload Documents </a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-book"></i>Filter Category  <i class="fa fa-caret-down"></i></a>
          <?php $filter = new documents; $filt = $filter->getcategorypreview(); $con = count($filt); ?>
          <ul class="dropdown-menu">
            <?php for ($p =0;$p<$con;$p++): ?>
              <li><?php echo $filt[$p]; ?></li>
            <?php endfor; ?>
          </ul>
        </li>
        <li class="dropdown ">
            <form method="POST" action="documents.php" id="searchform">
                <div class="form-group" style="padding-top: 1em;padding-left: 0.5em">
                    <input type="search" id="search" name="searchitem" value="" placeholder="Search Now">
                    <button type="submit" name="search"><span class="icon fa fa-search"></span></button>
                </div>
            </form>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown ">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-th"></i></a>
          <ul class="dropdown-menu col-md-2">
            <li>
              <form action="<?php $_PHP_SELF; ?>" method="POST" class="container">
                <button type="submit" class="btn btn-default " name="<?php echo $state;?>"><i class="fa fa-sign-out"></i><?php echo $state;?></button>
              </form>
              </li>
            <li><a href="editadmin.php"> <i class=" glyphicon glyphicon-wrench"></i> Settings</a></li>
          </ul><!-- end dropdown-menu -->
        </li>
        <li>  <a href="<?php $_PHP_SELF; ?>"><i class="fa fa-refresh"></i></a></li>
      </ul>
    </div>
  </div>
</nav>