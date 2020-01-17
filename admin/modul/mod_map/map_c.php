<?php
session_start();
if (empty($_SESSION['id_users']) || empty($_SESSION['username']) || empty($_SESSION['password'])){
    echo "
    <center>Untuk mengakses modul, Anda harus login <br>
    <a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
    require_once '../../../josys/db_connect.php';
    include_once '../../../josys/class/Database.php';

    $database 	= new Database($db);

	$module	= $_GET['module'];
	$act	= $_GET['act'];

	// Update map
	if ($module=='map' AND $act=='update')
	{
		$id 		= $_POST['id'];
		$content 	= $_POST['content'];

    	//data yang akan diupdate berbentuk array
		$form_data = array(
			"static_content" => "$content"
		);

		//proses update ke database
        $database->update($table="modul", $array=$form_data, $fields_key="id_modul", $id=$id);

		echo "<script>alert('Sukses! Data Telah Berhasil Disimpan.'); window.location = '../../media.php?module=$module';</script>";
	}
	else
	{
		echo "<script>alert('Maaf! Data Gagal Disimpan, Silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
	}

}
?>
