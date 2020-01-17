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
    if ($module=='client' AND $act=='insert')
    {
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $tipe_file      = $_FILES['fupload']['type'];
        $nama_file      = $_FILES['fupload']['name'];

        $nama_seo       = substr(seo($_POST['judul']), 0, 75);
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
                $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/client/");
            }
            
            //data yang akan di insert berbentuk array
            $form_data = array(
                // "id_client_kategori" => "$_POST[kategori]",
                "nama"               => "$_POST[judul]",
                "seo"                => "$nama_seo",
                "image"              => "$nama_file_unik",
                "url"                => "$_POST[url]",
                "dateTime"           => "$date",
                "status"             => "$_POST[status]"
            );

            //proses insert ke database
            $database->insert($table="client", $array=$form_data);
        }

        else
        {
            //data yang akan di insert berbentuk array
            $form_data = array(
                // "id_client_kategori" => "$_POST[kategori]",
                "nama"               => "$_POST[judul]",
                "seo"                => "$nama_seo",
                "url"                => "$_POST[url]",
                "dateTime"           => "$date",
                "status"             => "$_POST[status]"
            );

            //proses insert ke database
            $database->insert($table="client", $array=$form_data);
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
    if ($module=='client' AND $act=='update')
    {
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $tipe_file      = $_FILES['fupload']['type'];
        $nama_file      = $_FILES['fupload']['name'];

        $nama_seo       = substr(seo($_POST['judul']), 0, 50);
        $acak           = rand(000,999);
        $nama_file_unik = $nama_seo.'-'.$acak.'-'.$nama_file;

        $date = date('Y-m-d');

        if(!empty($lokasi_file))
        {

            if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png"){
                echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File yang di Upload bertipe *.JPG, *.PNG.'); window.location = '../../media.php?module=$module';</script>";
                die();
            }

            $show   = $database->select($fields="image", $table="client", $where_clause="WHERE id_client = '$_POST[id]'", $fetch='');
            if($show['image'] != '')
            {
                unlink("../../../joimg/client/$show[image]");
            }

            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/client/");

            //data yang akan diupdate berbentuk array
            $form_data = array(
                // "id_client_kategori" => "$_POST[kategori]",
                "nama"               => "$_POST[judul]",
                "seo"                => "$nama_seo",
                "image"              => "$nama_file_unik",
                "url"                => "$_POST[url]",
                "dateTime"           => "$date",
                "status"             => "$_POST[status]"
            );

            //proses update ke database
            $database->update($table="client", $array=$form_data, $fields_key="id_client", $id="$_POST[id]");
        }
        
        else
        {
            //data yang akan diupdate berbentuk array
            $form_data = array(
                // "id_client_kategori" => "$_POST[kategori]",
                "nama"               => "$_POST[judul]",
                "seo"                => "$nama_seo",
                "url"                => "$_POST[url]",
                "dateTime"           => "$date",
                "status"             => "$_POST[status]"
            );

            //proses update ke database
            $database->update($table="client", $array=$form_data, $fields_key="id_client", $id="$_POST[id]");
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
    if ($module=='client' AND $act=='delete')
    {

        $show   = $database->select($fields="image", $table="client", $where_clause="WHERE id_client = '$_GET[id]'", $fetch='');
        if($show['image'] != '')
        {
            unlink("../../../joimg/client/$show[image]");
            $database->delete($table="client", $fields_key="id_client", $id="$_GET[id]");
        }
        else
        {
            $database->delete($table="client", $fields_key="id_client", $id="$_GET[id]");
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
