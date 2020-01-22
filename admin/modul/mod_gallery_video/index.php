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
    function getVideoId($url) {
        return (
            explode('=',explode('?',$url)[1])[1]
        );
    }
    $aksi="modul/mod_gallery_video/model.php?module=gallery_video";
    switch(empty($_GET['act']) ? NULL : $_GET['act'] ){
    default:
        $data = [];
        $data['rows'] = $database->select($fields="*", $table="gallery_video", $where_clause="ORDER BY tt DESC", $fetch="all");
        foreach ($data['rows'] as $key => $value) {
            $value['url'] = getVideoId($value['url']);
            $data['htmls'][] = "
                <div class='col-lg-4'>
                    <iframe class='w-100' height='300px' src='https://www.youtube.com/embed/{$value['url']}' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
                    <a href='{$aksi}&act=delete&id={$value['id']}' class='btn btn-block bgm-pink waves-effect waves-effect'><i class='zmdi zmdi-delete zmdi-hc-fw'></i> Delete</a>
                </div>
            ";
        }
        $data['htmls'] = implode('',$data['htmls']);
        $data['htmls'] = "
            <div class='card'>
                <div class='card-body card-padding'>
                    <p class='c-black f-500 m-b-20'>
                        Informasi Galeri Video
                    </p>
                    <hr class='line'>
                    <form action='{$aksi}&act=insert' method='post'>
                        <div class='form-group'>
                            <label>URL video</label>
                            <input required type='url' name='url' placeholder='Tambah video dari youtube ex: https://www.youtube.com/watch?v=wDTftdumGVg' class='form-control'>
                        </div>
                        <div class='form-group' id='embedVideo'>
                            
                        </div>
                        <div class='form-group'>
                            <button type='submit' class='btn btn-primary btn-sm waves-effect waves-effect'><i class='zmdi zmdi-check'></i> Save</button>
                        </div>
                    </form>
                    <hr class='line'>
                    <div class='row'>
                        {$data['htmls']}
                    </div>
                </div>
            </div>
        ";
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        echo $data['htmls'];
?>

<?php
    break;
    case "add":
?>
                   <div class="card">
                        <div class="card-body card-padding">
                            <p class="c-black f-500 m-b-20">Gallery / Add New</p>
                            <hr class="line">

                            <form id="gallery-form" method="post" enctype="multipart/form-data" action="<?php echo $aksi;?>&act=insert">
                                <div class="row">
                                    
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="fg-line">
                                                    <label>Nama gallery</label>
                                                    <input type="text" name="judul" class="form-control" placeholder="Enter title" maxlength="150" required="require">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="fg-line">
                                                        <label>Kategori <span class="color-red">*</span></label>
                                                        <div class="select">
                                                            <select class="form-control" name="kategori" id="d_kategori" required="require">
                                                                <option disabled="disable" selected="select">- Pilih -</option>
                                                                <?php
                                                                    $kat = $database -> select($fields='*', $table='gallery_kategori', $where_clause='ORDER BY id_gallery_kategori DESC', $fetch='all'); 
                                                                    foreach ($kat as $key => $k) {
                                                                        echo '
                                                                            <option value="'.$k['id_gallery_kategori'].'">'.$k['judul'].'</option>
                                                                        ';
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                        </div>
                                        <!-- <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="fg-line">
                                                    <label>URL Website</label>
                                                    <input type="text" name="url" class="form-control" placeholder="Enter website url" maxlength="150" required="require">
                                                </div>
                                            </div>
                                        </div> -->
                                                                                
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
    $value      = $database->select($fields="*", $table="gallery", $where_clause="WHERE id_gallery = '$id'", $fetch="");
?>

                   <div class="card">

                        <div class="card-body card-padding">
                            <p class="c-black f-500 m-b-20">Gallery / Edit</p>
                            <hr class="line">

                            <form id="gallery-form" method="post" enctype="multipart/form-data" action="<?php echo $aksi;?>&act=update">
                                <div class="row">
                                        <input type="hidden" name="id" value="<?php echo $id;?>">
                                        <input type="hidden" name="category" value="<?php echo $_GET['kateg'];?>">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="fg-line">
                                                        <label>Judul gallery</label>
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
                                                                    $kat = $database -> select($fields='*', $table='gallery_kategori', $where_clause='ORDER BY id_gallery_kategori DESC', $fetch='all'); 
                                                                    foreach ($kat as $key => $k) {
                                                                        if ($k['id_gallery_kategori']==$value['id_gallery_kategori']) {
                                                                            echo '<option value="'.$k['id_gallery_kategori'].'" selected>'.$k['judul'].'</option>';
                                                                        } else {
                                                                            echo '
                                                                                <option value="'.$k['id_gallery_kategori'].'">'.$k['judul'].'</option>
                                                                            ';
                                                                        }

                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                        </div>
                                        
                                            <!-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="fg-line">
                                                        <label>URL Website</label>
                                                        <input type="text" name="url" class="form-control" placeholder="Enter title"  value="<?php echo $value['url'];?>" maxlength="128">
                                                    </div>
                                                </div>
                                            </div> -->                                                                          
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Image</label>
                                                <br>
                                                <img src="../joimg/gallery/<?php echo $value['image'];?>" alt="<?php echo $value['image'];?>" width="300px">
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
