<?php
session_start();
if (empty($_SESSION['id_users']) || empty($_SESSION['username']) || empty($_SESSION['password'])){
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
    //Import System
    require_once '../../../josys/db_connect.php';
    include_once '../../../josys/class/Database.php';

    $database 	= new Database($db);

	$module	= $_GET['module'];
	$act	= $_GET['act'];

	// Update description
	if ($module=='description' AND $act=='update')
	{
		$id 		= $_POST['id'];
		$content 	= strip_tags(stripslashes(addslashes($_POST['content'])));

    	//data yang akan diupdate berbentuk array
		$form_data = array(
			"static_content" => "$content"
		);

		//proses update ke database
        $database->update($table="modul", $array=$form_data, $fields_key="id_modul", $id=$id);

		echo "<script> window.location = '../../media.php?module=$module';</script>";
	}
	else
	{
		echo "<script>alert('Maaf! Data Gagal Disimpan, Silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
	}

}
?>
