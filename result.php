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

$diseases = array();
if($_POST)
{
    $questions = $_POST['questions'];
    $organ_id  = $_POST['organ_id'];
    
    $symptoms = array();
    foreach($questions as $question)
    {
        if($_POST['question_'.$question])
        {
            $symptoms[] = $question;
        } 
    }
    
    if($symptoms)
    {
        $sql = "SELECT DISTINCT a.organ_id, a.disease_id, b.id, b.disease_name, b.cause, count(b.id) as count_id 
                FROM `link_symptoms` as a JOIN `diseases` as b ON a.disease_id = b.id
                WHERE a.organ_id = ".$organ_id." AND a.symptom_id IN (".implode(',',$symptoms).") 
                GROUP BY a.disease_id ORDER BY count(b.id) DESC";
        $result = $db->query($sql);
        
        while($row = $db->fetcharray($result))
        {
            $diseases[] = $row;
        }
        
    }
    else
    {
        $msg = 'Sorry, Less Symptoms to predict disease.';
    }
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
                <h1>Checkup Result</h1>
              </div>
            </div>
          </div>
        </section>
      </header>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2><strong>Checkup Result</strong></h2>
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
            
            if($diseases)
            {
                ?>
                <h3>RESULT</h3>
                <p>This result is based on your symptoms.</p>
                <?php
                $i = 0;
                $sr = 1;
                $max_count = $diseases[0]['count_id'];
                foreach($diseases as $disease)
                {
                    if($i!=0)
                    {
                        if($max_count == $diseases[$i]['count_id'])
                        {
                            ?>
                            <hr />
                            <h3><?php echo $sr; ?>. Prediction of Disease</h3>
                            <div class="alert alert-warning">
                                <p><strong><?php echo $disease['disease_name'] ?></strong></p>
                            </div>
                            <h3>Cause</h3>
                            <div class="alert alert-info">
                                <p><strong><?php echo $disease['cause'] ?></strong></p>
                            </div>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <h3><?php echo $sr; ?>. Prediction of Disease</h3>
                        <div class="alert alert-warning">
                            <p><strong><?php echo $disease['disease_name'] ?></strong></p>
                        </div>
                        <h3>Cause</h3>
                        <div class="alert alert-info">
                            <p><strong><?php echo $disease['cause'] ?></strong></p>
                        </div>
                        <?php
                    }
                    $sr++;
                    $i++;
                }
            }
            ?>
            
          </div>
          <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h3>Recommended Doctors</h3>
                </div>
              <?php
              if($organ_id)
              {
                $sql = "SELECT * FROM users where `doctor_speciality` = ".$organ_id;
                $result = $db->query($sql);
                $city_array = array('1'=>'Kolhapur', '2'=>'Nipani');
                while($row = $db->fetcharray($result))
                {
                    $image = 'images/avatar_icon.jpg';
                    if($row['photo']!='')
                    {
                        $image = 'photos/'.$row['photo'];
                    }
                    ?>
                    <div class="col-md-6">
                        <article class="post">
                            <div class="row">
                                <section class="col-md-3 col-sm-6">
                                    <img src="<?php echo $image; ?>" alt=""/> 
                                </section>
                                <section class="col-md-9 col-sm-6">
                                    <h3 class="margin-10"><?php echo $row['hospital_name'];?></h3>
                                    <div class="blog-post-content">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <ul class="unordered">
                                                  <li>Doctor Name: <?php echo $row['doctor_name'];?></li> 
                                                  <li>Hospital Phone: <?php echo $row['hospital_phone']; ?></li>
                                                  <li>City: <?php echo $city_array[$row['hospital_city']];?></li>
                                                  <li>Address: <?php echo $row['hospital_address'];?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </article>
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