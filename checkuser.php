<?php
error_reporting(0);
require_once "healthhelper.php";
$helper = new HealthHelper();
if($_POST)
{
    $r = $helper->checkLogin();
    if($r)
    {
        $_SESSION['userid']    = $r->id;
        $_SESSION['username']  = $r->username;
        echo "<script>window.location='dashboard.php';</script>";
    }
    else
    {
        $_SESSION['userid']='';
        $_SESSION['username']='';
        echo "<script>window.location='login.php?error=1';</script>";
    }
}
?>    

