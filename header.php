<div class="topbar hidden-sm hidden-xs">
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <nav class="secondary-menu">
        <ul class="pull-left">
          <li><a href="#"><i class="fa fa-lg fa-twitter"></i></a></li>
          <li><a href="#"><i class="fa fa-lg fa-facebook"></i></a></li>
          <li><a href="#"><i class="fa fa-lg fa-google-plus"></i></a></li>
        </ul>
      </nav>
    </div>
    <div class="col-md-6">
      <nav class="secondary-menu">
        <ul class="pull-right">
            <?php if(!$_SESSION['userid']) { ?> 
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="admin">Admin Login</a></li>
            <?php }else{ ?>
            <li><a href="logout.php" class="">Logout</a></li>
            <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
</div>
</div>
<header class="site-header" id="sticky-nav">
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <h1 class="logo"> <a href="index.php"> <img src="images/logo.png" alt="Health Card"/> </a> </h1>
    </div>
    <div class="col-md-9">
      <button class="mmenu-toggle"><i class="fa fa-bars fa-lg"></i></button>
      <nav class="main-menu">
        <ul class="sf-menu" id="main-menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About Us</a></li>
            <?php if(!$_SESSION['userid']) { ?> 
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            <?php }else{ ?>
            <li>
                <a href="dashboard.php" class="">Dashboard</a>
                <ul class="dropdown">
                  <li><a href="dashboard.php">Dashboard</a></li>
                  <li><a href="generate_healthcard.php">Generate Health Card</a></li>
                  <li><a href="search_healthcard.php">Search Health Card</a></li>
                  <li><a href="logout.php" class="">Logout</a></li>
                </ul>
            </li>
            <?php } ?>
            <li><a href="contactus.php">Contact Us</a></li>
        </ul>
      </nav>
    </div>
  </div>
</div>

<nav class="mobile-menu">
  <div class="container">
    <div class="row"></div>
  </div>
</nav>
</header>