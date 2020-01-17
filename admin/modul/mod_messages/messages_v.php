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
    $aksi="modul/mod_messages/messages_c.php?module=messages";
    switch($_GET['act']){
    default:
?>

                <div class="card">
                    <div class="card-body card-padding">

                        <p class="c-black f-500 m-b-20">Support Web - messages </p>

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
                                    $messages = $database->select($fields="*", $table="messages", $where_clause="ORDER BY id_messages DESC", $fetch="all");
                                    foreach ($messages as $key => $value) {
                                ?>

                                    <tr>
                                        <th><?php echo $no; ?></th>
                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $value['email']; ?></td>
                                        <td><?php echo $value['dateTime']; ?></td>
                                        <td><?php if($value['status'] == '1'){echo "<span style='color: green'>Sudah dibaca</span>";}else{echo "<span style='color: red'>Belum dibaca</span>";}?></td>
                                        <td>
                                            <a href="?module=messages&act=detail&id=<?php echo $value['id_messages'];?>" class="btn bgm-cyan waves-effect"><i class="zmdi zmdi-eye zmdi-hc-fw"></i> Detail</a>
                                            <a href="<?php echo "$aksi&act=delete&id=$value[id_messages]";?>" class="btn bgm-pink waves-effect" onclick="return confirm('Apakah anda yakin menghapus data ini?');"><i class="zmdi zmdi-delete zmdi-hc-fw"></i> Delete</a>
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
    $value  = $database->select($fields="*", $table="messages", $where_clause="WHERE id_messages='$id'");

    //data yang akan diupdate berbentuk array
    $form_data = array(
        "status"	=> "1"
    );
    //proses update ke database
    $database->update($table="messages", $array=$form_data, $fields_key="id_messages", $id="$id");

    include "../josys/function/Download.php";
?>

                    <div class="card">

                        <div class="card-body card-padding">
                            <p class="c-black f-500 m-b-20">Support Web / Detail messages / <?php echo $value['name'];?> </p>
                            <hr class="line">
                            <form method="post" enctype="multipart/form-data" action="<?php echo $aksi;?>&act=update">

                                <input type="hidden" name="id" value="<?php echo $id;?>">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Name </label>
                                                <input type="text" name="name" class="form-control" maxlength="100" value="<?php echo $value['name'];?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Subject </label>
                                                <input type="text" name="subject" class="form-control" maxlength="150" value="<?php echo $value['subject'];?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Email </label>
                                                <input type="email" name="email" class="form-control" maxlength="150" value="<?php echo $value['email'];?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Phone </label>
                                                <input type="text" name="phone" class="form-control" maxlength="150" value="<?php echo $value['phone'];?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>DateTime </label>
                                                <input type="text" name="dateTime" class="form-control" maxlength="150" value="<?php echo $value['dateTime'];?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <label>Message </label>
                                                <textarea name="message" class="form-control" rows="5" readonly><?php echo $value['message'];?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group kaki">
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
