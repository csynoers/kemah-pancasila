<?php
session_start();
if (empty($_SESSION['id_users']) || empty($_SESSION['username']) || empty($_SESSION['password'])){
    echo "
    <center>Untuk mengakses modul, Anda harus login <br>
    <a href=../../index.php><b>LOGIN</b></a></center>";
}
else {
$id_profile = $_SESSION['id_users'];
$profile    = $database->select($fields="*", $table="users", $where_clause="WHERE id_users = '$id_profile'");
?>
                    <div class="card" id="profile-main">
                        <div class="pm-overview c-overflow">
                            <div class="pmo-pic">
                                <div class="p-relative">
                                    <a href="#">
                                        <img class="img-responsive" src="assets/img/profile/<?php echo $profile['foto'];?>" alt="">
                                    </a>
                                </div>

                                <div class="pmo-stat">
                                    <?php echo $profile['nama_lengkap'];?>
                                </div>
                            </div>


                        </div>

                        <div class="pm-body clearfix">
                            <ul class="tab-nav tn-justified">
                                <li class="active waves-effect"><a href="?module=profile">Settings Profile</a></li>
                                <li class="waves-effect"><a href="?module=login">Settings Password <small><b>(*click for change Password)</b></small></a></li>
                            </ul>


                            <div class="pmb-block">
                                <div class="pmbb-header">

                                    <div class="pmbb-body p-l-30">
                                        <form method="post" enctype="multipart/form-data" action="modul/mod_profile/profile_c.php?module=profile&act=update">
                                            <input type="hidden" name="id" value="<?php echo $_SESSION['id_users'];?>">

                                            <div class="col-sm-6">

                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                                    <div>
                                                        <span class="btn btn-info btn-file">
                                                            <span class="fileinput-new">Select image</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="file" name="fupload">
                                                        </span>
                                                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                    </div>
                                                </div>

                                                <div class="alert alert-info" role="alert">Attention!</b> <br><b>Image Type :</b> JPG/JPEG. <b>Size :</b> 200 x 200pixel </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                                    <div class="fg-line">
                                                        <label>Full Name</label>
                                                            <input type="text" name="full_name" class="form-control" placeholder="Full Name" value="<?php echo $profile['nama_lengkap'];?>">
                                                    </div>
                                                </div>

                                                <br>

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="zmdi zmdi-account-box-mail"></i></span>
                                                    <div class="fg-line">
                                                        <label>Email</label>
                                                        <input type="email" name="email" class="form-control" placeholder="Email Address" value="<?php echo $profile['email'];?>">
                                                    </div>
                                                </div>

                                                <br>

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="zmdi zmdi-local-phone"></i></span>
                                                    <div class="fg-line">
                                                        <label>Phone Number</label>
                                                        <input type="text" name="phone" class="form-control input-mask" data-mask="0000-0000-0000" placeholder="eg: 000-00-0000000" maxlength="14" autocomplete="off" value="<?php echo $profile['no_telp'];?>">
                                                    </div>
                                                </div>

                                            </div>

                                            <hr>

                                            <div class="pull-right kaki">
                                                <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect"><i class="zmdi zmdi-check"></i> Save</button>
                                                <button type="button" class="btn btn-danger btn-sm m-t-10 waves-effect" onclick="self.history.back()"><i class="zmdi zmdi-close"></i> Cancel</button>
                                            </div>

                                         </form>

                                    </div>
                                </div>

                            </div>
                        </div>

<?php
}
?>
