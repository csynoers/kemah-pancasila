<?php
session_start();
if (empty($_SESSION['id_users']) || empty($_SESSION['username']) || empty($_SESSION['password'])){
    echo "
    <center>Untuk mengakses modul, Anda harus login <br>
    <a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
//Import System
require_once '../../../josys/db_connect.php';
include_once '../../../josys/class/Database.php';
include_once '../../../josys/function/Seo.php';
include_once '../../../josys/class/Upload.php';

$database 	= new Database($db);
$upload     = new Upload();

$database 	= new Database($db);

$module	= $_GET['module'];
$act	= $_GET['act'];



if($act=='update')
{
	// Update
	if ($module=='kontak' AND $act=='update')
	{
		
			
		//data yang akan diupdate berbentuk array
		$form_data = array(
			"judul"			=> "$_POST[title]"
		);

		//proses update ke database
	    $database->update($table="kontak", $array=$form_data, $fields_key="id_kontak", $id="$_POST[id]");
		

		echo "<script> window.location = '../../media.php?module=$module';</script>";
	}
	else
	{
		echo "<script>alert('Maaf! Data Gagal Disimpan, Silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
	}
}




}
?>
