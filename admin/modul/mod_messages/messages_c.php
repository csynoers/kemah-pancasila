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
	if ($module=='messages' AND $act=='delete')
	{
        $show	= $database->select($fields="attachment", $table="messages", $where_clause="WHERE id_messages = '$_GET[id]'");

		if($show['attachment'] != '')
		{
			unlink("../../../attachment/$show[attachment]");
			//db_delete($table="slide", $where_clause="id_slide = $_GET[id]");
            $database->delete($table="messages", $fields_key="id_messages", $id=$_GET['id']);
		}
		else
		{
            $database->delete($table="messages", $fields_key="id_messages", $id=$_GET['id']);
			//db_delete($table="slide", $where_clause="id_slide = $_GET[id]");
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
