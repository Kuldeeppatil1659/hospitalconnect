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

$db=new Database();
$db->open();

$id     = $_REQUEST['id'];
$sql    = "SELECT * FROM `patients` WHERE `id` = ".$id;
$result = $db->query($sql);
$row    = $db->fetchobject($result);

?>
<style>
.c_c{width:350px;height: 350px;}
table td{border: 4px solid #000;}
/*.bg-card {background: #2B8FD1;border: 1px solid #CCC;color:#FFF;}*/
</style>
</head>
<body class="" onload="window.print();">
    <div class="c_c">
    <table border="4" width="100%">
        <thead>
            <tr>
                <td>
                    <div class="col-md-12 border bg-card">
                        <h3 class="title" style="margin-bottom: 0px;font-size: 16px;font-weight: 600;">Health Card</h3>
                        <div class="card-info">
                            <label class="text-left">Health Card No.: <?php echo $row->health_card_no; ?></label> 
                            <label class="text-left">Full Name: <?php echo $row->patient_name; ?></label>
                            <label class="text-left">Aadhar No.: <?php echo $row->aadhar_no; ?></label>
                            <label class="text-left">Address: <?php echo $row->address; ?></label>
                        </div>
                    </div>
                </td>
            </tr>
        </thead>
    </table>
    </div>
</body>
</html>