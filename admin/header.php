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
            <?php if($_SESSION['admin_userid']) { ?> 
            <li><a href="logout.php" class="">Logout</a></li>
            <?php } else { ?>
            <li><a href="../index.php" class="">Back To Portal</a></li>
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
      <h1 class="logo"> <a href="index.php"> <img src="../images/logo.png" alt="Hospital Connect"/> </a> </h1>
    </div>
    <div class="col-md-9">
      <button class="mmenu-toggle"><i class="fa fa-bars fa-lg"></i></button>
      <nav class="main-menu">
        <ul class="sf-menu" id="main-menu">
            <?php if($_SESSION['admin_userid']) { ?> 
            <li>
                <a href="dashboard.php" class="">Dashboard</a>
                <ul class="dropdown">
                  <li><a href="dashboard.php">Dashboard</a></li>
                  <li><a href="logout.php" class="">Logout</a></li>
                </ul>
            </li>
            <li><a href="doctors.php" class="">Hospital / Doctors</a></li>
            <li><a href="patients.php" class="">Patients</a></li>
            <li>
                <a href="diseases.php" class="">Diseases</a>
                <ul class="dropdown">
                  <li><a href="diseases.php">Diseases</a></li>
                  <li><a href="add_disease.php" class="">Add Disease</a></li>
                </ul>
            </li>
            <li>
                <a href="symptoms.php" class="">Symptoms</a>
                <ul class="dropdown">
                  <li><a href="symptoms.php">Symptoms</a></li>
                  <li><a href="add_symptom.php" class="">Add Symptom</a></li>
                </ul>
            </li>
            <li>
                <a href="organs.php" class="">Organs</a>
                <ul class="dropdown">
                  <li><a href="organs.php">Organs</a></li>
                  <li><a href="add_organ.php" class="">Add Organ</a></li>
                </ul>
            </li>
            <li><a href="logout.php" class="">Logout</a></li>
            <?php } ?>
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