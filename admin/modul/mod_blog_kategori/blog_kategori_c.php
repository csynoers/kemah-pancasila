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
    if ($module=='blog_kategori' AND $act=='insert')
    {
        $nama_seo       = substr(seo($_POST['judul']), 0, 75);

        //data yang akan di insert berbentuk array
        $form_data = array(
            "nama"      => "$_POST[judul]",
            "seo"       => "$nama_seo"
        );

        //proses insert ke database
        $database->insert($table="blog_kategori", $array=$form_data);

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
    if ($module=='blog_kategori' AND $act=='update')
    {
        
        $nama_seo       = substr(seo($_POST['judul']), 0, 50);
        
        //data yang akan diupdate berbentuk array
        $form_data = array(
            "nama"      => "$_POST[judul]",
            "seo"       => "$nama_seo"
        );

        //proses update ke database
        $database->update($table="blog_kategori", $array=$form_data, $fields_key="id_blog_kategori", $id="$_POST[id]");
        

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
    if ($module=='blog_kategori' AND $act=='delete')
    {
        //validasi 
        $show   = $database->select($fields="id_blog", $table="blog", $where_clause="WHERE id_blog_kategori = '$_GET[id]'", $fetch='');
        if($show['id_blog'] != '')
        {
            echo "<script>alert('Maaf! Kategori gagal dihapus karena masih digunakan dalam beberapa blog.'); window.location = '../../media.php?module=$module';</script>";            
        }
        else
        {
            $database->delete($table="blog_kategori", $fields_key="id_blog_kategori", $id="$_GET[id]");
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
