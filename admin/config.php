<?php
//Import System
require_once '../josys/db_connect.php';
include_once '../josys/class/Database.php';
include_once '../josys/class/Security.php';
include_once '../josys/class/Tanggal.php';

$database 	= new Database($db);
$security   = new Security();

//Config Name Admin Panel
$config = array();
$config['web_name']     = 'Kemah Pancasila';
$config['web_index']    = '../';
?>