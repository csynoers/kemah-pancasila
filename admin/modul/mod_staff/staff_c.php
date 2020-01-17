<?php
session_start();
error_reporting(0);
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
    if ($module=='staff' AND $act=='insert')
    {
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $tipe_file      = $_FILES['fupload']['type'];
        $nama_file      = $_FILES['fupload']['name'];

        $nama_seo       = substr(seo($_POST['name']), 0, 75);
        $acak           = rand(000,999);
        $nama_file_unik = $nama_seo.'-'.$acak.'-'.$nama_file;
        $deskripsi      = stripslashes($_POST['deskripsi']);
        $date = date('Y-m-d');

        if(!empty($lokasi_file))
        {

            if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/gif" AND $tipe_file != "image/png"){
                echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File yang di Upload bertipe *.JPG, *.GIF, *.PNG.'); window.location = '../../media.php?module=$module&id=$_GET[id]';</script>";
                die();
            }

            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/staff/");
            $upload->thumbnail($imageName=$nama_file_unik, $imageDirectory="../../../joimg/staff", $thumbDirectory="../../../joimg/staff/thumbnail", $thumbWidth="500");

            //data yang akan di insert berbentuk array
            $form_data = array(
                "name"             => "$_POST[name]",
                "deskripsi"         => "$deskripsi",
                "seo"               => "$nama_seo",
                "status"            => "$_POST[status]"
            );

            //proses insert ke database
            $database->insert($table="staff", $array=$form_data);
        }
        else
        {
            //data yang akan di insert berbentuk array
            $form_data = array(
                "name"             => "$_POST[name]",
                "deskripsi"         => "$deskripsi",
                "seo"               => "$nama_seo",
                "status"            => "$_POST[status]"
            );

            //proses insert ke database
            $database->insert($table="staff", $array=$form_data);
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
    if ($module=='staff' AND $act=='update')
    {
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $tipe_file      = $_FILES['fupload']['type'];
        $nama_file      = $_FILES['fupload']['name'];

        $nama_seo       = substr(seo($_POST['name']), 0, 50);
        $acak           = rand(000,999);
        $nama_file_unik = $nama_seo.'-'.$acak.'-'.$nama_file;
        $deskripsi      = stripslashes($_POST['deskripsi']);
        $date = date('Y-m-d');

        if(!empty($lokasi_file))
        {

            if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/gif" AND $tipe_file != "image/png"){
                echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File yang di Upload bertipe *.JPG, *.GIF, *.PNG.'); window.location = '../../media.php?module=$module&id=$_GET[id]';</script>";
                die();
            }

            $show   = $database->select($fields="image", $table="staff", $where_clause="WHERE id_staff = '$_POST[id]'", $fetch='');
            if($show['image'] != '')
            {
                unlink("../../../joimg/staff/$show[image]");
                unlink("../../../joimg/staff/thumbnail/$show[image]");
            }

            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/staff/");
            $upload->thumbnail($imageName=$nama_file_unik, $imageDirectory="../../../joimg/staff", $thumbDirectory="../../../joimg/staff/thumbnail", $thumbWidth="500");

            //data yang akan diupdate berbentuk array
            $form_data = array(
                
                "name"             => "$_POST[name]",
                "deskripsi"         => "$deskripsi",
                "seo"               => "$nama_seo",
                "status"            => "$_POST[status]"
            );

            //proses update ke database
            $database->update($table="staff", $array=$form_data, $fields_key="id_staff", $id="$_POST[id]");
        }
        else
        {
            //data yang akan diupdate berbentuk array
            $form_data = array(                        
                "name"             => "$_POST[name]",
                "deskripsi"         => "$deskripsi",
                "seo"               => "$nama_seo",
                "status"            => "$_POST[status]"
            );

            //proses update ke database
            $database->update($table="staff", $array=$form_data, $fields_key="id_staff", $id="$_POST[id]");
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
    if ($module=='staff' AND $act=='delete')
    {
        //$show   = db_get_one("SELECT * FROM staff_gallery WHERE id_kategori='$_GET[id]'");
        // $show   = $database->select($fields="image", $table="staff", $where_clause="WHERE id_staff = '$_GET[id]'", $fetch='');
        // if($show['image'] != '')
        // {
        //     unlink("../../../joimg/staff/$show[image]");
        //     unlink("../../../joimg/staff/thumbnail/$show[image]");
        //     $database->delete($table="staff", $fields_key="id_staff", $id="$_GET[id]");
        // }
        // else
        // {
        // }
            $cek = $database->count_rows("staff_gallery","WHERE id_kategori = '$_GET[id]'");
            if ($cek > 0) {
                $database->delete($table="staff_gallery", $fields_key="id_kategori", $id="$_GET[id]");
            }

            $database->delete($table="staff", $fields_key="id_staff", $id="$_GET[id]");

        echo "<script> window.location = '../../media.php?module=$module';</script>";
    }
    else
    {
        echo "<script>alert('Maaf! Data Gagal Dihapus, Silahkan coba lagi.'); window.location = '../../media.php?module=$module';</script>";
    }
}

}
?>