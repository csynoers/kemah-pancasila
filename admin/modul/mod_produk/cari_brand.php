<?php
    require_once '../../../josys/db_connect.php';
	include_once '../../../josys/class/Database.php';
	include_once '../../../josys/class/Upload.php';
	include_once '../../../josys/function/Seo.php';

	$database 	= new Database($db);
	$upload     = new Upload();


    $brand = $database->select($fields="*", $table="brand", $where_clause="WHERE id_produk_kategori='$_POST[kategori]'", $fetch="all");
    foreach ($brand as $key => $b) {
    	echo '<option value="'.$b['id_brand'].'">'.$b['nama'].'</option>';	
    }

?>