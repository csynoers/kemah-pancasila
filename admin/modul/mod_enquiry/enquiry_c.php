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

	$database 	= new Database($db);

	$module	= $_GET['module'];
	$act	= $_GET['act'];

	if($act=='delete')
	{
		// Delete
		if ($module=='enquiry' AND $act=='delete')
		{
	        $show	= $database->select($fields="attachment", $table="enquiry", $where_clause="WHERE id_enquiry = '$_GET[id]'");

			if($show['attachment'] != '')
			{
				unlink("../../../attachment/$show[attachment]");
				//db_delete($table="slide", $where_clause="id_slide = $_GET[id]");
	            $database->delete($table="enquiry", $fields_key="id_enquiry", $id=$_GET['id']);
			}
			else
			{
	            $database->delete($table="enquiry", $fields_key="id_enquiry", $id=$_GET['id']);
				//db_delete($table="slide", $where_clause="id_slide = $_GET[id]");
			}

			echo "<script>alert('Sukses! Data Telah Berhasil Dihapus.'); window.location = '../../media.php?module=$module';</script>";
		}
		else
		{
			echo "<script>alert('Maaf! Data Gagal Dihapus, Silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
		}
	}

	if($act=='kirimemail')
	{
		// Delete
		if ($module=='enquiry' AND $act=='kirimemail')
		{
			$dari = "From: CalticsJogja.com\n";
			$dari .= "MIME-Version: 1.0\r\n";
			$dari .= "Content-Type: text/html; charset=UTF-8\r\n";
		    $mail = mail($_POST['email'],$_POST['subjek'],$_POST['pesan'],$dari);
		    if ($mail) {
				echo "<script>alert('Sukses! Email Terkirim ke $_POST[email].'); window.location = '../../media.php?module=$module';</script>";
		    }
		    else{
				echo "<script>alert('Maaf! email Gagal dikirim, Silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
		    }
		}
		else
		{
			echo "<script>alert('Maaf! email Gagal dikirim, Silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
		}
	}
	

}
?>
