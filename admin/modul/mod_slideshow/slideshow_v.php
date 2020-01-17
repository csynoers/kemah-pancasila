<?php
session_start();
if (empty($_SESSION['id_users']) || empty($_SESSION['username']) || empty($_SESSION['password'])){
    echo "
    <center>Untuk mengakses modul, Anda harus login <br>
    <a href=../../index.php><b>LOGIN</b></a></center>";
}
else {
?>
    <!--Begin DataTables-->
    <link rel="stylesheet" href="assets/vendors/dataTables/css/jquery.dataTables.css" type="text/css" media="screen" />
    <script type="text/javascript" charset="utf8" src="assets/vendors/dataTables/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="assets/vendors/dataTables/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#datatables').DataTable();
    } );
    </script>
    <!--End DataTables-->


<?php
    $aksi="modul/mod_slideshow/slideshow_c.php?module=slideshow";
    switch($_GET['act']){
    default:

    $st = $database->select($fields="*", $table="slide_title", $where_clause="WHERE id_slide_title=1");

?>

                    <!-- <div class="card">

                        <div class="card-body card-padding">
                            <p class="c-black f-500 m-b-20"><?php echo $link_home = ($_GET['kat'] == '1') ? 'Setting Web' : '<a href="?module=campus">Campus</a>';?> - Title Slideshow</p>
                            <hr class="line">
                            <form method='post' action='<?php echo $aksi;?>&act=updateTitle' enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $st['id_slide_title']; ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Judul 1</label>
                                                <input type="text" name="title2" class="form-control" placeholder="Enter title" maxlength="50" required="require" value="<?php echo $st['title2'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Judul 2</label>
                                                <input type="text" name="title3" class="form-control" placeholder="Enter title" maxlength="150" required="require" value="<?php echo $st['title3'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                
                                <div class="form-group kaki">
                                    <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect"><i class="zmdi zmdi-check"></i> Save</button>
                                    <button type="button" class="btn btn-danger btn-sm m-t-10 waves-effect" onclick="self.history.back()"><i class="zmdi zmdi-close"></i> Cancel</button>
                                </div>

                            </form>
                        </div>
                    </div> -->


                <div class="card">
                    <div class="card-body card-padding">
                        <p class="c-black f-500 m-b-20"><?php echo $link_home = ($_GET['kat'] == '1') ? 'Setting Web' : '<a href="?module=campus">Campus</a>';?> - Slideshow 
                            <a href="?module=slideshow&act=add&kat=<?php echo $_GET['kat']; ?>" class="btn bgm-deeppurple btn-sm m-t-10 waves-effect pull-right"><i class="zmdi zmdi-plus zmdi-hc-fw"></i> Add New</a>
                        </p>

                        <hr class="line">

                        <div class="table-responsive">
                            <table class='display' id='datatables'>
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="22%">Thumbnail</th>
                                        <th>Title</th>
                                        <th width="18%">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>

                                <?php
                                    $no=1;
                                    $slide = $database->select($fields="*", $table="slide", $where_clause="WHERE kat = '$_GET[kat]' ORDER BY id_slide DESC", $fetch="all");
                                    foreach ($slide as $key => $value) {
                                ?>
                                    <tr>
                                        <th><?php echo $no; ?></th>
                                        <td><img src="../joimg/slide/<?php echo $value['gambar'];?>" alt="" width="100px"></td>
                                        <td><?php echo $value['nama']; ?></td>
                                        <td>
                                            <a href="?module=slideshow&act=edit&id=<?php echo $value['id_slide'];?>" class="btn bgm-teal waves-effect"><i class="zmdi zmdi-edit zmdi-hc-fw"></i> Edit</a>
                                            <a href="<?php echo "$aksi&act=delete&id=$value[id_slide]&kat=$_GET[kat]";?>" class="btn bgm-pink waves-effect" onclick="return confirm('Apakah anda yakin menghapus data ini?');"><i class="zmdi zmdi-delete zmdi-hc-fw"></i> Delete</a>
                                        </td>
                                    </tr>

                                <?php
                                    $no++;
                                    }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

<?php
    break;
    case "add":
?>
                    <div class="card">

                        <div class="card-body card-padding">
                            <p class="c-black f-500 m-b-20"><?php echo $link_home = ($_GET['kat'] == '1') ? 'Setting Web' : '<a href="?module=campus">Campus</a>';?> / SlideShow / Add New</p>
                            <hr class="line">
                            <form method="post" enctype="multipart/form-data" action="<?php echo $aksi;?>&act=insert">

                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Title</label>
                                                <input type="text" name="nama" class="form-control" placeholder="Enter title slideshow" maxlength="100">
                                                <input type="hidden" name="kat" value="<?php echo $_GET['kat'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Image</label>
                                                <br>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn btn-success btn-file m-r-10">
                                                        <span class="fileinput-new">Select file</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="fupload">
                                                    </span>
                                                    <span class="fileinput-filename"></span>
                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="alert alert-info" role="alert"><b>Attention!</b> <br><p style="font-size: 13px;"><b>Image Type :</b> JPG/JPEG. <b>Size :</b> 1020 x 380 pixels. </p></div>

                                <div class="form-group kaki">
                                    <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect"><i class="zmdi zmdi-check"></i> Save</button>
                                    <button type="button" class="btn btn-danger btn-sm m-t-10 waves-effect" onclick="self.history.back()"><i class="zmdi zmdi-close"></i> Cancel</button>
                                </div>

                            </form>
                        </div>
                    </div>

<?php
    break;
    case "edit":
    $id     = $_GET['id'];
    $value   = $database->select($fields="*", $table="slide", $where_clause="WHERE id_slide = '$id'", $fetch="");
?>

                    <div class="card">

                        <div class="card-body card-padding">
                            <p class="c-black f-500 m-b-20"><?php echo $link_home = ($_GET['kat'] == '1') ? 'Setting Web' : '<a href="?module=campus">Campus</a>';?> - Edit Slideshow </p>
                            <hr class="line">
                            <form method="post" enctype="multipart/form-data" action="<?php echo $aksi;?>&act=update">

                                <input type="hidden" name="id" value="<?php echo $id;?>">

                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Title </label>
                                                <input type="text" name="nama" class="form-control" placeholder="Enter title slideshow" maxlength="100" value="<?php echo $value['nama'];?>">
                                                <input type="hidden" name="kat" value="<?php echo $value['kat']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Image</label>
                                                <br>

                                                <img src="../joimg/slide/<?php echo $value['gambar'];?>" alt="" width="100%">
                                                <br><br>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn btn-success btn-file m-r-10">
                                                        <span class="fileinput-new">Select file</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="fupload">
                                                    </span>
                                                    <span class="fileinput-filename"></span>
                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>



                                <div class="alert alert-info" role="alert"><b>Attention!</b> <br><p style="font-size: 13px;"><b>Image Type :</b> JPG/JPEG. <b>Size :</b> 1020 x 380 pixels. </p></div>

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
