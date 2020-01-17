<?php
session_start();
if (empty($_SESSION['id_users']) || empty($_SESSION['username']) || empty($_SESSION['password'])){
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else {

    $aksi="modul/mod_keyword/keyword_c.php?module=keyword";
    switch($_GET['act']){
    default:
    $keyword = $database->select($fields="id_modul, static_content", $table="modul", $where_clause="WHERE id_modul ='2'", $fetch="");
?>
                    <div class="card">

                        <div class="card-body card-padding">
                            <p class="c-black f-500 m-b-20">Setting Seo - Keyword Web</p>
                            <hr class="line">
                            <form method='post' action='<?php echo $aksi;?>&act=update'>
                                <input type="hidden" name="id" value="<?php echo $keyword['id_modul']; ?>">

                                <div class="form-group">
                                    <div class="fg-line">
                                        <textarea name="content" class="form-control" rows="5" placeholder="Enter your keyword website"><?php echo $keyword['static_content'];?></textarea>
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
