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

    <script src="assets/vendors/input-mask/input-mask.min.js"></script>

<?php
    $aksi="modul/mod_kontak/aksi_kontak.php?module=kontak";
    switch($_GET['act']){
    default:
    include_once '../josys/class/Rupiah.php';
?>

                <div class="card">
                    <div class="card-body card-padding">

                        <p class="c-black f-500 m-b-20">Company Profile - Contact Info
                        </p>

                        <hr class="line">

                        <div class="table-responsive">
                            <table class='display' id='datatables'>
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama </th>
                                        <th>Title</th>
                                        <th width="18%">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php
                                    $no=1;
                                    $promo = $database->select($fields="*", $table="kontak", $where_clause="ORDER BY tgl_posting DESC", $fetch="all");
                                    foreach ($promo as $key => $value) {
                                ?>

                                    <tr>
                                        <th><?php echo $no; ?></th>
                                        <td><?php echo $value['nama'];?></td>
                                        <td><?php echo $value['judul'];?></td>
                                        <td>
                                            <a href="?module=kontak&act=edit&id=<?php echo $value['id_kontak'];?>" class="btn bgm-teal waves-effect"><i class="zmdi zmdi-edit zmdi-hc-fw"></i> Edit</a>
                                            <!-- <a href="<?php echo "$aksi&act=delete&id=$value[id_kontak]";?>" class="btn bgm-pink waves-effect" onclick="return confirm('Apakah anda yakin menghapus data ini?');"><i class="zmdi zmdi-delete zmdi-hc-fw"></i> Delete</a> -->
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
    case "edit":
    $id     = $_GET['id'];
    $value  = $database->select($fields="*", $table="kontak", $where_clause="WHERE id_kontak = '$id'", $fetch='');
?>

                    <div class="card">

                        <div class="card-body card-padding">
                            <p class="c-black f-500 m-b-20">Company Profile / Contact Info / Edit</p>
                            <hr class="line">
                            <form method="post" enctype="multipart/form-data" action="<?php echo $aksi;?>&act=update">

                                <input type="hidden" name="id" value="<?php echo $id;?>">

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Nama</label>
                                                <input type="text" name="nama" class="form-control" placeholder="masukkan nama kontak" maxlength="50" value="<?php echo $value['nama'];?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Title</label>
                                                <input type="text" name="title" class="form-control input-mask" placeholder="masukkan title kontak" maxlength="150" required="require"  value="<?php echo $value['judul'];?>">
                                            </div>
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
