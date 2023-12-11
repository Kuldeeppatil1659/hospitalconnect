<?php
error_reporting(0);
require_once "adminhelper.php";
$helper = new AdminHelper();
if($_POST)
{
    $r = $helper->checkLogin();
    if($r)
    {
        $_SESSION['admin_userid']    = $r->id;
        $_SESSION['admin_username']  = $r->username;
        echo "<script>window.location='dashboard.php';</script>";
    }
    else
    {
        $_SESSION['admin_userid']='';
        $_SESSION['admin_username']='';
        echo "<script>window.location='index.php?error=1';</script>";
    }
}
?>    

