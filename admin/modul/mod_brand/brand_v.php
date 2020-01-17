<?php
session_start();
if (empty($_SESSION['id_users']) || empty($_SESSION['username']) || empty($_SESSION['password'])){
    echo "
    <center>Untuk mengakses modul, Anda harus login <br>
    <a href=../../index.php><b>LOGIN</b></a></center>";
}
else {
?>
    <script src="assets/vendors/input-mask/input-mask.min.js"></script>
    <!--Begin DataTables-->
    <link rel="stylesheet" href="assets/vendors/dataTables/css/jquery.dataTables.css" type="text/css" media="screen" />
    <script type="text/javascript" charset="utf8" src="assets/vendors/dataTables/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="assets/vendors/dataTables/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#datatables').DataTable();
    } );
    </script>

    <!-- TinyMCE 4.x -->
    <script type="text/javascript" src="../jolib/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
    tinymce.init({
        selector: "#konten",
        theme: "modern",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality jbimages",
            "emoticons template paste textcolor colorpicker textpattern imagetools"
        ],

        toolbar1: "undo redo | styleselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | media jbimages | link forecolor backcolor emoticons | pagebreak print preview",
        image_advtab: true,
        relative_urls: false
    });
    </script>
    <!-- /TinyMCE -->
    <style>
    .radio-inline + .radio-inline, .checkbox-inline + .checkbox-inline {
        margin-left: 0px;
    }
    </style>
  

<?php
    $aksi="modul/mod_brand/brand_c.php?module=brand";
    switch($_GET['act']){
    default:
?>

                <div class="card">
                    <div class="card-body card-padding">

                        <p class="c-black f-500 m-b-20">Sub Kategori 
                            <a href="?module=brand&act=add" class="btn bgm-deeppurple btn-sm m-t-10 waves-effect pull-right"><i class="zmdi zmdi-plus zmdi-hc-fw"></i> Add New</a>
                        </p>

                        <hr class="line">

                        <div class="table-responsive">
                            <table class='display' id='datatables'>
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Logo</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Katalog</th>
                                        <th width="18%">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>

                                <?php
                                    $no=1;
                                    $posts = $database->select($fields="*", $table="brand", $where_clause="ORDER BY id_brand DESC", $fetch="all");
                                    foreach ($posts as $key => $value) {
                                        $kat = $database->select($fields="nama", $table="produk_kategori", $where_clause="WHERE id_produk_kategori='$value[id_produk_kategori]'");
                                ?>

                                    <tr>
                                        <th><?php echo $no; ?></th>
                                        <td><img src="../joimg/brand/<?php echo $value['image'];?>" alt="" width="100px"></td>
                                        <td><?php echo $value['nama']; ?></td>
                                        <td><?php echo $kat['nama']; ?></td>
                                        <td><a href="../jodoc/catalog/<?php echo $value['catalog']; ?>" target="_blank"><?php echo $value['catalog']; ?></a></td>
                                        <td>
                                            <a href="?module=brand&act=edit&id=<?php echo $value['id_brand'];?>" class="btn bgm-teal waves-effect"><i class="zmdi zmdi-edit zmdi-hc-fw"></i> Edit</a>
                                            <a href="<?php echo "$aksi&act=delete&id=$value[id_brand]";?>" class="btn bgm-pink waves-effect" onclick="return confirm('Apakah anda yakin menghapus data ini?');"><i class="zmdi zmdi-delete zmdi-hc-fw"></i> Delete</a>
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
                            <p class="c-black f-500 m-b-20">Sub Kategori / Add New</p>
                            <hr class="line">

                            <form method="post" enctype="multipart/form-data" action="<?php echo $aksi;?>&act=insert">
                                <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Judul Sub Kategori</label>
                                                <input type="text" name="judul" class="form-control" placeholder="Enter title" maxlength="150" required="require">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Kategori</label>
                                                <select class="form-control" name="kategori">
                                                    <option value="0" disabled="">-- Pilih Kategori --</option>
                                                    <?php 
                                                        $kat = $database->select($fields="*", $table="produk_kategori", $where_clause="", $fetch="all");
                                                        foreach ($kat as $key => $k) {
                                                            echo '<option value="'.$k['id_produk_kategori'].'">'.$k['nama'].'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Image Logo <span class="color-red">*</span></label>
                                                <br>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn btn-success btn-file m-r-10">
                                                        <span class="fileinput-new">Select file</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="fupload" required="require">
                                                    </span>
                                                    <span class="fileinput-filename"></span>
                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>File Katalog </label>
                                                <br>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn btn-success btn-file m-r-10">
                                                        <span class="fileinput-new">Select file</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="fuploadkatalog" >
                                                    </span>
                                                    <span class="fileinput-filename"></span>
                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Image Cover Katalog </label>
                                                <br>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn btn-success btn-file m-r-10">
                                                        <span class="fileinput-new">Select file</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="fuploadcover" >
                                                    </span>
                                                    <span class="fileinput-filename"></span>
                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                    <div class="alert alert-info" role="alert"><b>Attention!</b> <br><p style="font-size: 13px;"><b>Image Type :</b> JPG/JPEG. <b>Logo Size :</b> 330 x 120 pixels <br/>
                                        <p style="font-size: 13px;"><b>Image Type :</b> JPG/JPEG. <b>Cover Size :</b> 544 x 800 pixels  
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
    case "edit":
    $id         = $_GET['id'];
    $value      = $database->select($fields="*", $table="brand", $where_clause="WHERE id_brand = '$id'", $fetch="");
?>

                   <div class="card">

                        <div class="card-body card-padding">
                            <p class="c-black f-500 m-b-20">Produk Kategori / Edit</p>
                            <hr class="line">

                            <form method="post" enctype="multipart/form-data" action="<?php echo $aksi;?>&act=update">
                                <div class="row">
                                    <input type="hidden" name="id" value="<?php echo $id;?>">
                                    <input type="hidden" name="category" value="<?php echo $_GET['kateg'];?>">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Judul Sub Kategori</label>
                                                <input type="text" name="judul" class="form-control" placeholder="Enter title" maxlength="150" required="require" value="<?php echo $value['nama'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Kategori</label>
                                                <select class="form-control" name="kategori">
                                                    <option value="0" disabled="">-- Pilih Kategori --</option>
                                                    
                                                    <?php 
                                                        $kat = $database->select($fields="*", $table="produk_kategori", $where_clause="", $fetch="all");
                                                        foreach ($kat as $key => $k) {
                                                            if ($k['id_produk_kategori']==$value['id_produk_kategori']) {

                                                                echo '<option value="'.$k['id_produk_kategori'].'" selected>'.$k['nama'].'</option>';    
                                                            } else {
                                                                echo '<option value="'.$k['id_produk_kategori'].'">'.$k['nama'].'</option>';
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Image</label>
                                                <br>
                                                <img src="../joimg/brand/<?php echo $value['image'];?>" alt="<?php echo $value['image'];?>" width="200px">
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

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>File Katalog</label>
                                                <br>
                                                <a href="../jodoc/catalog/<?php echo $value['catalog']; ?>" target="_blank"><?php echo $value['catalog']; ?></a> 
                                                <br><br>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn btn-success btn-file m-r-10">
                                                        <span class="fileinput-new">Select file</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="fuploadkatalog">
                                                    </span>
                                                    <span class="fileinput-filename"></span>
                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Image Cover Katalog </label>
                                                <br>
                                                <img src="../joimg/cover/<?php echo $value['cover'];?>" alt="<?php echo $value['cover'];?>" width="100px">
                                                <br><br>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn btn-success btn-file m-r-10">
                                                        <span class="fileinput-new">Select file</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="fuploadcover" >
                                                    </span>
                                                    <span class="fileinput-filename"></span>
                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                    <div class="alert alert-info" role="alert"><b>Attention!</b> <br><p style="font-size: 13px;"><b>Image Type :</b> JPG/JPEG. <b>Logo Size :</b> 330 x 120 pixels <br/>
                                        <p style="font-size: 13px;"><b>Image Type :</b> JPG/JPEG. <b>Cover Size :</b> 544 x 800 pixels  
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