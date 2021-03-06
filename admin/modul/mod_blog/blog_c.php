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
    if ($module=='blog' AND $act=='insert')
    {
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $tipe_file      = $_FILES['fupload']['type'];
        $nama_file      = $_FILES['fupload']['name'];

        $nama_seo       = substr(seo($_POST['judul']), 0, 75);
        $acak           = rand(000,999);
        $nama_file_unik = $nama_seo.'-'.$acak.'-'.$nama_file;
        $deskripsi      = stripslashes($_POST['deskripsi']);
        $date = date('Y-m-d');

        if(!empty($lokasi_file))
        {

            if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/gif" AND $tipe_file != "image/png"){
                echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File yang di Upload bertipe *.JPG, *.GIF, *.PNG.'); window.location = '../../media.php?module=$module';</script>";
                die();
            }

            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/blog/");
            $upload->thumbnail($imageName=$nama_file_unik, $imageDirectory="../../../joimg/blog", $thumbDirectory="../../../joimg/blog/thumbnail", $thumbWidth="500");

            //data yang akan di insert berbentuk array
            $form_data = array(
                "judul"             => "$_POST[judul]",
                "id_blog_kategori"  => "$_POST[kategori]",
                "deskripsi"         => "$deskripsi",
                "image"             => "$nama_file_unik",
                "date"              => "$date",
                "seo"               => "$nama_seo",
                "status"            => "$_POST[status]",
                "media_partner_id"  => $_POST['media_partner_id']
            );

            //proses insert ke database
            $database->insert($table="blog", $array=$form_data);
        }
        else
        {
            //data yang akan di insert berbentuk array
            $form_data = array(
                "judul"             => "$_POST[judul]",
                "id_blog_kategori"  => "$_POST[kategori]",
                "deskripsi"         => "$deskripsi",
                "date"              => "$date",
                "seo"               => "$nama_seo",
                "status"            => "$_POST[status]",
                "media_partner_id"  => $_POST['media_partner_id']
            );

            //proses insert ke database
            $database->insert($table="blog", $array=$form_data);
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
    if ($module=='blog' AND $act=='update')
    {
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $tipe_file      = $_FILES['fupload']['type'];
        $nama_file      = $_FILES['fupload']['name'];

        $nama_seo       = substr(seo($_POST['judul']), 0, 50);
        $acak           = rand(000,999);
        $nama_file_unik = $nama_seo.'-'.$acak.'-'.$nama_file;
        $deskripsi      = stripslashes($_POST['deskripsi']);
        $date = date('Y-m-d');

        if(!empty($lokasi_file))
        {

            if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/gif" AND $tipe_file != "image/png"){
                echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File yang di Upload bertipe *.JPG, *.GIF, *.PNG.'); window.location = '../../media.php?module=$module';</script>";
                die();
            }

            $show   = $database->select($fields="image", $table="blog", $where_clause="WHERE id_blog = '$_POST[id]'", $fetch='');
            if($show['image'] != '')
            {
                unlink("../../../joimg/blog/$show[image]");
                unlink("../../../joimg/blog/thumbnail/$show[image]");
            }

            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/blog/");
            $upload->thumbnail($imageName=$nama_file_unik, $imageDirectory="../../../joimg/blog", $thumbDirectory="../../../joimg/blog/thumbnail", $thumbWidth="500");

            //data yang akan diupdate berbentuk array
            $form_data = array(
                
                "judul"             => "$_POST[judul]",
                "id_blog_kategori"  => "$_POST[kategori]",
                "deskripsi"         => "$deskripsi",
                "image"             => "$nama_file_unik",
                "date"              => "$date",
                "seo"               => "$nama_seo",
                "status"            => "$_POST[status]",
                "media_partner_id"  => $_POST['media_partner_id']
            );

            //proses update ke database
            $database->update($table="blog", $array=$form_data, $fields_key="id_blog", $id="$_POST[id]");
        }
        else
        {
            //data yang akan diupdate berbentuk array
            $form_data = array(
                
                "judul"             => "$_POST[judul]",                
                "id_blog_kategori"  => "$_POST[kategori]",
                "deskripsi"         => "$deskripsi",
                "date"              => "$date",
                "seo"               => "$nama_seo",
                "status"            => "$_POST[status]",
                "media_partner_id"  => $_POST['media_partner_id']
            );

            //proses update ke database
            $database->update($table="blog", $array=$form_data, $fields_key="id_blog", $id="$_POST[id]");
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
    if ($module=='blog' AND $act=='delete')
    {
    //  $show   = db_get_one("SELECT * FROM sosmed WHERE id_sosmed='$_GET[id]'");
        $show   = $database->select($fields="image", $table="blog", $where_clause="WHERE id_blog = '$_GET[id]'", $fetch='');
        if($show['image'] != '')
        {
            unlink("../../../joimg/blog/$show[image]");
            unlink("../../../joimg/blog/thumbnail/$show[image]");
            $database->delete($table="blog", $fields_key="id_blog", $id="$_GET[id]");
        }
        else
        {
            $database->delete($table="blog", $fields_key="id_blog", $id="$_GET[id]");
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