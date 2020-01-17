<?php
session_start();
if (empty($_SESSION['id_users']) || empty($_SESSION['username']) || empty($_SESSION['password'])){
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else {

    $aksi="modul/mod_description/description_c.php?module=description";
    switch($_GET['act']){
    default:
    $description = $database->select($fields="id_modul, static_content", $table="modul", $where_clause="WHERE id_modul ='3'", $fetch="");
//    $description = db_get_one("SELECT id_modul, static_content FROM modul WHERE id_modul='3'");
?>
                    <div class="card">

                        <div class="card-body card-padding">
                            <p class="c-black f-500 m-b-20">Setting Seo - Description Web</p>
                            <hr class="line">
                            <form method='post' action='<?php echo $aksi;?>&act=update'>
                                <input type="hidden" name="id" value="<?php echo $description['id_modul']; ?>">

                                <div class="form-group">
                                    <div class="fg-line">
                                        <textarea name="content" class="form-control" rows="5" placeholder="Enter your description website"><?php echo $description['static_content'];?></textarea>
                                    </div>
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
