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
include_once '../../../josys/class/Security.php';

$database 	= new Database($db);
$security   = new Security();

//include "../../../josys/koneksi.php";
//include "../../../josys/helper.php";

	$module	= $_GET['module'];
	$act	= $_GET['act'];

	if($act == 'update'){
		// Update video
		if ($module=='login' AND $act=='update'){

		 	$id_users		= $_POST['id'];
		 	$username		= $security->anti_injection($_POST['username']);
		 	$oldpassword	= $security->enkrip($security->anti_injection($_POST['oldpassword']));
		 	$newpassword1	= $security->anti_injection($_POST['newpassword1']);
		 	$newpassword2	= $security->anti_injection($_POST['newpassword2']);

			if($newpassword1 == $newpassword2) {
					//Proses pengambilan 1 data
                    $users = $database->select($fields="*", $table="users", $where_clause="WHERE id_users = '$id_users'", $fetch="");
                    //var_dump($users);exit();
					//$users = db_get_one("SELECT * FROM users WHERE id_users = '$id_users' ");

					if($users['password'] == $oldpassword) {

						$newpassword 	= $security->enkrip($newpassword1);

						//data yang akan diupdate berbentuk array
						$form_data = array(
						   "username" => "$username",
						    "password" => "$newpassword"
						);

						//proses update ke database
						$database->update($table="users", $array=$form_data, $fields_key="id_users", $id=$id_users);

						echo "<script>alert('Sukses! Data Telah Berhasil Disimpan.'); window.location = '../../media.php?module=$module';</script>";
					}
					else{
						echo "<script>alert('Maaf ! Password lama dan Password baru tidak sesuai. Silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
					}
			}
			else {
				echo "<script>alert('Maaf ! Password Baru dan Konfirmasi password baru tidak sesuai. Silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
			}

		}
		else{
			echo "<script>alert('Maaf! Data Gagal Disimpan, Silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
		}
	}

}
?>
