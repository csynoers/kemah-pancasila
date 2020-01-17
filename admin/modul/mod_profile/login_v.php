<?php
session_start();
if (empty($_SESSION['id_users']) || empty($_SESSION['username']) || empty($_SESSION['password'])){
    echo "
    <center>Untuk mengakses modul, Anda harus login <br>
    <a href=../../index.php><b>LOGIN</b></a></center>";
}
else {
$id_profile = $_SESSION['id_users'];
$profile    = $database->select($fields="*", $table="users", $where_clause="WHERE id_users = '$id_profile'", $fetch="");
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
                                <li class="waves-effect"><a href="?module=profile">Settings Profile</a></li>
                                <li class="active waves-effect"><a href="?module=login">Settings Login</a></li>
                            </ul>

                            <div class="pmb-block">
                                <div class="pmbb-header">

                                    <div class="pmbb-body p-l-30">

                                        <div class="col-sm-12">
                                            <form method="post" action="modul/mod_profile/login_c.php?module=login&act=update">
                                                <input type="hidden" name="id" value="<?php echo $_SESSION['id_users'];?>">						
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                                    <div class="fg-line">
                                                        <label>Username</label>
                                                            <input type="text" name="username" class="form-control" placeholder="Username">
                                                    </div>
                                                </div>

                                                <br>
                                                
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="zmdi zmdi-key"></i></span>
                                                    <div class="fg-line">
                                                        <label>Old Password</label>
                                                        <input type="password" name="oldpassword" class="form-control" placeholder="Old Password">
                                                    </div>
                                                </div>

                                                <br>

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="zmdi zmdi-key"></i></span>
                                                    <div class="fg-line">
                                                        <label>New Password</label>
                                                        <input type="password" name="newpassword1" class="form-control input-mask" placeholder="New Password">
                                                    </div>
                                                </div>

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="zmdi zmdi-key"></i></span>
                                                    <div class="fg-line">
                                                        <label>Confirm New Password</label>
                                                        <input type="password" name="newpassword2" class="form-control input-mask" placeholder="Confirm New Password">
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
