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
<?php
require_once "healthhelper.php";
$helper = new HealthHelper();

$db = new Database();
$db->open();

$organ_id = $_POST['organ_id'];

if(!$organ_id)
{
    echo "<script>window.location='start_checkup.php';</script>";
}

$sql = "SELECT DISTINCT a.organ_id, a.disease_id, b.id, b.symptom_name, count(b.id) as count_id FROM `link_symptoms` as a JOIN `symptoms` as b ON a.symptom_id = b.id WHERE a.organ_id = ".$organ_id." GROUP BY b.id ORDER BY count(b.id) DESC  LIMIT 0,20";
$result = $db->query($sql);
$questions = array();
while($row = $db->fetcharray($result))
{
    $questions[] = $row;
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
                <h1>Start Checkup</h1>
              </div>
            </div>
          </div>
        </section>
      </header>
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <h2><strong>Start Checkup</strong></h2>
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
            <form method="post" action="result.php">
              <div class="row">
                <div class="form-group">
                    <?php 
                    if($questions)
                    {
                        foreach($questions as $question)
                        {
                            ?>
                            <div class="col-md-8">
                                <label>Do you have  &nbsp"<?php echo htmlentities($question['symptom_name']);?>"?</label>
                                <input type="hidden" name="questions[]" value="<?php echo $question['id'] ?>" />
                            </div>
                            <div class="col-md-4">
                                <div class="radio-inline">
                                    <label><input type="radio" name="question_<?php echo $question['id'] ?>" id="question_<?php echo $question['id'] ?>" value="1" required="" /> Yes</label>
                                </div>
                                 <div class="radio-inline">
                                    <label><input type="radio" name="question_<?php echo $question['id'] ?>" id="question_<?php echo $question['id'] ?>" value="0"  required="" /> No</label>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="hidden" id="organ_id" name="organ_id" value="<?php echo $organ_id;?>" />
                    <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Submit"/>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- Start Sidebar -->
          <aside class="col-md-3 sidebar right-sidebar">
            
            
          </aside>
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