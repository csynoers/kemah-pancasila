<?php
ob_start(); // Added to avoid a common error of 'header already sent'
session_start();
error_reporting(0);
//Import System
require_once "config.php";
include "../josys/function/time_load.php";
time_load();

if (empty($_SESSION['id_users']) AND empty($_SESSION['username']) AND empty($_SESSION['passuser']))
{
	echo "
		<center>Anda harus login dulu <br>
		<a href=index.php><b>LOGIN</b></a></center>";
}
else
{
?>

<!DOCTYPE html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Page | <?php echo $config['web_name'];?></title>

        <!-- Icon -->
        <link rel="shortcut icon" href="../images/icon.png">

        <!-- Vendor CSS -->
        <link href="assets/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <link href="assets/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
        <link href="assets/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet">

        <link href="assets/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css" rel="stylesheet">

        <!-- CSS -->
        <link href="assets/css/mdl.app.css" rel="stylesheet">
        <link href="assets/css/mdl.app.min.css" rel="stylesheet">

        <!-- Custom CSS Style -->
        <link href="assets/css/custom.css" rel="stylesheet">

        <!-- Javascript Libraries -->
        <script src="assets/vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="assets/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="assets/vendors/bower_components/jquery.nicescroll/jquery.nicescroll.min.js"></script>
        <script src="assets/vendors/bower_components/Waves/dist/waves.min.js"></script>
        <script src="assets/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="assets/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>

    </head>
    <body class="sw-toggled">
        <header id="header">
            <ul class="header-inner">
                <li id="menu-trigger" data-trigger="#sidebar">
                    <div class="line-wrap">
                        <div class="line top"></div>
                        <div class="line center"></div>
                        <div class="line bottom"></div>
                    </div>
                </li>

                <li class="logo hidden-xs">
                    <a href="?module=home"><?php echo $config['web_name'];?> - Panel Admin</a>
                </li>

                <li class="pull-right">
					<ul class="top-menu">
                        
						<!-- <li class="dropdown">
							<a data-toggle="dropdown" class="tm-notification" href="#">
								<i class="tmn-counts">
									<?php
									$jmlh_enquiry = $database->count_rows($table="enquiry", $where_clause="WHERE status = '0' ORDER BY dateTime DESC");
									echo $jmlh_enquiry;
									?>
								</i>
							</a>
                            <div class="dropdown-menu dropdown-menu-lg pull-right">
                                <div class="listview">
                                    <div class="lv-header">
                                        Enquiry
                                    </div>
                                    <div class="lv-body">
                                        <?php
                                        $enquiry = $database->select($fields="id_enquiry, name, message", $table="enquiry", $where_clause="WHERE status = '0' ORDER BY dateTime DESC", $fetch="all");
                                        foreach ($enquiry as $key_pk => $val_pk) {
                                        echo '
                                        <a class="lv-item" href="?module=enquiry&act=detail&id='.$val_pk["id_enquiry"].'">
                                            <div class="media">
                                                <div class="media-body">
                                                    <div class="lv-title">'.$val_pk["name"].'</div>
                                                    <small class="lv-small">'.$val_pk["message"].'</small>
                                                </div>
                                            </div>
                                        </a>
                                        ';
                                        }
                                        ?>
                                    </div>
                                    <a class="lv-footer" href="?module=enquiry">View All</a>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="tm-message" href="#">
                                <i class="tmn-counts">
                                    <?php
                                    $jmlh_inbox = $database->count_rows($table="messages", $where_clause="WHERE status = '0' ORDER BY dateTime DESC");
                                    echo $jmlh_inbox;
                                    ?>
                                </i>
                            </a>
                            
							<div class="dropdown-menu dropdown-menu-lg pull-right">
								<div class="listview">
									<div class="lv-header">
										Messages
									</div>
									<div class="lv-body">
										<?php
										$messages = $database->select($fields="id_messages, name, message", $table="messages", $where_clause="WHERE status = '0' ORDER BY dateTime DESC", $fetch="all");
										foreach ($messages as $key_pk => $val_pk) {
										echo '
										<a class="lv-item" href="?module=messages&act=detail&id='.$val_pk["id_messages"].'">
											<div class="media">
												<div class="media-body">
													<div class="lv-title">'.$val_pk["name"].'</div>
													<small class="lv-small">'.$val_pk["message"].'</small>
												</div>
											</div>
										</a>
										';
										}
										?>
									</div>
									<a class="lv-footer" href="?module=messages">View All</a>
								</div>
							</div>
						</li> -->
                        
						<li class="dropdown">
							<a data-toggle="dropdown" class="tm-settings" href="#"></a>
							<ul class="dropdown-menu dm-icon pull-right">
								<li class="hidden-xs">
									<a data-action="fullscreen" href="#"><i class="zmdi zmdi-fullscreen"></i> Toggle Fullscreen</a>
								</li>
								<li>
	                                <a href="<?php echo $config["web_index"];?>" target="_blank"><i class="zmdi zmdi-window-restore"></i> View Web</a>
	                            </li>
								<li>
									<a href="?module=profile"><i class="zmdi zmdi-account"></i> Profile</a>
								</li>
								<li>
									<a href="logout.php"><i class="zmdi zmdi-power"></i> Logout</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>

            <!-- Top Search Content -->
            <div id="top-search-wrap">
                <input type="text">
                <i id="top-search-close">&times;</i>
            </div>
        </header>

        <section id="main">
            <aside id="sidebar" >
                <div class="sidebar-inner c-overflow">
                    <div class="profile-menu">
                        <a href="#">
                            <div class="profile-pic">
                                <?php
                                $id_profile_nav = $_SESSION['id_users'];
                                $profile_nav    = $database->select($fields="*", $table="users", $where_clause="WHERE id_users = '$id_profile_nav'", $fetch="");
								?>
                                <img src="assets/img/profile/thumbnail/<?php echo $profile_nav['foto'];?>" alt="">
                            </div>

                            <div class="profile-info">
                                <?php echo $profile_nav['nama_lengkap'];?>
                            </div>
                        </a>
                    </div>

                    <ul class="main-menu">
                        <li><a href="?module=home"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                        <li class="sub-menu <?php echo $t =($_GET['module'] === 'pages'  &&   ($_GET['id'] === '5' || $_GET['id'] === '4') ) || $_GET['module']==='kontak' || $_GET['module']==='campus' || $_GET['module']==='client' || $_GET['module']==='staff' || ($_GET['module']==='slideshow' && ($_GET['kat'] === '5' || $_GET['kat'] === '6' || $_GET['kat'] === '7')) ? 'active toggled' : '' ; ?>">
                            <a href="#"><i class="zmdi zmdi-file-text zmdi-hc-fw"></i> Company Profile</a>
                            <ul>
                                <li><a href="?module=pages&id=5">About Us</a></li>
                                <li><a href="?module=pages&id=4">Vision & Mission</a></li>
                                <!-- <li><a href="?module=campus">Campus</a></li> -->
                                <li><a href="?module=client">Penyelenggara</a></li>
                                <li><a href="?module=staff">Trainer</a></li>
                                <li><a href="?module=kontak">Contact Info</a></li>
                            </ul>
                        </li>
                        <!-- <li><a href="?module=school"><i class="zmdi zmdi-balance"></i> School</a></li> -->
                        <!-- <li><a href="?module=amenities"><i class="zmdi zmdi-widgets"></i> Fasilitas</a></li> -->
                        <!-- <li><a href="?module=staff"><i class="zmdi zmdi-accounts-list-alt"></i> Staff</a></li> -->
                        <!-- <li><a href="?module=download"><i class="zmdi zmdi-download"></i> Download</a></li> -->
                        <!-- <li class="sub-menu <?php echo $t =($_GET['module'] === 'produk_kategori')  ||  ($_GET['module'] === 'produk' ) || ($_GET['module'] === 'brand') ? 'active toggled' : '' ; ?>">
                            <a href="#"><i class="zmdi zmdi-store zmdi-hc-fw"></i> Produk</a>
                            <ul>
                                <li><a href="?module=produk_kategori">Kategori Produk</a></li>
                                <li><a href="?module=brand">Sub Kategori</a></li>
                                <li><a href="?module=produk">Produk</a></li>
                            </ul>
                        </li> -->
                        <li class="sub-menu <?php echo $t =($_GET['module'] === 'program' ) || ($_GET['module'] === 'program_kategori')  ? 'active toggled' : '' ; ?>">
                            <a href="#"><i class="zmdi zmdi-assignment zmdi-hc-fw"></i> Program</a>
                            <ul>
                                <li><a href="?module=program_kategori">Program Kategori</a></li>
                                <li><a href="?module=program">Program</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu <?php echo $t =($_GET['module'] === 'blog' ) || ($_GET['module'] === 'blog_kategori')  ? 'active toggled' : '' ; ?>">
                            <a href="#"><i class="zmdi zmdi-assignment zmdi-hc-fw"></i> Berita</a>
                            <ul>
                                <li><a href="?module=blog_kategori">Berita Kategori</a></li>
                                <li><a href="?module=blog">Berita</a></li>
                            </ul>
                        </li>
                        
                        <!-- <li class="sub-menu <?php echo $t =($_GET['module'] === 'client')  ||  ($_GET['module'] === 'client_kategori')? 'active toggled' : '' ; ?>">
                            <a href="#"><i class="zmdi zmdi-case zmdi-hc-fw"></i> Client</a>
                            <ul>
                                <li><a href="?module=client_kategori">Client Category</a></li>
                                <li><a href="?module=client">Client</a></li>
                            </ul>
                        </li> -->

                        <li class="sub-menu <?php echo $t =($_GET['module'] === 'gallery')  ||  ($_GET['module'] === 'gallery_kategori')? 'active toggled' : '' ; ?>">
                            <a href="#"><i class="zmdi zmdi-collection-image zmdi-hc-fw"></i> Gallery</a>
                            <ul>
                                <!-- <li><a href="?module=gallery_kategori">Gallery Category</a></li>
                                <li><a href="?module=gallery">Gallery</a></li> -->
                                <li><a href="?module=gallery_kategori">Gallery</a></li>
                            </ul>
                        </li>

						<!-- <li class="sub-menu <?php echo $t =($_GET['module'] === 'messages') ? 'active toggled' : '' ; ?>">
                            <a href="#"><i class="zmdi zmdi-inbox zmdi-hc-fw"></i> Inbox</a>
                            <ul>
                                <li><a href="?module=messages">Messages </a></li>
                                <li><a href="?module=enquiry">Enquiry </a></li>
                            </ul>
                        </li> -->
                        <li><a href="?module=agenda"><i class="zmdi zmdi-widgets"></i> Agenda</a></li>
                        <li><a href="?module=testimonies"><i class="zmdi zmdi-widgets"></i> Testimoni</a></li>

                        <li><a href="?module=messages"><i class="zmdi zmdi-comment-list"></i> Messages</a></li>
                       
                        <li class="sub-menu <?php echo $t =($_GET['module'] === 'map')  ||  ($_GET['module'] === 'sosmed') ||  ($_GET['module'] === 'slideshow' && $_GET['kat'] === '1')   ? 'active toggled' : '' ; ?>">
                            <a href="#"><i class="zmdi zmdi-settings zmdi-hc-fw"></i>Setting Web</a>
                            <ul>
                                <li><a href="?module=map">Maps</a></li>
                                <li><a href="?module=sosmed">Social Media</a></li>
                                <li><a href="?module=sosmedtags">Tags Social Media</a></li>
                                <!-- <li><a href="?module=slideshow&kat=1">Slideshow</a></li> -->
                            </ul>
                        </li>

                        <li class="sub-menu <?php echo $t =($_GET['module'] === 'title')  ||  ($_GET['module'] === 'keyword') ||  ($_GET['module'] === 'description') ? 'active toggled' : '' ; ?>">
                            <a href="#"><i class="zmdi zmdi-globe zmdi-hc-fw"></i>Setting Seo</a>
                            <ul>
                                <li><a href="?module=title">Title</a></li>
                                <li><a href="?module=keyword">Keyword</a></li>
                                <li><a href="?module=description">Description</a></li>
                            </ul>
                        </li>

                        <li><a href="?module=profile"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Profile</a></li>

                        <li><a href="logout.php"><i class="zmdi zmdi-power zmdi-hc-fw"></i> Logout</a></li>

                    </ul>
                </div>
            </aside>

            <section id="content">
                <div class="container">

                    <?php
                        require "modul.php";
                    ?>

                </div>
            </section>
        </section>

        <footer id="footer">
            Copyright &copy; 2019 <?php echo $config['web_name'];?> - Panel Admin. All Rights Reserved. Developed By <a href="http://jogjasite.com/" target="_blank">Jogjasite.com</a>. Page rendered in <?php echo time_load();?> seconds
        </footer>

        <script src="assets/vendors/bower_components/autosize/dist/autosize.min.js"></script>
        <script src="assets/vendors/fileinput/fileinput.min.js"></script>
        <script src="assets/vendors/input-mask/input-mask.min.js"></script>

        <script src="assets/js/functions.js"></script>
        <script src="assets/js/mdl.style.js"></script>
        <script>
          $(document).on('focusin', function(e) {
            if ($(e.target).closest(".mce-window").length) {
                e.stopImmediatePropagation();
            }
        });
        </script>
    </body>
</html>




<?php
}
?>
