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
    if ($module=='brand' AND $act=='insert')
    {
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $tipe_file      = $_FILES['fupload']['type'];
        $nama_file      = $_FILES['fupload']['name'];

        $lokasi_filekat = $_FILES['fuploadkatalog']['tmp_name'];
        $tipe_filekat   = $_FILES['fuploadkatalog']['type'];
        $nama_filekat   = $_FILES['fuploadkatalog']['name'];      

        $lokasi_filecover = $_FILES['fuploadcover']['tmp_name'];
        $tipe_filecover   = $_FILES['fuploadcover']['type'];
        $nama_filecover   = $_FILES['fuploadcover']['name'];        

        $nama_seo       = substr(seo($_POST['judul']), 0, 75);
        $acak           = rand(000,999);
        $nama_file_unik = $nama_seo.'-'.$acak.'-'.$nama_file;
        $nama_file_unik_kat = $nama_seo.'-'.$acak.'-'.$nama_filekat;
        $nama_file_unik_cover = $nama_seo.'-'.$acak.'-'.$nama_filecover;


        //cek logo
        if(!empty($lokasi_file)){
            if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/gif" AND $tipe_file != "image/png"){
                echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File yang di Upload bertipe *.JPG, *.GIF, *.PNG.'); window.location = '../../media.php?module=$module';</script>";
                die();
            } else {
                $cek_logo = "ada";
            }         
        } else {
            $cek_logo = "kosong";
        }

        //cek katalog
        if(!empty($lokasi_filekat)){
            if ($tipe_filekat != "application/pdf"){
                    echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File Katalog yang di Upload bertipe *.PDF.'); window.location = '../../media.php?module=$module';</script>";
                    die();
            } else {
                $cek_kat = "ada";
            }         
        } else {
            $cek_kat = "kosong";
        }

        //cek cover
        if(!empty($lokasi_filecover)){
            if ($tipe_filecover != "image/jpeg" AND $tipe_filecover != "image/pjpeg" AND $tipe_filecover != "image/gif" AND $tipe_filecover != "image/png"){
                echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File cover yang di Upload bertipe *.JPG, *.PNG.'); window.location = '../../media.php?module=$module';</script>";
                die();
            } else {
                $cek_cover = "ada";
            }         
        } else {
            $cek_cover = "kosong";
        }


        //proses upload
        // y-y-y
        if ( ($cek_logo=='ada') and ($cek_kat=='ada') and ($cek_cover=='ada') ) {
            
            if (isset($nama_file)) {
                //store image
                $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/brand/");
            }

            if (isset($nama_filekat)) {
                //store image
                $upload->file($fileName=$nama_file_unik_kat, $fileDirectory="../../../jodoc/catalog/");
            }

            if (isset($nama_filecover)) {
                //store image
                $upload->cover($fileName=$nama_file_unik_cover, $fileDirectory="../../../joimg/cover/");   
            }

            //data yang akan di insert berbentuk array
            $form_data = array(
                "id_produk_kategori" => "$_POST[kategori]",
                "nama"               => "$_POST[judul]",
                "seo"                => "$nama_seo",
                "image"              => "$nama_file_unik",
                "catalog"            => "$nama_file_unik_kat",
                "cover"              => "$nama_file_unik_cover"
            );
        } 

        // y-y-n
        elseif ( ($cek_logo=='ada') and ($cek_kat=='ada') and ($cek_cover=='kosong') ) {
            
            if (isset($nama_file)) {
                //store image
                $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/brand/");
            }

            if (isset($nama_filekat)) {
                //store image
                $upload->file($fileName=$nama_file_unik_kat, $fileDirectory="../../../jodoc/catalog/");
            }

            //data yang akan di insert berbentuk array
            $form_data = array(
                "id_produk_kategori" => "$_POST[kategori]",
                "nama"               => "$_POST[judul]",
                "seo"                => "$nama_seo",
                "image"              => "$nama_file_unik",
                "catalog"            => "$nama_file_unik_kat"
            );
        }

        // y-n-y
        elseif ( ($cek_logo=='ada') and ($cek_kat=='kosong') and ($cek_cover=='ada') ) {
            
            if (isset($nama_file)) {
                //store image
                $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/brand/");
            }

            if (isset($nama_filecover)) {
                //store image
                $upload->cover($fileName=$nama_file_unik_cover, $fileDirectory="../../../joimg/cover/");   
            }

            //data yang akan di insert berbentuk array
            $form_data = array(
                "id_produk_kategori" => "$_POST[kategori]",
                "nama"               => "$_POST[judul]",
                "seo"                => "$nama_seo",
                "image"              => "$nama_file_unik",
                "cover"              => "$nama_file_unik_cover"
            );
        }

        // y-n-n
        elseif ( ($cek_logo=='ada') and ($cek_kat=='kosong') and ($cek_cover=='kosong') ) {
            
            if (isset($nama_file)) {
                //store image
                $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/brand/");
            }

            //data yang akan di insert berbentuk array
            $form_data = array(
                "id_produk_kategori" => "$_POST[kategori]",
                "nama"               => "$_POST[judul]",
                "seo"                => "$nama_seo",
                "image"              => "$nama_file_unik"
            );
        }

        //proses insert ke database
        $database->insert($table="brand", $array=$form_data);

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
    if ($module=='brand' AND $act=='update')
    {
        
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $tipe_file      = $_FILES['fupload']['type'];
        $nama_file      = $_FILES['fupload']['name'];

        $lokasi_filekat = $_FILES['fuploadkatalog']['tmp_name'];
        $tipe_filekat   = $_FILES['fuploadkatalog']['type'];
        $nama_filekat   = $_FILES['fuploadkatalog']['name'];      

        $lokasi_filecover = $_FILES['fuploadcover']['tmp_name'];
        $tipe_filecover   = $_FILES['fuploadcover']['type'];
        $nama_filecover   = $_FILES['fuploadcover']['name'];        

        $nama_seo       = substr(seo($_POST['judul']), 0, 75);
        $acak           = rand(000,999);
        $nama_file_unik = $nama_seo.'-'.$acak.'-'.$nama_file;
        $nama_file_unik_kat = $nama_seo.'-'.$acak.'-'.$nama_filekat;
        $nama_file_unik_cover = $nama_seo.'-'.$acak.'-'.$nama_filecover;
        
        //cek logo
        if(!empty($lokasi_file)){
            if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/gif" AND $tipe_file != "image/png"){
                echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File yang di Upload bertipe *.JPG, *.GIF, *.PNG.'); window.location = '../../media.php?module=$module';</script>";
                die();
            } else {
                $cek_logo = "ada";
            }         
        } else {
            $cek_logo = "kosong";
        }

        //cek katalog
        if(!empty($lokasi_filekat)){
            if ($tipe_filekat != "application/pdf"){
                    echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File Katalog yang di Upload bertipe *.PDF.'); window.location = '../../media.php?module=$module';</script>";
                    die();
            } else {
                $cek_kat = "ada";
            }         
        } else {
            $cek_kat = "kosong";
        }

        //cek cover
        if(!empty($lokasi_filecover)){
            if ($tipe_filecover != "image/jpeg" AND $tipe_filecover != "image/pjpeg" AND $tipe_filecover != "image/gif" AND $tipe_filecover != "image/png"){
                echo "<script>alert('Data tidak tersimpan! Upload Gagal, Pastikan File cover yang di Upload bertipe *.JPG, *.PNG.'); window.location = '../../media.php?module=$module';</script>";
                die();
            } else {
                $cek_cover = "ada";
            }         
        } else {
            $cek_cover = "kosong";
        }

        //proses upload
        // y-y-y
        if ( ($cek_logo=='ada') ) {
            
            $showlogo   = $database->select($fields="image", $table="brand", $where_clause="WHERE id_brand = '$_POST[id]'", $fetch='');
            if($showlogo['image'] != '')
            {
                unlink("../../../joimg/brand/$showlogo[image]");
            }

            if (isset($nama_file)) {
                //store image
                $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/brand/");
            }

            //data yang akan di insert berbentuk array
            $form_data = array(
                "image"              => "$nama_file_unik"
            );

            //proses update ke database
            $database->update($table="brand", $array=$form_data, $fields_key="id_brand", $id="$_POST[id]");

        }

        if ( ($cek_kat=='ada') ) {
            $showcat   = $database->select($fields="catalog", $table="brand", $where_clause="WHERE id_brand = '$_POST[id]'", $fetch='');
            if($showcat['catalog'] != '')
            {
                unlink("../../../jodoc/catalog/$showcat[catalog]");
            }

            if (isset($nama_filekat)) {
                //store image
                $upload->file($fileName=$nama_file_unik_kat, $fileDirectory="../../../jodoc/catalog/");
            }

            //data yang akan di insert berbentuk array
            $form_data = array(
                "catalog"              => "$nama_file_unik_kat"
            );

            //proses update ke database
            $database->update($table="brand", $array=$form_data, $fields_key="id_brand", $id="$_POST[id]");
            
        }

        if ( ($cek_cover=='ada') ) {
            $showcov   = $database->select($fields="cover", $table="brand", $where_clause="WHERE id_brand = '$_POST[id]'", $fetch='');
            if($showcov['cover'] != '')
            {
                unlink("../../../joimg/cover/$showcov[cover]");
            }

            if (isset($nama_filecover)) {
                //store image
                $upload->cover($fileName=$nama_file_unik_cover, $fileDirectory="../../../joimg/cover/");   
            }         

            //data yang akan di insert berbentuk array
            $form_data = array(
                "cover"              => "$nama_file_unik_cover"
            );

            //proses update ke database
            $database->update($table="brand", $array=$form_data, $fields_key="id_brand", $id="$_POST[id]");

        }

            //data yang akan di insert berbentuk array
            $form_data = array(
                "id_produk_kategori" => "$_POST[kategori]",
                "nama"               => "$_POST[judul]",
                "seo"                => "$nama_seo"
            );

            //proses update ke database
            $database->update($table="brand", $array=$form_data, $fields_key="id_brand", $id="$_POST[id]");
         

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
    if ($module=='brand' AND $act=='delete')
    {
        //validasi 
        $show   = $database->select($fields="id_produk", $table="produk", $where_clause="WHERE id_brand = '$_GET[id]'", $fetch='');
        if($show['id_produk'] != '')
        {
            echo "<script>alert('Maaf! Brand gagal dihapus karena masih digunakan dalam beberapa produk.'); window.location = '../../media.php?module=$module';</script>";            
        }
        else
        {

            //validasi brand (gambar, catalog, cover)
            $brand = $database->select($fields="image, catalog, cover", $table="brand", $where_clause="WHERE id_brand='$_GET[id]'");

            if (!empty($brand['image'])) {
                unlink("../../../joimg/brand/$brand[image]");
            } 

            if (!empty($brand['catalog'])) {
                unlink("../../../jodoc/catalog/$brand[catalog]");
            } 

            if (!empty($brand['cover'])) {
                unlink("../../../joimg/cover/$brand[cover]");
            } 

            $database->delete($table="brand", $fields_key="id_brand", $id="$_GET[id]");
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
