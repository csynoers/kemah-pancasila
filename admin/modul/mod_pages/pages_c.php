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
include_once '../../../josys/class/Upload.php';
include_once '../../../josys/function/Seo.php';

$database   = new Database($db);
$upload     = new Upload();

	$module	= $_GET['module'];
	$act	= $_GET['act'];
	$id 	= $_POST['id'];

	// Update pages
	if ($module=='pages' AND $act=='update')
	{

		// if ($_POST['id']!='5' || $_POST['id']!='4') {
		// 	$content 	= stripslashes($_POST['content']);
	
		// 	$form_data = array(
		// 		"static_content" => "$content"
		// 	);		
		       
		//     $database->update($table="modul", $array=$form_data, $fields_key="id_modul", $id=$id);

		// } 

		// else {

			$lokasi_file    = $_FILES['fupload']['tmp_name'];
        	$tipe_file      = $_FILES['fupload']['type'];
        	$nama_file      = $_FILES['fupload']['name'];

        	$acak           = rand(000,999);
        	$nama_file_unik = $acak.'-'.$nama_file;

			$content 		= stripslashes($_POST['content']);
			
			if(!empty($lokasi_file))
	        {

	            if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/gif" AND $tipe_file != "image/png"){
	                echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File yang di Upload bertipe *.JPG, *.GIF, *.PNG.'); window.location = '../../media.php?module=$module';</script>";
	                die();
	            }
	            
	            if (isset($nama_file)) {
	            	//validasi
	            	$show   = $database->select($fields="gambar", $table="modul", $where_clause="WHERE id_modul = '$id'", $fetch='');
		            if($show['gambar'] != '')
		            {
		                unlink("../../../joimg/modul/$show[gambar]");
		            }

	                //store image
	                $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/modul/");
		            
		            //data yang akan di insert berbentuk array
		            $form_data = array(
		                "static_content"     => "$content",
		                "gambar"              => "$nama_file_unik"
		            );

		            //proses insert ke database
		           $database->update($table="modul", $array=$form_data, $fields_key="id_modul", $id="$id");
	            }
	            	
	        } 

	        else {
		    	//data yang akan diupdate berbentuk array
				$form_data = array(
					"static_content" => "$content"
				);	
				//proses update ke database
		        $database->update($table="modul", $array=$form_data, $fields_key="id_modul", $id=$id);
	        }

		//}

		echo "<script>alert('Sukses! Data Telah Berhasil Disimpan.'); window.location = '../../media.php?module=$module&id=$id';</script>";
	}
	else
	{
		echo "<script>alert('Maaf! Data Gagal Disimpan, Silahkan coba lagi.'); window.location = '../../media.php?module=$module&id=$id';</script>";
	}

}
?>
