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
        var patient_id  = document.getElementById("patient_id").value;
        var aadhar_no   = document.getElementById("aadhar_no").value;
                
        if(patient_id=='' && aadhar_no=='')
        {
            alert("Please Enter Patient Health Card No. or Aadhar No.");
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

$msg = "";

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
                <h1>Search Health Card</h1>
              </div>
            </div>
          </div>
        </section>
      </header>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2><strong>Search Health Card</strong></h2>
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Health Card No.</label>
                            <input type="text" id="health_card_no" name="health_card_no" class="form-control" placeholder="Patient Health Card No." value="<?php echo $_POST['health_card_no']; ?>" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Patient Aadhar No.</label>
                            <input type="text" id="aadhar_no" name="aadhar_no" class="form-control" placeholder="Patient Aadhar No." value="<?php echo $_POST['aadhar_no']; ?>"  />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <input type="submit" name="submit" class="btn btn-primary btn-md" value="Search" />
                        </div>
                    </div>
                </div>
            </form>
            <?php
            if($_POST)
            {
                $health_card_no = $_POST['health_card_no'];
                $aadhar_no  = $_POST['aadhar_no'];
                $db=new Database();
                $db->open();
                
                $extraSql = '';
                
                if($health_card_no!='')
                {
                    $extraSql .= " AND `health_card_no` ='".$health_card_no."'";
                }
                
                if($aadhar_no!='')
                {
                    $extraSql .= " AND `aadhar_no` ='".$aadhar_no."'";
                }
        
                $sql    = "SELECT * FROM `patients` WHERE 1 ".$extraSql;
                $result = $db->query($sql);
                $row    = $db->fetchobject($result);
                if($row)
                {
                    ?>
                    <div class="row">
                        <div class="col-md-10">
                            <h3><strong>Patient Info</strong></h3>
                            <hr/>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="text-right">Health Card No.:</label>
                                </div>
                                <div class="col-md-2">
                                    <label>
                                    <?php echo $row->health_card_no; ?>
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label class="text-right">Patient Full Name:</label>
                                </div>
                                <div class="col-md-4">
                                    <label>
                                    <?php echo $row->patient_name; ?>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="text-right">Mobile No.:</label>
                                </div>
                                <div class="col-md-2">
                                    <label>
                                    <?php echo $row->mobile_no; ?>
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label class="text-right">Address:</label>
                                </div>
                                <div class="col-md-4">
                                    <label>
                                    <?php echo $row->address; ?>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="text-right">Aadhar No.:</label>
                                </div>
                                <div class="col-md-2">
                                    <label>
                                    <?php echo $row->aadhar_no; ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <br /><br /><br />
                            <div class="form-group">
                                <a class="btn btn-primary btn-block btn-sm" href="history.php?patient_id=<?php echo $row->id;?>">History</a>
                            </div>
                            <div class="form-group">    
                                <a class="btn btn-primary btn-block btn-sm" href="prescriptions.php?patient_id=<?php echo $row->id;?>">Prescriptions</a>
                            </div>
                            <div class="form-group">    
                                <a class="btn btn-primary btn-block btn-sm" href="javascript:void(0);" onclick="printHealthcard(<?php echo $row->id; ?>)">Print Health Card</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <div class="alert alert-warning" role="alert">
					   <p><strong>Sorry Health Card Not Found.</strong></p>
				    </div>
                    <?php
                }
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
<script type="text/javascript">
function printHealthcard(id)
{
    var url = "print_healthcard.php?id="+id;
    window.open(url, '_blank', 'height=360,width=442');
}
</script>
</body>
</html>