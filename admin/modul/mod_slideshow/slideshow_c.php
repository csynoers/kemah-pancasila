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


if($act=='updateTitle')
{
	if ($module=='slideshow' AND $act=='updateTitle')
	{
			$form_data = array(
			    "title2" 		=> "$_POST[title2]",
			    "title3"		=> "$_POST[title3]"
			);

			$database->update($table="slide_title", $array=$form_data, $fields_key="id_slide_title", $id="$_POST[id]");
	}

	echo "<script>alert('Sukses! Data Telah Berhasil Disimpan.'); window.location = '../../media.php?module=$module';</script>";
}

if($act=='insert')
{
	// Insert
	if ($module=='slideshow' AND $act=='insert')
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

			$upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/slide/");

		    //data yang akan di insert berbentuk array
			$form_data = array(
			    "nama" 		=> "$_POST[nama]",
			    "kat"		=> "$_POST[kat]",
			    "gambar" 	=> "$nama_file_unik"
			);

			//proses insert ke database
            $database->insert($table="slide", $array=$form_data);
		}
		else
		{
			//data yang akan di insert berbentuk array
			$form_data = array(
			    "nama" 		=> "$_POST[nama]",
			    "kat"		=> "$_POST[kat]"
			);

			//proses insert ke database
            $database->insert($table="slide", $array=$form_data);
		}

		echo "<script>alert('Sukses! Data Telah Berhasil Disimpan.'); window.location = '../../media.php?module=$module&kat=$_POST[kat]';</script>";
	}
	else
	{
		echo "<script>alert('Maaf! Data Gagal Disimpan, Silahkan coba lagi.'); window.location = '../../media.php?module=$module&kat=$_POST[kat]';</script>";
	}
}

if($act=='update')
{
	// Update
	if ($module=='slideshow' AND $act=='update')
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
				echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File yang di Upload bertipe *.JPG, *.GIF, *.PNG.'); window.location = '../../media.php?module=$module&kat=$_POST[kat]';</script>";
				die();
			}

			$show	= $database->select($fields="gambar", $table="slide", $where_clause="WHERE id_slide = '$_POST[id]'");
            //("SELECT * FROM slide WHERE id_slide='$_POST[id]'");
			if($show['gambar'] != '')
			{
				unlink("../../../joimg/slide/$show[gambar]");
			}

            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/slide/");
			//ImageUpload($fupload_name=$nama_file_unik, $to_dir='../../../joimg/slide/');

	   		//data yang akan diupdate berbentuk array
			$form_data = array(
				"nama" 		=> "$_POST[nama]",
				"gambar" 	=> "$nama_file_unik"
			);

			//proses update ke database
            $database->update($table="slide", $array=$form_data, $fields_key="id_slide", $id="$_POST[id]");
		}
		else
		{
			//data yang akan diupdate berbentuk array
			$form_data = array(
				"nama" 		=> "$_POST[nama]"
			);

			//proses update ke database
            $database->update($table="slide", $array=$form_data, $fields_key="id_slide", $id="$_POST[id]");
		}

		echo "<script>alert('Sukses! Data Telah Berhasil Disimpan.'); window.location = '../../media.php?module=$module&kat=$_POST[kat]';</script>";
	}
	else
	{
		echo "<script>alert('Maaf! Data Gagal Disimpan, Silahkan coba lagi.'); window.location = '../../media.php?module=$module&kat=$_POST[kat]';</script>";
	}
}


if($act=='delete')
{
	// Delete
	if ($module=='slideshow' AND $act=='delete')
	{
		$show	= $database->select($fields="gambar", $table="slide", $where_clause="WHERE id_slide = '$_GET[id]'");

		if($show['gambar'] != '')
		{
			unlink("../../../joimg/slide/$show[gambar]");
			//db_delete($table="slide", $where_clause="id_slide = $_GET[id]");
            $database->delete($table="slide", $fields_key="id_slide", $id=$_GET['id']);
		}
		else
		{
            $database->delete($table="slide", $fields_key="id_slide", $id=$_GET['id']);
			//db_delete($table="slide", $where_clause="id_slide = $_GET[id]");
		}

		echo "<script>alert('Sukses! Data Telah Berhasil Dihapus.'); window.location = '../../media.php?module=$module&kat=$_GET[kat]';</script>";
	}
	else
	{
		echo "<script>alert('Maaf! Data Gagal Dihapus, Silahkan coba lagi.'); window.location = '../../media.php?module=$module&kat=$_GET[kat]';</script>";
	}
}

}
?>
