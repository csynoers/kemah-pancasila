<?php
session_start();
if (empty($_SESSION['id_users']) || empty($_SESSION['username']) || empty($_SESSION['password'])){
    echo "
    <center>Untuk mengakses modul, Anda harus login <br>
    <a href=../../index.php><b>LOGIN</b></a></center>";
}
else {
    $id     = $_GET['id'];
    $aksi   = "modul/mod_pages/pages_c.php?module=pages";
    switch($_GET['act']){
    default:
    $pages  = $database->select($fields="*", $table="modul", $where_clause="WHERE id_modul = '$id'");
?>
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

                    <div class="card">

                        <div class="card-body card-padding">
                            <p class="c-black f-500 m-b-20">Company Profile - <?php echo $pages["nama_modul"];?></p>
                            <hr class="line">
                            <form method='post' action='<?php echo $aksi;?>&act=update' enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $pages['id_modul']; ?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <textarea name="content" class="form-control" rows="10" placeholder="Enter your content"><?php echo $pages['static_content'];?></textarea>
                                            </div>
                                        </div>
                                    </div>                                

                                <?php 
                                    //if ($_GET['id']=='5' && $_GET['id']=='4') { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="fg-line">
                                                    <label>Image</label>
                                                    <br>
                                                    <img src="../joimg/modul/<?php echo $pages['gambar'];?>" alt="<?php echo $pages['gambar'];?>" width="300px">
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


                                            <?php
                                   // }
                                ?>

                                </div>
                                
                                <?php 
                                    //if ($_GET['id']!='5' && $_GET['id']!='4') { 
                                        ?>
                                        <div class="alert alert-info" role="alert"><b>Attention!</b> <br><p style="font-size: 13px;"><b>Image Type :</b> JPG, PNG, JPEG. <b>Image Size</b> : 750 x 320 pixels</div> <?php 
                                    //}
                                ?>        
                                
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
