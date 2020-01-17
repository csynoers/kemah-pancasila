<?php
session_start();
if (empty($_SESSION['id_users']) || empty($_SESSION['username']) || empty($_SESSION['password'])){
    echo "
    <center>Untuk mengakses modul, Anda harus login <br>
    <a href=../../index.php><b>LOGIN</b></a></center>";
}
else {

    $aksi="modul/mod_map/map_c.php?module=map";
    switch($_GET['act']){
    default:
    $map  = $database->select($fields="id_modul, static_content", $table="modul", $where_clause="WHERE id_modul = '6'", $fetch='');
?>
                    <div class="card">
                        <div class="card-body card-padding">
                            <p class="c-black f-500 m-b-20">Setting Web / Maps</p>
                            <hr class="line">
                            <form method='post' action='<?php echo $aksi;?>&act=update'>
                                <input type="hidden" name="id" value="<?php echo $map['id_modul'];?>" />
                                <div class="form-group">
                                    <div class="fg-line">
                                        <textarea name="content" class="form-control" rows="5" placeholder="Enter your link from google maps"><?php echo $map['static_content'];?></textarea>
                                    </div>
                                </div>


                                <div class="alert alert-info" role="alert"><b>Attention!</b> <br><p style="font-size: 13px;">&#42;&#41; Cara menggunakan MAP : masuk ke GOOGLE MAP &#45;&#62; Cari tempat yang ingin di pakai titik &#45;&#62; mapnya masuk ke icon Setting &#45;&#62; sematkan peta. copy link dari HTTPS sampai selesai &#34; &#47; petik 2 HTTPS </p>
                                </div>

                                <div class="form-group kaki">
                                    <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect"><i class="zmdi zmdi-check"></i> Save</button>
                                    <button type="button" class="btn btn-danger btn-sm m-t-10 waves-effect" onclick="self.history.back()"><i class="zmdi zmdi-close"></i> Cancel</button>
                                </div>

                            </form>
                        </div>
                    </div>

                    

<?php
    break;
    }
}
?>
