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
    if ($module=='blog_media_partner' AND $act=='insert')
    {
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $tipe_file      = $_FILES['fupload']['type'];
        $nama_file      = $_FILES['fupload']['name'];
        
        // $nama_seo       = substr(seo($_POST['judul']), 0, 75);
        // $nama_file_unik = $nama_seo.'-'.$acak.'-'.$nama_file;
        // $date = date('Y-m-d');
        $nama_file_unik = date('Ymdhis').'-'.$nama_file;

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
                "media_partner_title"             => $_POST['title'],
                "media_partner_image"             => $nama_file_unik,
                "media_partner_deskripsi"         => stripslashes($_POST['deskripsi']),
                "media_partner_status"            => $_POST['status']
            );

            //proses insert ke database
            $database->insert($table="media_partners", $array=$form_data);
        }
        else
        {
            //data yang akan di insert berbentuk array
            $form_data = array(
                "media_partner_title"             => $_POST['title'],
                "media_partner_deskripsi"         => stripslashes($_POST['deskripsi']),
                "media_partner_status"            => $_POST['status']
            );

            //proses insert ke database
            $database->insert($table="media_partners", $array=$form_data);
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
    if ($module=='blog_media_partner' AND $act=='update')
    {
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $tipe_file      = $_FILES['fupload']['type'];
        $nama_file      = $_FILES['fupload']['name'];

        // $nama_seo       = substr(seo($_POST['judul']), 0, 50);
        // $acak           = rand(000,999);
        // $deskripsi      = stripslashes($_POST['deskripsi']);
        $nama_file_unik = date('Ymdhis').'-'.$nama_file;
        $date = date('Y-m-d');

        if(!empty($lokasi_file))
        {

            if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/gif" AND $tipe_file != "image/png"){
                echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File yang di Upload bertipe *.JPG, *.GIF, *.PNG.'); window.location = '../../media.php?module=$module';</script>";
                die();
            }

            $show   = $database->select($fields="media_partner_image", $table="media_partners", $where_clause="WHERE media_partner_id = '$_POST[id]'", $fetch='');
            if($show['media_partner_image'] != '')
            {
                unlink("../../../joimg/blog/$show[media_partner_image]");
                unlink("../../../joimg/blog/thumbnail/$show[media_partner_image]");
            }

            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/blog/");
            $upload->thumbnail($imageName=$nama_file_unik, $imageDirectory="../../../joimg/blog", $thumbDirectory="../../../joimg/blog/thumbnail", $thumbWidth="500");

            //data yang akan diupdate berbentuk array
            $form_data = array(
                "media_partner_title"             => $_POST['title'],
                "media_partner_image"             => $nama_file_unik,
                "media_partner_deskripsi"         => stripslashes($_POST['deskripsi']),
                "media_partner_status"            => $_POST['status']
            );

            //proses update ke database
            $database->update($table="media_partners", $array=$form_data, $fields_key="media_partner_id", $id="$_POST[id]");
        }
        else
        {
            //data yang akan diupdate berbentuk array
            $form_data = array(
                "media_partner_title"             => $_POST['title'],
                "media_partner_deskripsi"         => stripslashes($_POST['deskripsi']),
                "media_partner_status"            => $_POST['status']
            );

            //proses update ke database
            $database->update($table="media_partners", $array=$form_data, $fields_key="media_partner_id", $id="$_POST[id]");
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
    if ($module=='blog_media_partner' AND $act=='delete')
    {
    //  $show   = db_get_one("SELECT * FROM sosmed WHERE id_sosmed='$_GET[id]'");
        $show   = $database->select($fields="media_partner_image", $table="media_partners", $where_clause="WHERE media_partner_id = '$_GET[id]'", $fetch='');
        if($show['media_partner_image'] != '')
        {
            unlink("../../../joimg/blog/$show[media_partner_image]");
            unlink("../../../joimg/blog/thumbnail/$show[media_partner_image]");
            $database->delete($table="media_partners", $fields_key="media_partner_id", $id="$_GET[id]");
        }
        else
        {
            $database->delete($table="media_partners", $fields_key="media_partner_id", $id="$_GET[id]");
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