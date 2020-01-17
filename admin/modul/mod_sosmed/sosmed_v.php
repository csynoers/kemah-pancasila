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
    $aksi="modul/mod_sosmed/sosmed_c.php?module=sosmed";
    switch($_GET['act']){
    default:
?>

                <div class="card">
                    <div class="card-body card-padding">

                        <p class="c-black f-500 m-b-20">Setting Web / Social Media
                            <a href="?module=sosmed&act=add" class="btn bgm-deeppurple btn-sm m-t-10 waves-effect pull-right"><i class="zmdi zmdi-plus zmdi-hc-fw"></i> Add New</a>
                        </p>

                        <hr class="line">

                        <div class="table-responsive">
                            <table class='display' id='datatables'>
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="7%">Thumbnail</th>
                                        <th>Title</th>
                                        <th>Link</th>
                                        <th width="18%">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>

                                <?php
                                    $no=1;
                                    $sosmed = $database->select($fields="*", $table="sosmed", $where_clause="ORDER BY id_sosmed DESC", $fetch="all");
                                    foreach ($sosmed as $key => $value) {
                                ?>

                                    <tr>
                                        <th><?php echo $no; ?></th>
                                        <td><img src="../joimg/sosmed/<?php echo $value['gambar'];?>" alt="" width="40px"></td>
                                        <td><?php echo $value['nama']; ?></td>
                                        <td><?php echo $value['link']; ?></td>
                                        <td>
                                            <a href="?module=sosmed&act=edit&id=<?php echo $value['id_sosmed'];?>" class="btn bgm-teal waves-effect"><i class="zmdi zmdi-edit zmdi-hc-fw"></i> Edit</a>
                                            <a href="<?php echo "$aksi&act=delete&id=$value[id_sosmed]";?>" class="btn bgm-pink waves-effect" onclick="return confirm('Apakah anda yakin menghapus data ini?');"><i class="zmdi zmdi-delete zmdi-hc-fw"></i> Delete</a>
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
                            <p class="c-black f-500 m-b-20">Setting Web / Social Media / Add New</p>
                            <hr class="line">
                            <form method="post" enctype="multipart/form-data" action="<?php echo $aksi;?>&act=insert">

                                <div class="row">
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Title</label>
                                                <input type="text" name="nama" class="form-control" placeholder="Enter title social media" maxlength="100">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Link</label>
                                                <input type="text" name="link" class="form-control" placeholder="Enter link social media" maxlength="150">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
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

                                <div class="alert alert-info" role="alert"><b>Attention!</b> <br><p style="font-size: 13px;"><b>Image Type :</b> JPG/JPEG. <b>Size :</b> 40 x 40 pixels. </div>

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
    $value  = $database->select($fields="*", $table="sosmed", $where_clause="WHERE id_sosmed = '$id'", $fetch='');
    //$value  = db_get_one("SELECT * FROM sosmed WHERE id_sosmed='$id'");
?>

                    <div class="card">

                        <div class="card-body card-padding">
                            <p class="c-black f-500 m-b-20">Setting Web - Edit Social Media</p>
                            <hr class="line">
                            <form method="post" enctype="multipart/form-data" action="<?php echo $aksi;?>&act=update">

                                <input type="hidden" name="id" value="<?php echo $id;?>">

                                <div class="row">
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Title </label>
                                                <input type="text" name="nama" class="form-control" placeholder="Enter title social media" maxlength="100" value="<?php echo $value['nama'];?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Link </label>
                                                <input type="text" name="link" class="form-control" placeholder="Enter link social media" maxlength="150" value="<?php echo $value['link'];?>">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Image</label>
                                                <br>

                                                <img src="../joimg/sosmed/<?php echo $value['gambar'];?>" alt="" width="40px">
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

                                <div class="alert alert-info" role="alert"><b>Attention!</b> <br><p style="font-size: 13px;"><b>Image Type :</b> JPG/JPEG. <b>Size :</b> 40 x 40 pixels. </p></div>

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
