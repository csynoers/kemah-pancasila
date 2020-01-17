<?php
include "josys/function/time_load.php";
// include "config.php";
time_load();
//start session
ob_start();
session_start();
// error_reporting(0);
//require Import System files
require_once 'josys/db_connect.php';
include_once 'josys/class/Database.php';
include_once 'josys/class/Rupiah.php';
include_once 'josys/class/Tanggal.php';
include_once 'josys/function/simple_captcha.php';

$database 	= new Database($db);
$rupiah 	= new Rupiah();
$tgl = new Tanggal();


//Config Website
$config = array();
$config['web_name']     = 'Speak First Klaten';
$config['web_index']    = '/speakfirst';

include "template.php";
ob_end_flush();
?>