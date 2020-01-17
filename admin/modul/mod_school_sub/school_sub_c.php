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
    if ($module=='school_sub' AND $act=='insert')
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

            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/school_sub/");
            $upload->thumbnail($imageName=$nama_file_unik, $imageDirectory="../../../joimg/school_sub", $thumbDirectory="../../../joimg/school_sub/thumbnail", $thumbWidth="500");

            //data yang akan di insert berbentuk array
            $form_data = array(
                "id_school"         => "$_POST[id_school]",
                "name"             => "$_POST[name]",
                "deskripsi"         => "$deskripsi",
                "seo"               => "$nama_seo",
                "status"            => "$_POST[status]"
            );

            //proses insert ke database
            $database->insert($table="school_sub", $array=$form_data);
        }
        else
        {
            //data yang akan di insert berbentuk array
            $form_data = array(
                "id_school"         => "$_POST[id_school]",
                "name"             => "$_POST[name]",
                "deskripsi"         => "$deskripsi",
                "seo"               => "$nama_seo",
                "status"            => "$_POST[status]"
            );

            //proses insert ke database
            $database->insert($table="school_sub", $array=$form_data);
        }

        echo "<script>alert('Sukses! Data Telah Berhasil Disimpan.'); window.location = '../../media.php?module=$module&id_school=$_GET[id_school]';</script>";
    }
    else
    {
        echo "<script>alert('Maaf! Data Gagal Disimpan, Silahkan coba lagi.'); window.location = '../../media.php?module=$module&id_school=$_GET[id_school]';</script>";
    }
}

if($act=='update')
{
    // Update
    if ($module=='school_sub' AND $act=='update')
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

            $show   = $database->select($fields="image", $table="school_sub", $where_clause="WHERE id_school_sub = '$_POST[id]'", $fetch='');
            if($show['image'] != '')
            {
                unlink("../../../joimg/school_sub/$show[image]");
                unlink("../../../joimg/school_sub/thumbnail/$show[image]");
            }

            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/school_sub/");
            $upload->thumbnail($imageName=$nama_file_unik, $imageDirectory="../../../joimg/school_sub", $thumbDirectory="../../../joimg/school_sub/thumbnail", $thumbWidth="500");

            //data yang akan diupdate berbentuk array
            $form_data = array(
                
                "id_school"         => "$_POST[id_school]",
                "name"             => "$_POST[name]",
                "deskripsi"         => "$deskripsi",
                "seo"               => "$nama_seo",
                "status"            => "$_POST[status]"
            );

            //proses update ke database
            $database->update($table="school_sub", $array=$form_data, $fields_key="id_school_sub", $id="$_POST[id]");
        }
        else
        {
            //data yang akan diupdate berbentuk array
            $form_data = array(                        
                "id_school"         => "$_POST[id_school]",
                "name"             => "$_POST[name]",
                "deskripsi"         => "$deskripsi",
                "seo"               => "$nama_seo",
                "status"            => "$_POST[status]"
            );

            //proses update ke database
            $database->update($table="school_sub", $array=$form_data, $fields_key="id_school_sub", $id="$_POST[id]");
        }

        echo "<script>alert('Sukses! Data Telah Berhasil Disimpan.'); window.location = '../../media.php?module=$module&id_school=$_GET[id_school]';</script>";
    }
    else
    {
        echo "<script>alert('Maaf! Data Gagal Disimpan, Silahkan coba lagi.'); window.location = '../../media.php?module=$module&id_school=$_GET[id_school]';</script>";
    }
}


if($act=='delete')
{
    // Delete
    if ($module=='school_sub' AND $act=='delete')
    {
    //  $show   = db_get_one("SELECT * FROM sosmed WHERE id_sosmed='$_GET[id]'");
        // $show   = $database->select($fields="image", $table="school_sub", $where_clause="WHERE id_school_sub = '$_GET[id]'", $fetch='');
        // if($show['image'] != '')
        // {
        //     unlink("../../../joimg/school_sub/$show[image]");
        //     unlink("../../../joimg/school_sub/thumbnail/$show[image]");
        //     $database->delete($table="school_sub", $fields_key="id_school_sub", $id="$_GET[id]");
        // }
        // else
        // {
            $database->delete($table="school_sub", $fields_key="id_school_sub", $id="$_GET[id]");
        // }

        echo "<script>alert('Sukses! Data Telah Berhasil Dihapus.'); window.location = '../../media.php?module=$module&id_school=$_GET[id_school]';</script>";
    }
    else
    {
        echo "<script>alert('Maaf! Data Gagal Dihapus, Silahkan coba lagi.'); window.location = '../../media.php?module=$module&id_school=$_GET[id_school]';</script>";
    }
}

}
?>