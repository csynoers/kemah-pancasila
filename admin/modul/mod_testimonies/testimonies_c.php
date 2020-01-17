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

$database   = new Database($db);
$upload     = new Upload();

$module = $_GET['module'];
$act    = $_GET['act'];


if($act=='insert')
{
    // Insert
    if ($module=='testimonies' AND $act=='insert')
    {
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $tipe_file      = $_FILES['fupload']['type'];
        $nama_file      = $_FILES['fupload']['name'];

        $nama_seo       = substr(seo($_POST['name']), 0, 75);
        $acak           = rand(000,999);
        $nama_file_unik = $nama_seo.'-'.$acak.'-'.$nama_file;
        
        $date = date('Y-m-d');

        if(!empty($lokasi_file))
        {

            if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png"){
                echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File yang di Upload bertipe *.JPG, *.PNG.'); window.location = '../../media.php?module=$module';</script>";
                die();
            }
            
            if (isset($nama_file)) {
                //store image
                $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/testimonies/");
            }
            
            //data yang akan di insert berbentuk array
            $form_data = array(
                
                "nama"               => "$_POST[name]",
                "say"               => "$_POST[say]",
                "seo"                => "$nama_seo",
                "image"              => "$nama_file_unik",
                
                "dateTime"           => "$date",
                "status"             => "$_POST[status]"
            );

            //proses insert ke database
            $database->insert($table="testimonies", $array=$form_data);
        }

        else
        {
            //data yang akan di insert berbentuk array
            $form_data = array(
                
                "nama"               => "$_POST[name]",                
                "say"               => "$_POST[say]",
                "seo"                => "$nama_seo",
                
                "dateTime"           => "$date",
                "status"             => "$_POST[status]"
            );

            //proses insert ke database
            $database->insert($table="testimonies", $array=$form_data);
        }

        echo "<script> window.location = '../../media.php?module=$module';</script>";
    }
    else
    {
        echo "<script>alert('Maaf! Data Gagal Disimpan, Silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
    }
}

if($act=='update')
{
    // Update
    if ($module=='testimonies' AND $act=='update')
    {
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $tipe_file      = $_FILES['fupload']['type'];
        $nama_file      = $_FILES['fupload']['name'];

        $nama_seo       = substr(seo($_POST['name']), 0, 50);
        $acak           = rand(000,999);
        $nama_file_unik = $nama_seo.'-'.$acak.'-'.$nama_file;

        $date = date('Y-m-d');

        if(!empty($lokasi_file))
        {

            if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png"){
                echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File yang di Upload bertipe *.JPG, *.PNG.'); window.location = '../../media.php?module=$module';</script>";
                die();
            }

            $show   = $database->select($fields="image", $table="testimonies", $where_clause="WHERE id_testimonies = '$_POST[id]'", $fetch='');
            if($show['image'] != '')
            {
                unlink("../../../joimg/testimonies/$show[image]");
            }

            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/testimonies/");

            //data yang akan diupdate berbentuk array
            $form_data = array(
                
                "nama"               => "$_POST[name]",
                "say"               => "$_POST[say]",
                "seo"                => "$nama_seo",
                "image"              => "$nama_file_unik",
                
                "dateTime"           => "$date",
                "status"             => "$_POST[status]"
            );

            //proses update ke database
            $database->update($table="testimonies", $array=$form_data, $fields_key="id_testimonies", $id="$_POST[id]");
        }
        
        else
        {
            //data yang akan diupdate berbentuk array
            $form_data = array(
                
                "nama"               => "$_POST[name]",
                "say"               => "$_POST[say]",
                "seo"                => "$nama_seo",
                
                "dateTime"           => "$date",
                "status"             => "$_POST[status]"
            );

            //proses update ke database
            $database->update($table="testimonies", $array=$form_data, $fields_key="id_testimonies", $id="$_POST[id]");
        }

        echo "<script> window.location = '../../media.php?module=$module';</script>";
    }
    else
    {
        echo "<script>alert('Maaf! Data Gagal Disimpan, Silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
    }
}


if($act=='delete')
{
    // Delete
    if ($module=='testimonies' AND $act=='delete')
    {

        $show   = $database->select($fields="image", $table="testimonies", $where_clause="WHERE id_testimonies = '$_GET[id]'", $fetch='');
        if($show['image'] != '')
        {
            unlink("../../../joimg/testimonies/$show[image]");
            $database->delete($table="testimonies", $fields_key="id_testimonies", $id="$_GET[id]");
        }
        else
        {
            $database->delete($table="testimonies", $fields_key="id_testimonies", $id="$_GET[id]");
        }

        echo "<script> window.location = '../../media.php?module=$module';</script>";
    }
    else
    {
        echo "<script>alert('Maaf! Data Gagal Dihapus, Silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
    }
}

}
?>
