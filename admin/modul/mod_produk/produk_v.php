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
    $aksi="modul/mod_produk/produk_c.php?module=produk";
    if (!isset($_GET['act'])) {
        $_GET['act'] = '';
    }
    switch($_GET['act']){
    default:
?>

                <div class="card">
                    <div class="card-body card-padding">

                        <p class="c-black f-500 m-b-20">Produk
                            <a href="?module=produk&act=add" class="btn bgm-deeppurple btn-sm m-t-10 waves-effect pull-right"><i class="zmdi zmdi-plus zmdi-hc-fw"></i> Add New</a>
                        </p>

                        <hr class="line">

                        <div class="table-responsive">
                            <table class='display' id='datatables'>
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="10%">Gambar</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Sub Kategori</th>
                                        <th>Best Seller</th>
                                        <th>Status</th>
                                        <th width="18%">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>

                                <?php
                                    $no=1;
                                    $posts = $database->select($fields="*", $table="produk", $where_clause="ORDER BY id_produk DESC", $fetch="all");
                                    foreach ($posts as $key => $value) {
                                        $brand = $database->select($fields="nama", $table="brand", $where_clause="WHERE id_brand='$value[id_brand]'");
                                        $kat = $database->select($fields="nama", $table="produk_kategori", $where_clause="WHERE id_produk_kategori='$value[id_produk_kategori]'");
                                ?>

                                    <tr>
                                        <th><?php echo $no; ?></th>
                                        <td><img src="../joimg/produk/thumbnail/<?php echo $value['image'];?>" alt="" width="50px"></td>
                                        <td><?php echo $value['nama']; ?></td>
                                        <td><?php echo $kat['nama']; ?></td>
                                        <td><?php echo $brand['nama']; ?></td>
                                        <td><?php if($value['best_seller'] == 'Y'){echo "<span style='color: green'>Yes</span>";}else{echo "<span style='color: red'>No</span>";} ?></td>
                                        <td><?php if($value['status'] == 'Y'){echo "<span style='color: green'>Publish</span>";}else{echo "<span style='color: red'>Hidden</span>";} ?></td>
                                        <td>
                                            <a href="?module=produk&act=edit&id=<?php echo $value['id_produk'];?>&kateg=<?php echo $value['id_produk_kategori'] ?>" class="btn bgm-teal waves-effect"><i class="zmdi zmdi-edit zmdi-hc-fw"></i> Edit</a>
                                            <a href="<?php echo "$aksi&act=delete&id=$value[id_produk]";?>" class="btn bgm-pink waves-effect" onclick="return confirm('Apakah anda yakin menghapus data ini?');"><i class="zmdi zmdi-delete zmdi-hc-fw"></i> Delete</a>
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
                            <p class="c-black f-500 m-b-20">Produk / Add New</p>
                            <hr class="line">

                            <form id="produk-form" method="post" enctype="multipart/form-data" action="<?php echo $aksi;?>&act=insert">
                                <div class="row">
                                    
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="fg-line">
                                                    <label>Judul Produk</label>
                                                    <input type="text" name="judul" class="form-control" placeholder="Enter title" maxlength="150" required="require">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="fg-line">
                                                        <label>Kategori <span class="color-red">*</span></label>
                                                        <div class="select">
                                                            <select class="form-control" name="kategori" id="d_kategori" required="require">
                                                                <option disabled="disable" selected="select">- Pilih -</option>
                                                                <?php
                                                                    $kat = $database -> select($fields='*', $table='produk_kategori', $where_clause='ORDER BY id_produk_kategori DESC', $fetch='all'); 
                                                                    foreach ($kat as $key => $k) {
                                                                        echo '
                                                                            <option value="'.$k['id_produk_kategori'].'">'.$k['nama'].'</option>
                                                                        ';
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                        </div>
                                        <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="fg-line">
                                                        <label>Sub Kategori <span class="color-red">*</span></label>
                                                        <div class="select">
                                                            <select class="form-control" name="brand" id="d_brand" required="require">
                                                                <option disabled="disable" selected="select">- Pilih -</option>
                                                                <?php
                                                                    $brand = $database -> select($fields='*', $table='brand', $where_clause='ORDER BY id_brand DESC', $fetch='all'); 
                                                                    foreach ($brand as $key => $b) {
                                                                        echo '
                                                                            <option value="'.$b['id_brand'].'">'.$b['nama'].'</option>
                                                                        ';
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
                                                <textarea name="deskripsi" class="form-control" rows="10" placeholder="Enter description..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                                                                
                                    <div class="col-md-4">
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
                                    
                                    <div class="col-md-4">
                                        <p class="c-black f-500 m-b-20">Best Seller ?</p>
                                        <label class="radio radio-inline m-r-20">
                                            <input type="radio" name="best_seller" value="Y" >
                                            <i class="input-helper"></i>
                                            Yes
                                        </label>
                                        <label class="radio radio-inline m-r-20">
                                            <input type="radio" name="best_seller" value="N" checked>
                                            <i class="input-helper"></i>
                                            No
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <p class="c-black f-500 m-b-20">Publish Post ?</p>
                                        <label class="radio radio-inline m-r-20">
                                            <input type="radio" name="status" value="Y" checked>
                                            <i class="input-helper"></i>
                                            Yes
                                        </label>
                                        <label class="radio radio-inline m-r-20">
                                            <input type="radio" name="status" value="N">
                                            <i class="input-helper"></i>
                                            No
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <div class="alert alert-info" role="alert"><b>Attention!</b> <br><p style="font-size: 13px;"><b>Image Type :</b> JPG, PNG, JPEG. </div>

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
    $value      = $database->select($fields="*", $table="produk", $where_clause="WHERE id_produk = '$id'", $fetch="");
?>

                   <div class="card">

                        <div class="card-body card-padding">
                            <p class="c-black f-500 m-b-20">Produk / Edit</p>
                            <hr class="line">

                            <form id="produk-form" method="post" enctype="multipart/form-data" action="<?php echo $aksi;?>&act=update">
                                <div class="row">
                                        <input type="hidden" name="id" value="<?php echo $id;?>">
                                        <input type="hidden" name="category" value="<?php echo $_GET['kateg'];?>">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="fg-line">
                                                        <label>Judul produk</label>
                                                        <input type="text" name="judul" class="form-control" placeholder="Enter title"  value="<?php echo $value['nama'];?>" maxlength="128">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="fg-line">
                                                        <label>Kategori <span class="color-red">*</span></label>
                                                        <div class="select">
                                                            <select class="form-control" name="kategori" id="d_kategori" required="require">
                                                                <?php
                                                                    $kat = $database -> select($fields='*', $table='produk_kategori', $where_clause='ORDER BY id_produk_kategori DESC', $fetch='all'); 
                                                                    foreach ($kat as $key => $k) {
                                                                        if ($k['id_produk_kategori']==$value['id_produk_kategori']) {
                                                                            echo '<option value="'.$k['id_produk_kategori'].'" selected>'.$k['nama'].'</option>';
                                                                        } else {
                                                                            echo '
                                                                                <option value="'.$k['id_produk_kategori'].'">'.$k['nama'].'</option>
                                                                            ';
                                                                        }

                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                        </div>
                                        <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="fg-line">
                                                        <label>Sub Kategori <span class="color-red">*</span></label>
                                                        <div class="select">
                                                            <select class="form-control" name="brand" id="d_brand" required="require">
                                                                <option disabled="disable" selected="select">- Pilih -</option>
                                                                <?php
                                                                    $brand = $database -> select($fields='*', $table='brand', $where_clause='ORDER BY id_brand DESC', $fetch='all'); 
                                                                    foreach ($brand as $key => $b) {
                                                                        if ($b['id_brand']==$value['id_brand']) {
                                                                            echo '<option value="'.$b['id_brand'].'" selected>'.$b['nama'].'</option>';
                                                                        } else {
                                                                            echo '
                                                                                <option value="'.$b['id_brand'].'">'.$b['nama'].'</option>
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
                                                    <textarea name="deskripsi" class="form-control" rows="10" placeholder="Enter description..."><?php echo $value['deskripsi'];?></textarea>
                                                </div>
                                            </div>
                                        </div>                                    
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Image</label>
                                                <br>
                                                <img src="../joimg/produk/thumbnail/<?php echo $value['image'];?>" alt="<?php echo $value['image'];?>" width="300px">
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
                                    
                                    <div class="col-md-4">
                                        <p class="c-black f-500 m-b-20">Best Seller ?</p>

                                        <label class="radio radio-inline m-r-20">
                                            <input type="radio" name="best_seller" value="Y" <?php if($value['best_seller'] == 'Y'){echo "checked";}?>>
                                            <i class="input-helper"></i>
                                            Yes
                                        </label>
                                        <label class="radio radio-inline m-r-20">
                                            <input type="radio" name="best_seller" value="N" <?php if($value['best_seller'] == 'N'){echo "checked";}?>>
                                            <i class="input-helper"></i>
                                            No
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <p class="c-black f-500 m-b-20">Publish Post ?</p>

                                        <label class="radio radio-inline m-r-20">
                                            <input type="radio" name="status" value="Y" <?php if($value['status'] == 'Y'){echo "checked";}?>>
                                            <i class="input-helper"></i>
                                            Yes
                                        </label>
                                        <label class="radio radio-inline m-r-20">
                                            <input type="radio" name="status" value="N" <?php if($value['status'] == 'N'){echo "checked";}?>>
                                            <i class="input-helper"></i>
                                            No
                                        </label>
                                    </div>
                                </div>
                                <br>

                                <div class="alert alert-info" role="alert"><b>Attention!</b> <br><p style="font-size: 13px;"><b>Image Type :</b> JPG/JPEG/PNG. </div>

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

<script type="text/javascript">

    $("#d_kategori").change(function(){
   
    // variabel dari nilai combo box provinsi
    var id_kategori = $("#d_kategori").val();                      
                               
    // mengirim dan mengambil data
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "modul/mod_produk/cari_brand.php",
        data: "kategori="+id_kategori,
        success: function(msg){                          
            // jika tidak ada data
            if(msg == ''){
                alert('Tidak ada data Sub Kategori');
            }
            // jika dapat mengambil data,, tampilkan di combo box kota
            else{
                $("#d_brand").html(msg);                              
            }                             
        }
    });    
    });
</script>