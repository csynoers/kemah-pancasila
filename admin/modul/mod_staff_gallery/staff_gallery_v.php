<?php
// session_start();
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
        $('#datatables').DataTable({
        "lengthMenu": [[25, 50, -1], [25, 50, "All"]]
        } );
    } );
    </script>
    <!-- TinyMCE 4.x -->
    <script type="text/javascript" src="../jolib/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
    tinymce.init({
        selector: "textarea",
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
    $aksi="modul/mod_staff_gallery/staff_gallery_c.php?module=staff_gallery&id_staff=$_GET[id_staff]";
    if (!isset($_GET['act'])) {
        $_GET['act'] = '';
    }
    switch($_GET['act']){
    default:
?>

                <div class="card">
                    <div class="card-body card-padding">
                        <?php 
                            $kat = $database->select($fields="name", $table="staff", $where_clause="WHERE id_staff='$_GET[id_staff]'");
                         ?>
                        <p class="c-black f-500 m-b-20"><a href="?module=staff">Staff</a> - <?php echo $kat['name']; ?> - List
                            <a href="?module=staff_gallery&id_staff=<?php echo $_GET['id_staff'] ?>&act=add" class="btn bgm-deeppurple btn-sm m-t-10 waves-effect pull-right"><i class="zmdi zmdi-plus zmdi-hc-fw"></i> Add New</a>
                        </p>

                        <hr class="line">

                        <div class="table-responsive">
                            <table class='display' id='datatables'>
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="10%">Gambar</th>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th>Division</th>
                                        <th>Status</th>
                                        <th width="18%">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>

                                <?php
                                    $no=1;
                                    $posts = $database->select($fields="*", $table="staff_gallery", $where_clause="WHERE id_kategori = '$_GET[id_staff]'ORDER BY id_staff_gallery DESC", $fetch="all");
                                    foreach ($posts as $key => $value) {
                                        
                                ?>

                                    <tr>
                                        <th><?php echo $no; ?></th>
                                        <td><img src="../joimg/staff_gallery/<?php echo $value['image'];?>" alt="" width="50px"></td>
                                        <td><?php echo $value['nama']; ?></td>
                                        <td><?php echo substr(strip_tags($value['deskripsi']),0,100); ?></td>
                                        <td><?php echo $kat['name']; ?></td>
                                        <td><?php if($value['status'] == '1'){echo "<span style='color: green'>Publish</span>";}else{echo "<span style='color: red'>Hidden</span>";} ?></td>
                                        <td>
                                            <a href="?module=staff_gallery&id_staff=<?php echo $_GET['id_staff'] ?>&act=edit&id=<?php echo $value['id_staff_gallery'];?>" class="btn bgm-teal waves-effect"><i class="zmdi zmdi-edit zmdi-hc-fw"></i> Edit</a>                                            

                                            <a href="<?php echo "$aksi&act=delete&id=$value[id_staff_gallery]";?>" class="btn bgm-pink waves-effect" onclick="return confirm('Apakah anda yakin menghapus data ini?');"><i class="zmdi zmdi-delete zmdi-hc-fw"></i> Delete</a>
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
                        <?php 
                            $kat = $database->select($fields="name", $table="staff", $where_clause="WHERE id_staff='$_GET[id_staff]'");
                         ?>
                        <p class="c-black f-500 m-b-20"><a href="?module=staff">Staff</a> - <?php echo $kat['name']; ?> - List / Add New</p>
                            <hr class="line">

                            <form id="staff_gallery-form" method="post" enctype="multipart/form-data" action="<?php echo $aksi;?>&act=insert">
                                <div class="row">
                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="fg-line">
                                                    <label>Name</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Enter title" maxlength="150" required="require">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="fg-line">
                                                        <label>Staff Division<span class="color-red">*</span></label>
                                                        <div class="select">
                                                            <select class="form-control" name="kategori" id="d_kategori" required="require">
                                                                <option disabled="disable" selected="select">- Pilih -</option>
                                                                <?php
                                                                    $kat = $database -> select($fields='*', $table='staff', $where_clause="WHERE id_staff='".$_GET['id_staff']."' ORDER BY id_staff DESC", $fetch='all'); 
                                                                    foreach ($kat as $key => $k) {
                                                                    if ($k['id_staff']==$_GET['id_staff']) {
                                                                            echo '<option value="'.$k['id_staff'].'" selected>'.$k['name'].'</option>';
                                                                        } else {
                                                                            echo '
                                                                                <option value="'.$k['id_staff'].'">'.$k['name'].'</option>
                                                                            ';
                                                                        }
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="fg-line">
                                                    <label>Description</label>
                                                    <textarea id="konten" name="deskripsi" class="form-control" rows="10" placeholder="Enter description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Image <span class="color-red">*</span></label>
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
                                        <p class="c-black f-500 m-b-20">Publish Post ?</p>
                                        <label class="radio radio-inline m-r-20">
                                            <input type="radio" name="status" value="1" checked>
                                            <i class="input-helper"></i>
                                            Yes
                                        </label>
                                        <label class="radio radio-inline m-r-20">
                                            <input type="radio" name="status" value="0">
                                            <i class="input-helper"></i>
                                            No
                                        </label>
                                    </div>
                                                                                
                                    
                                    
                                    
                                </div>
                                <br>
                                <div class="alert alert-info" role="alert"><b>Attention!</b> <br><p style="font-size: 13px;"><b>Image Type :</b> JPG, PNG, JPEG. <b>Size :</b> 190 x 120 pixels</div>

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
    $value      = $database->select($fields="*", $table="staff_gallery", $where_clause="WHERE id_staff_gallery = '$id'", $fetch="");
?>

                   <div class="card">

                        <div class="card-body card-padding">
                        <?php 
                            $kat = $database->select($fields="name", $table="staff", $where_clause="WHERE id_staff='$_GET[id_staff]'");
                         ?>
                        <p class="c-black f-500 m-b-20"><a href="?module=staff">Staff</a> - <?php echo $kat['name']; ?> - List / Edit</p>
                            <hr class="line">

                            <form id="staff_gallery-form" method="post" enctype="multipart/form-data" action="<?php echo $aksi;?>&act=update">
                                <div class="row">
                                    <input type="hidden" name="id" value="<?php echo $id;?>">
                                    <input type="hidden" name="id_kategori" value="<?php echo $_GET['id_staff'];?>">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="fg-line">
                                                    <label>Name</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Enter title"  value="<?php echo $value['nama'];?>" maxlength="128">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="fg-line">
                                                    <label>Staff Division<span class="color-red">*</span></label>
                                                    <div class="select">
                                                        <select class="form-control" name="kategori" id="d_kategori" required="required">
                                                            <?php
                                                                $kat = $database -> select($fields='*', $table='staff', $where_clause="WHERE id_staff = '".$value['id_kategori']."' ORDER BY id_staff DESC", $fetch='all'); 
                                                                foreach ($kat as $key => $k) {
                                                                    if ($k['id_staff']==$value['id_kategori']) {
                                                                        echo '<option value="'.$k['id_staff'].'" selected>'.$k['name'].'</option>';
                                                                    } else {
                                                                        echo '
                                                                            <option value="'.$k['id_staff'].'">'.$k['name'].'</option>
                                                                        ';
                                                                    }

                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="fg-line">
                                                    <label>Description</label>
                                                    <textarea id="konten" name="deskripsi" class="form-control" rows="10" placeholder="Enter description"><?php echo $value['deskripsi'];?></textarea>
                                                </div>
                                            </div>
                                        </div>  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Image</label>
                                                <br>
                                                <img src="../joimg/staff_gallery/<?php echo $value['image'];?>" alt="<?php echo $value['image'];?>" width="100px">
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
                                        <p class="c-black f-500 m-b-20">Publish Post ?</p>

                                        <label class="radio radio-inline m-r-20">
                                            <input type="radio" name="status" value="1" <?php if($value['status'] == '1'){echo "checked";}?>>
                                            <i class="input-helper"></i>
                                            Yes
                                        </label>
                                        <label class="radio radio-inline m-r-20">
                                            <input type="radio" name="status" value="0" <?php if($value['status'] == '0'){echo "checked";}?>>
                                            <i class="input-helper"></i>
                                            No
                                        </label>
                                    </div>
                                    
                                    
                                    
                                </div>
                                <br>

                                <div class="alert alert-info" role="alert"><b>Attention!</b> <br><p style="font-size: 13px;"><b>Image Type :</b> JPG, PNG, JPEG. <b>Size :</b> 190 x 120 pixels</div>

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
