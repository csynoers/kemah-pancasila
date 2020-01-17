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


<?php
    $aksi="modul/mod_enquiry/enquiry_c.php?module=enquiry";
    switch($_GET['act']){
    default:
?>

                <div class="card">
                    <div class="card-body card-padding">

                        <p class="c-black f-500 m-b-20">Inbox / Enquiry </p>

                        <hr class="line">

                        <div class="table-responsive">
                            <table class='display' id='datatables'>
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>DateTime</th>
                                        <th>Readed?</th>
                                        <th width="18%">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>

                                <?php
                                    $no=1;
                                    $enquiry = $database->select($fields="*", $table="enquiry", $where_clause="ORDER BY id_enquiry DESC", $fetch="all");
                                    foreach ($enquiry as $key => $value) {
                                ?>

                                    <tr>
                                        <th><?php echo $no; ?></th>
                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $value['email']; ?></td>
                                        <td><?php echo $value['dateTime']; ?></td>
                                        <td><?php if($value['status'] == '1'){echo "<span style='color: green'>Sudah dibaca</span>";}else{echo "<span style='color: red'>Belum dibaca</span>";}?></td>
                                        <td>
                                            <a href="?module=enquiry&act=detail&id=<?php echo $value['id_enquiry'];?>" class="btn bgm-cyan waves-effect"><i class="zmdi zmdi-eye zmdi-hc-fw"></i> Detail</a>
                                            <a href="<?php echo "$aksi&act=delete&id=$value[id_enquiry]";?>" class="btn bgm-pink waves-effect" onclick="return confirm('Apakah anda yakin menghapus data ini?');"><i class="zmdi zmdi-delete zmdi-hc-fw"></i> Delete</a>
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
    case "detail":
    $id     = $_GET['id'];
    $value  = $database->select($fields="*", $table="enquiry", $where_clause="WHERE id_enquiry='$id'");

    //data yang akan diupdate berbentuk array
    $form_data = array(
        "status"	=> "1"
    );
    //proses update ke database
    $database->update($table="enquiry", $array=$form_data, $fields_key="id_enquiry", $id="$id");

    include "../josys/function/Download.php";
?>

                    <div class="card">

                        <div class="card-body card-padding">
                            <p class="c-black f-500 m-b-20">Inbox / Detail Enquiry - <?php echo $value['name'];?> </p>
                            <hr class="line">
                            <form method="post" enctype="multipart/form-data" action="<?php echo $aksi;?>&act=update">

                                <input type="hidden" name="id" value="<?php echo $id;?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <p class="c-black f-500 m-b-20">Data Customer </p>
                                                <hr class="line">
                                                
                                                <div class="fg-line">
                                                    <label>Name </label>
                                                    <input type="text" name="name" class="form-control" maxlength="100" value="<?php echo $value['name'];?>" readonly>
                                                </div>
                                                <div class="fg-line">
                                                    <label>Email </label>
                                                    <input type="email" name="email" class="form-control" maxlength="150" value="<?php echo $value['email'];?>" readonly>
                                                </div>
                                                <div class="fg-line">
                                                    <label>Phone </label>
                                                    <input type="text" name="phone" class="form-control" maxlength="150" value="<?php echo $value['phone'];?>" readonly>
                                                </div>                                                
                                                <div class="fg-line">
                                                    <label>Alamat </label>
                                                    <textarea name="alamat" class="form-control" rows="5" readonly><?php echo $value['alamat'];?></textarea>
                                                </div>
                                                <div class="fg-line">
                                                    <label>Note </label>
                                                    <textarea name="message" class="form-control" rows="5" readonly><?php echo $value['message'];?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                        $produk = $database->select($fields='*', $table="produk", $where_clause="WHERE id_produk = '$value[id_produk]'");
                                     ?>
                                    <div class="col-md-6">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <p class="c-black f-500 m-b-20">Data Product </p>
                                                <hr class="line">
                                                <div class="fg-line">
                                                    <label>Id Enquiry </label>
                                                    <input type="text" name="name" class="form-control" maxlength="100" value="<?php echo $value['id_enquiry'];?>" readonly>
                                                </div>
                                                <div class="fg-line">
                                                    <label>DateTime </label>
                                                    <input type="text" name="dateTime" class="form-control" maxlength="150" value="<?php echo $value['dateTime'];?>" readonly>
                                                </div>
                                                <div class="fg-line">
                                                    <label>Produk </label>
                                                    <input type="text" name="name" class="form-control" maxlength="100" value="<?php echo $produk['nama'];?>" readonly>
                                                </div>
                                                <div class="fg-line"><br>
                                                    <img  src="../joimg/produk/thumbnail/<?php echo $produk['image'];?>" alt="<?php echo $value['image'];?>" width="200px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>

                                <!-- <div class="form-group kaki">
                                    <button type="button" class="btn btn-danger btn-sm m-t-10 waves-effect" onclick="self.history.back()"><i class="zmdi zmdi-close"></i> Cancel</button>
                                </div> -->

                            </form>

                            <p class="c-black f-500 m-b-20">Kirim Info Enquiry </p>
                            <hr class="line">
                            <form method="post" enctype="multipart/form-data" action="<?php echo $aksi;?>&act=kirimemail">
                                <div class="form-group">
                                  <label>Kepada</label> : <input type='text' class="form-control" name='email' size=30 value='<?php echo $value['email'];?>'>
                                </div>
                                <div class="form-group">
                                  <label>Subjek</label> : <input type='text' class="form-control" name='subjek' size=50 value='Info Caltics Jogja'>
                                </div>
                                <div class="form-group">                                
                                  <label>Pesan</label>
                                  <textarea name='pesan' class="form-control" style='height: 450px;' id='konten'>      
                                  <p>Dengan ini, Kami sampaikan bahwa kami telah menerima permintaan enquiry dari Anda sebagai berikut.</p>
                                  --------------------------------------------------------------------------------------
                                        <p>Detail:</p><br/>
                                        <p>No. Enquiry: <?php echo $value['id_enquiry'];?></p>
                                        <p>Atas nama: <?php echo $value['name'];?></p> 
                                        <p>Terima kasih...</p>
                                  --------------------------------------------------------------------------------------
                                  </textarea>
                                </div> 
                                <div class="form-group kaki">
                                    <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect"><i class="zmdi zmdi-check"></i> Kirim</button>                                    
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
