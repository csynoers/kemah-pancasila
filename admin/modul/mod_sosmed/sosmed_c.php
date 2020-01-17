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

$module	= $_GET['module'];
$act	= $_GET['act'];


if($act=='insert')
{
	// Insert
	if ($module=='sosmed' AND $act=='insert')
	{
		$lokasi_file	= $_FILES['fupload']['tmp_name'];
		$tipe_file 		= $_FILES['fupload']['type'];
	  	$nama_file 		= $_FILES['fupload']['name'];

	  	$nama_seo 		= substr(seo($_POST['nama']), 0, 75);
	  	$acak           = rand(000,999);
	  	$nama_file_unik = $nama_seo.'-'.$acak.'-'.$nama_file;

		if(!empty($lokasi_file))
		{

			if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/gif" AND $tipe_file != "image/png"){
				echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File yang di Upload bertipe *.JPG, *.GIF, *.PNG.'); window.location = '../../media.php?module=$module';</script>";
				die();
			}

            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/sosmed/");

		    //data yang akan di insert berbentuk array
			$form_data = array(
			    "nama" 		=> "$_POST[nama]",
			    "link"		=> "$_POST[link]",
			    "gambar" 	=> "$nama_file_unik"
			);

			//proses insert ke database
            $database->insert($table="sosmed", $array=$form_data);
		}
		else
		{
			//data yang akan di insert berbentuk array
			$form_data = array(
			    "nama" 		=> "$_POST[nama]",
			    "link"		=> "$_POST[link]"
			);

			//proses insert ke database
            $database->insert($table="sosmed", $array=$form_data);
		}

		echo "<script>alert('Sukses! Data Telah Berhasil Disimpan.'); window.location = '../../media.php?module=$module';</script>";
	}
	else
	{
		echo "<script>alert('Maaf! Data Gagal Disimpan, Silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
	}
}

if($act=='update')
{
	// Update
	if ($module=='sosmed' AND $act=='update')
	{
	 	$lokasi_file    = $_FILES['fupload']['tmp_name'];
	  	$tipe_file      = $_FILES['fupload']['type'];
	  	$nama_file      = $_FILES['fupload']['name'];

		$nama_seo		= substr(seo($_POST['nama']), 0, 50);
	  	$acak           = rand(000,999);
	  	$nama_file_unik	= $nama_seo.'-'.$acak.'-'.$nama_file;

		if(!empty($lokasi_file))
		{

			if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/gif" AND $tipe_file != "image/png"){
				echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File yang di Upload bertipe *.JPG, *.GIF, *.PNG.'); window.location = '../../media.php?module=$module';</script>";
				die();
			}

            $show   = $database->select($fields="gambar", $table="sosmed", $where_clause="WHERE id_sosmed = '$_POST[id]'", $fetch='');
			if($show['gambar'] != '')
			{
				unlink("../../../joimg/sosmed/$show[gambar]");
			}

            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/sosmed/");

            //data yang akan diupdate berbentuk array
			$form_data = array(
				"nama" 		=> "$_POST[nama]",
				"link"		=> "$_POST[link]",
				"gambar" 	=> "$nama_file_unik"
			);

			//proses update ke database
            $database->update($table="sosmed", $array=$form_data, $fields_key="id_sosmed", $id="$_POST[id]");
		}
		else
		{
			//data yang akan diupdate berbentuk array
			$form_data = array(
				"nama" 		=> "$_POST[nama]",
				"link"		=> "$_POST[link]",
			);

			//proses update ke database
            $database->update($table="sosmed", $array=$form_data, $fields_key="id_sosmed", $id="$_POST[id]");
		}

		echo "<script>alert('Sukses! Data Telah Berhasil Disimpan.'); window.location = '../../media.php?module=$module';</script>";
	}
	else
	{
		echo "<script>alert('Maaf! Data Gagal Disimpan, Silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
	}
}


if($act=='delete')
{
	// Delete
	if ($module=='sosmed' AND $act=='delete')
	{
	//	$show	= db_get_one("SELECT * FROM sosmed WHERE id_sosmed='$_GET[id]'");
        $show   = $database->select($fields="gambar", $table="sosmed", $where_clause="WHERE id_sosmed = '$_GET[id]'", $fetch='');
		if($show['gambar'] != '')
		{
			unlink("../../../joimg/sosmed/$show[gambar]");
            $database->delete($table="sosmed", $fields_key="id_sosmed", $id="$_GET[id]");
		}
		else
		{
            $database->delete($table="sosmed", $fields_key="id_sosmed", $id="$_GET[id]");
		}

		echo "<script>alert('Sukses! Data Telah Berhasil Dihapus.'); window.location = '../../media.php?module=$module';</script>";
	}
	else
	{
		echo "<script>alert('Maaf! Data Gagal Dihapus, Silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
	}
}

}
?>
