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
        $('#datatables').DataTable({
            "lengthMenu": [[25, 50, -1], [25, 50, "All"]]
        });
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
    $aksi="modul/mod_campus/campus_c.php?module=campus";
    switch($_GET['act']){
    default:
?>

        <div class="card">
            <div class="card-body card-padding">

                <p class="c-black f-500 m-b-20">Campus
                    <a href="?module=campus&act=add" class="btn bgm-deeppurple btn-sm m-t-10 waves-effect pull-right"><i class="zmdi zmdi-plus zmdi-hc-fw"></i> Add New</a>
                </p>

                <hr class="line">

                <div class="table-responsive">
                    <table class='display' id='datatables'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width="45%">Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php
                            $no=1;
                            $posts = $database->select($fields="*", $table="campus", $where_clause="ORDER BY id_campus ASC", $fetch="all");
                            foreach ($posts as $key => $value) {
                        ?>

                            <tr>
                                <th><?php echo $no; ?></th>
                                <td><?php echo $value['name']; ?></td>
                                <td><?php if($value['status'] == 'Y'){echo "<span style='color: green'>Publish</span>";}else{echo "<span style='color: red'>Hidden</span>";} ?></td>
                                <td>
                                    <a href="?module=campus&act=edit&id=<?php echo $value['id_campus'];?>" class="btn bgm-teal waves-effect"><i class="zmdi zmdi-edit zmdi-hc-fw"></i> Edit</a>

                                    <a href="?module=slideshow&kat=<?php echo $value['id_campus'];?>" class="btn bgm-blue waves-effect"><i class="zmdi zmdi-plus zmdi-hc-fw"></i> Gallery</a>

                                    <a href="<?php echo "$aksi&act=delete&id=$value[id_campus]";?>" class="btn bgm-pink waves-effect" onclick="return confirm('Apakah anda yakin menghapus data ini?');"><i class="zmdi zmdi-delete zmdi-hc-fw"></i> Delete</a>
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
                <p class="c-black f-500 m-b-20">Campus / Add New</p>
                <hr class="line">

                <form method="post" enctype="multipart/form-data" action="<?php echo $aksi;?>&act=insert">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="fg-line">
                                    <label>Campus Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter title" maxlength="150" required="require">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="fg-line">
                                    <label>Description</label>
                                    <textarea id="konten" name="deskripsi" class="form-control" rows="10" placeholder="Enter description"></textarea>
                                </div>
                            </div>
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
    $value      = $database->select($fields="*", $table="campus", $where_clause="WHERE id_campus = '$id'", $fetch="");
?>

        <div class="card">

            <div class="card-body card-padding">
                <p class="c-black f-500 m-b-20">Campus / Edit</p>
                <hr class="line">

                <form method="post" enctype="multipart/form-data" action="<?php echo $aksi;?>&act=update">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="hidden" name="category" value="<?php echo $_GET['kateg'];?>">
                                <div class="form-group">
                                    <div class="fg-line">
                                        <label>Campus Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter title"  value="<?php echo $value['name'];?>" maxlength="128">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="fg-line">
                                        <label>Description</label>
                                        <textarea id="konten" name="deskripsi" class="form-control" rows="10" placeholder="Enter description"><?php echo $value['deskripsi'];?></textarea>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="row">
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