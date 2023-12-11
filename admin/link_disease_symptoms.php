<!DOCTYPE HTML>
<html class="no-js">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Hospital Connect</title>

<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
<meta name="format-detection" content="telephone=no"/>

<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="../css/style.css" rel="stylesheet" type="text/css"/>
<link href="../plugins/sequence/css/sequence.html" rel="stylesheet" type="text/css"/>
<link href="../plugins/prettyphoto/css/prettyPhoto.css" rel="stylesheet" type="text/css"/>
<link href="../plugins/owl-carousel/css/owl.carousel.css" rel="stylesheet" type="text/css"/>
<link href="../plugins/owl-carousel/css/owl.theme.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../plugins/rs-plugin/css/settings.css" media="screen" />

<!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="../css/ie8.css" media="screen" /><![endif]-->


<link class="alt" href="../colors/blue.css" rel="stylesheet" type="text/css"/>

<script src="../js/modernizr.js"></script>
<script type="text/javascript">
    function validate_form()
    {
        var organ_id = document.getElementById("organ_id").value;
        var symptom_id = document.getElementById("symptom_id").value;
        
        if(organ_id=='')
        {
            alert("Please Select Organ Name.");
            return false;   
        }
        else if(symptom_id=='')
        {
            alert("Please Select Symptom Name.");
            return false;   
        }
    }
</script>

<?php
require_once "adminhelper.php";
$helper = new AdminHelper();

$db = new Database();
$db->open();

if($_SESSION['admin_userid']=='')
{
    echo "<script>window.location='index.php';</script>";
}

$msg = '';
$row = array();

$id = $_REQUEST['id'];

if($_POST)
{
    $msg = $helper->linkSymptoms();
}

$task = $_REQUEST['task'];
if($task=='delete_link')
{
    $delete_id = $_REQUEST['delete_id'];
    $helper->delete_link($delete_id, $id);
}

if($id)
{
    $disease_info = $helper->getDisease($id);
}
?>
        
</head>
<body class="boxed"  style="background-image: url('../images/backgrounds/images/img3.jpg'); background-repeat: no-repeat; background-size: cover;">
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
      <header class="page-header flexible parallax text-align-center parallax-overlay" style="background-image:url(../images/img4.jpg)">
        <section>
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h1>Link Symptoms of <?php echo $disease_info->disease_name; ?></h1>
              </div>
            </div>
          </div>
        </section>
      </header>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h2><strong>Link Symptoms</strong></h2>
            <hr/>
            <?php
            if($msg!='')
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
                    <label>Organ Name</label>
                    <select class="form-control" id="organ_id" name="organ_id">
                        <option value="">Select</option>
                        <?php
                        $sql = "SELECT * FROM `organs`";
                        $result = $db->query($sql);
                        while($row = $db->fetcharray($result))
                        {
                            ?>
                            <option value="<?php echo $row['id'];?>"><?php echo $row['organ_name'];?></option>
                            <?php
                        }
                        ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <label>Symptom Name</label>
                    <select class="form-control" id="symptom_id" name="symptom_id">
                        <option value="">Select</option>
                        <?php
                        $sql = "SELECT * FROM `symptoms`";
                        $result = $db->query($sql);
                        while($row = $db->fetcharray($result))
                        {
                            ?>
                            <option value="<?php echo $row['id'];?>"><?php echo $row['symptom_name'];?></option>
                            <?php
                        }
                        ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="hidden" id="disease_id" name="disease_id" value="<?php echo $id;?>" />
                    <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Save"/>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-8">
            <h2><strong><?php echo $disease_info->disease_name;?> Symptoms</strong></h2>
            <hr />
            <?php
            $helper->getDiseaseSymptoms($id);
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
<script src="../js/jquery-latest.min.js"></script> <!-- Jquery Library Call --> 
<script src="../plugins/prettyphoto/js/prettyphoto.js"></script>
<script src="../plugins/prettyphoto/js/prettyphoto.js"></script>  
<script src="../plugins/owl-carousel/js/owl.carousel.min.js"></script> 
<script src="../plugins/page-scroller/jquery.pagescroller.js"></script> 
<script src="../js/helper-plugins.js"></script> <!-- Plugins --> 
<script src="../js/bootstrap.js"></script> <!-- UI --> 
<script src="../js/init.js"></script> <!-- All Scripts --> 
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