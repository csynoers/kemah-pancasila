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
include_once '../../../josys/class/Upload.php';
include_once '../../../josys/function/Seo.php';

$database 	= new Database($db);
$upload     = new Upload();

$module	    = $_GET['module'];
$act        = $_GET['act'];

	if($act == 'update'){
		// Update
		if ($module=='profile' AND $act=='update'){

		 	$id_users		= $_POST['id'];

			$lokasi_file 	= $_FILES['fupload']['tmp_name'];
			$tipe_file		= $_FILES['fupload']['type'];
			$nama_file     	= $_FILES['fupload']['name'];

			$acak           	= rand(000,999);
			$nama_seo			= substr(seo($_POST['full_name']), 0 ,50);
			$nama_file_unik 	= $nama_seo.'-'.$acak.'-'.$nama_file;

			if(!empty($lokasi_file)){

				if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/gif" AND $tipe_file != "image/png"){
					echo "<script>alert('Maaf! Upload Gagal, Pastikan File yang di Upload bertipe *.JPG, *.GIF, *.PNG.'); window.location = '../../media.php?module=$module';</script>";
				}

                $view = $database->select($fields="*", $table="users", $where_clause="WHERE id_users='$id_users'");
				//$tampil=mysql_query("SELECT * FROM users WHERE id_users='$id_users'");
				///$ex=mysql_fetch_array($tampil);

					if($view['foto'] != ''){
						unlink("../../assets/img/profile/".$view['foto']);
						unlink("../../assets/img/profile/thumbnail/".$view['foto']);
					}

				//Proses Upload Image
				$upload->berkas($fileName=$nama_file_unik, $fileDirectory='../../assets/img/profile/');//ImageUpload($fupload_name=$nama_file_unik, $to_dir=);

				// Proses Resize image
                $upload->thumbnail($imageName=$nama_file_unik, $imageDirectory='../../assets/img/profile/', $thumbDirectory='../../assets/img/profile/thumbnail/', $thumbWidth='150');
				//ImageResize($fupload_name=$nama_file_unik, $from_dir='../../assets/img/profile/', $to_dir='../../assets/img/profile/small/', $resize='150');

				//data yang akan diupdate berbentuk array
				$form_data = array(
					"foto" 			=> "$nama_file_unik",
				    "nama_lengkap" 	=> "$_POST[full_name]",
				    "email" 		=> "$_POST[email]",
				    "no_telp" 		=> "$_POST[phone]"
				);

				//proses update ke database
                $database->update($table="users", $array=$form_data, $fields_key="id_users", $id=$id_users);
			}
			else{
				//data yang akan diupdate berbentuk array
				$form_data = array(
				    "nama_lengkap" 	=> "$_POST[full_name]",
				    "email" 		=> "$_POST[email]",
				    "no_telp" 		=> "$_POST[phone]"
				);

				//proses update ke database
                $database->update($table="users", $array=$form_data, $fields_key="id_users", $id=$id_users);
			}

			echo "<script>window.location = '../../media.php?module=$module';</script>";
		}
		else{
			echo "<script>alert('Maaf! Data Gagal Disimpan, Silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
		}
	}
}
