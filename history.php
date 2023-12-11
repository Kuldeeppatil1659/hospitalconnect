<!DOCTYPE HTML>
<html class="no-js">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Hospital Connect</title>

<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
<meta name="format-detection" content="telephone=no"/>

<link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<link href="plugins/sequence/css/sequence.html" rel="stylesheet" type="text/css"/>
<link href="plugins/prettyphoto/css/prettyPhoto.css" rel="stylesheet" type="text/css"/>
<link href="plugins/owl-carousel/css/owl.carousel.css" rel="stylesheet" type="text/css"/>
<link href="plugins/owl-carousel/css/owl.theme.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="plugins/rs-plugin/css/settings.css" media="screen" />

<!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="css/ie8.css" media="screen" /><![endif]-->


<link class="alt" href="colors/blue.css" rel="stylesheet" type="text/css"/>

<script src="js/modernizr.js"></script>

<script type="text/javascript">
    function validate_form()
    {
        var date    = document.getElementById("date").value;
        var history = document.getElementById("history").value;
                
        if(date=='')
        {
            alert("Please Enter Date.");
            return false;   
        }
        else if(history=='')
        {
            alert("Please Enter History");
            return false;   
        }
    } 
</script>
<?php
require_once "healthhelper.php";
$helper = new HealthHelper();

$msg = '';
if($_SESSION['userid']=='')
{
    echo "<script>window.location='login.php';</script>";
}

$patient_id = $_REQUEST['patient_id'];
if($patient_id)
{
    $row = $helper->getPatientInfo($patient_id);
}

if($_POST)
{
    $msg = $helper->addHistory();
}
?>
        
</head>
<body class="boxed"  style="background-image: url('images/backgrounds/images/img3.jpg'); background-repeat: no-repeat; background-size: cover;">
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]--> 
<!-- Preloader -->
<div id="preloader">
  <div id="status"></div>
</div>

<!-- Start Body Container -->
<div class="body footer-style2"> 
  <!-- Start Header -->
  <?php
    require_once "header.php";
  ?>
  <!-- End Header --> 
  
  <!-- Start Content -->
  <div class="main" role="main">
    <div id="content" class="content page-content full">
      <header class="page-header flexible parallax text-align-center parallax-overlay" style="background-image:url(images/img4.jpg)">
        <section>
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h1>History</h1>
              </div>
            </div>
          </div>
        </section>
      </header>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h2><strong>Add History</strong></h2>
            <hr/>
            <?php
            if($msg != '')
            {
                ?>
                <div class="alert alert-info" role="alert">
					<h3 style="text-transform: none;"><?php echo $msg; ?></h3>
				</div>
                <?php
            }
            ?>
            <form method="post" action="" onsubmit="return validate_form();">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Patient Health No.</label>
                            <input type="text" id="health_card_no" name="health_card_no" class="form-control input-lg" placeholder="Patient Health Card No." readonly="" value="<?php echo $row->health_card_no; ?>" />
                            <input type="hidden" id="patient_id" name="patient_id" class="form-control input-lg" placeholder="Patient Health Card No." readonly="" value="<?php echo $row->id; ?>" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Patient Full Name</label>
                            <input type="text" id="patient_name" name="patient_name" class="form-control input-lg" placeholder="Patient Full Name" readonly="" value="<?php echo $row->patient_name; ?>" />
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Date (DD/MM/YYYY)</label>
                            <input type="text" id="date" name="date" class="form-control input-lg" placeholder="Date" value="<?php echo date('d/m/Y');?>" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Patient History</label>
                            <textarea id="history" name="history" class="form-control input-lg" placeholder="Patient History"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Save" />
                        </div>
                    </div>
                </div>
            </form>
          </div>
          <div class="col-md-8">
            <h2>
                <strong>History</strong>
                <a class="btn btn-primary btn-sm pull-right" href="prescriptions.php?patient_id=<?php echo $patient_id;?>">Prescriptions</a>
            </h2>
            <hr/>
            <?php
            if($patient_id)
            {
                $helper->getPatientHistory($patient_id);
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <?php
    require_once "footer.php";
  ?>
</div>  
<!-- End Body Container --> 
<script src="js/jquery-latest.min.js"></script> <!-- Jquery Library Call --> 
<script src="plugins/prettyphoto/js/prettyphoto.js"></script>
<script src="plugins/prettyphoto/js/prettyphoto.js"></script>  
<script src="plugins/owl-carousel/js/owl.carousel.min.js"></script> 
<script src="plugins/page-scroller/jquery.pagescroller.js"></script> 
<script src="js/helper-plugins.js"></script> <!-- Plugins --> 
<script src="js/bootstrap.js"></script> <!-- UI --> 
<script src="js/init.js"></script> <!-- All Scripts --> 
<!-- Preloader --> 
<script type="text/javascript">
	//<![CDATA[
		$(window).load(function() { // makes sure the whole site is loaded
			$("#status").fadeOut(); // will first fade out the loading animation
			$("#preloader").delay(350).fadeOut("slow"); // will fade out the white DIV that covers the website.
		});
	//]]>
</script> 
<!-- End Js --> 
</body>
</html>