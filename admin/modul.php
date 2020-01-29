<?php
// Bagian Home
if ($_GET['module']=='home'){
	if ($_SESSION['level']=='admin'){

      error_reporting(0);
        // Statistik user
        $ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
        $tanggal = date("Y-m-d");// Mendapatkan tanggal sekarang
        $waktu   = time(); //

        // Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini
        //$statistik_count = $database->count_rows($table="statistik", $where_clause="WHERE ip='$ip' AND tanggal='$tanggal'");
        // Kalau belum ada, simpan data user tersebut ke database
        //if(mysql_num_rows($s) == 0){
       // }
        //else{
        //}

        $pengunjung       = $database->count_rows($table="statistik", $where_clause="WHERE tanggal='$tanggal'");
        $totalpengunjung  = $database->select($fields="COUNT(hits)", $table="statistik", $where_clause="", $fetch="");
        $hits             = $database->select($fields="SUM(hits)", $table="statistik", $where_clause="WHERE tanggal='$tanggal'", $fetch="");
        $totalhits        = $database->select($fields="SUM(hits)", $table="statistik", $where_clause="", $fetch="");

        //$tothitsgbr       = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0);
        //$bataswaktu       = time() - 300;
       // $pengunjungonline = $database->count_rows($fields="statistik", $table="statistik", $where_clause="WHERE online > '$bataswaktu'");
      ?>

          <div class="card">
              <div class="card-header">
                  <h2>Statistic Visitors</h2>
              </div>

              <div class="alert alert-success " role="alert">
                  Selamat Datang, di halaman panel Admin <?php echo $config['web_name'];?>.
              </div>

              <div class="card-body card-padding">
                  <div class="mini-charts">
                      <div class="row">
                          <div class="col-sm-6 col-md-3">
                              <div class="mini-charts-item bgm-cyan">
                                  <div class="clearfix">
                                      <div class="chart stats-bar"></div>
                                      <div class="count">
                                          <h4 class="putih">Today Views</h4>
                                          <h2><?php if(empty($hits[0])){echo "0";}else{echo $hits[0];}?></h2> 
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-6 col-md-3">
                              <div class="mini-charts-item bgm-lightgreen">
                                  <div class="clearfix">
                                      <div class="chart stats-bar-2"></div>
                                      <div class="count">
                                          <h4 class="putih">Today Visits</h4>
                                          <h2><?php if(empty($pengunjung)){echo "0";}else{echo $pengunjung;}?></h2>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-6 col-md-3">
                              <div class="mini-charts-item bgm-orange">
                                  <div class="clearfix">
                                      <div class="chart stats-line"></div>
                                      <div class="count">
                                          <h4 class="putih">Total Views</h4>
                                          <h2><?php echo $totalhits[0];?></h2>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-6 col-md-3">
                              <div class="mini-charts-item bgm-bluegray">
                                  <div class="clearfix">
                                      <div class="chart stats-line-2"></div>
                                      <div class="count">
                                          <h4 class="putih">Total Visitor</h4>
                                          <h2><?php echo $totalpengunjung[0];?></h2>
                                      </div>
                                  </div>
                              </div>
                          </div>

                      </div>
                  </div>

              </div>
          </div>
<?php
  }
}
//###################################### Begin New Module #################################################

elseif ($_GET['module']=='produk_kategori') {
  if ($_SESSION['level']=='admin') {
    include "modul/mod_produk_kategori/produk_kategori_v.php";
  }
}

elseif ($_GET['module']=='brand') {
  if ($_SESSION['level']=='admin') {
    include "modul/mod_brand/brand_v.php";
  }
}

elseif ($_GET['module']=='produk') {
  if ($_SESSION['level']=='admin') {
    include "modul/mod_produk/produk_v.php";
  }
}

// Bagian pages
elseif ($_GET['module']=='pages') {
  if ($_SESSION['level']=='admin') {
    include "modul/mod_pages/pages_v.php";
  }
}

// Bagian blog
elseif ($_GET['module']=='blog') {
  if ($_SESSION['level']=='admin') {
    include "modul/mod_blog/blog_v.php";
  }
}

// Bagian blog_kategori
elseif ($_GET['module']=='blog_kategori') {
  if ($_SESSION['level']=='admin') {
    include "modul/mod_blog_kategori/blog_kategori_v.php";
  }
}
// Bagian blog_media_partner
elseif ($_GET['module']=='blog_media_partner') {
  if ($_SESSION['level']=='admin') {
    include "modul/mod_blog_media_partner/index.php";
  }
}

// Bagian program
elseif ($_GET['module']=='program') {
  if ($_SESSION['level']=='admin') {
    include "modul/mod_program/program_v.php";
  }
}

// Bagian program_kategori
elseif ($_GET['module']=='program_kategori') {
  if ($_SESSION['level']=='admin') {
    include "modul/mod_program_kategori/program_kategori_v.php";
  }
}

// Bagian Client Kategori
elseif ($_GET['module']=='client_kategori') {
  if ($_SESSION['level']=='admin') {
    include "modul/mod_client_kategori/client_kategori_v.php";
  }
}

// Bagian Client
elseif ($_GET['module']=='client') {
  if ($_SESSION['level']=='admin') {
    include "modul/mod_client/client_v.php";
  }
}

// Bagian Client Kategori
elseif ($_GET['module']=='gallery_kategori') {
  if ($_SESSION['level']=='admin') {
    include "modul/mod_gallery_kategori/gallery_kategori_v.php";
  }
}

// Bagian Client
elseif ($_GET['module']=='gallery') {
  if ($_SESSION['level']=='admin') {
    include "modul/mod_gallery/gallery_v.php";
  }
}

// Controller modul galeri video
elseif ($_GET['module']=='gallery_video') {
  if ($_SESSION['level']=='admin') {
    include "modul/mod_gallery_video/index.php";
  }
}

// Bagian amenities
elseif ($_GET['module']=='amenities') {
  if ($_SESSION['level']=='admin') {
    include "modul/mod_amenities/amenities_v.php";
  }
}

// Bagian campus
elseif ($_GET['module']=='campus') {
  if ($_SESSION['level']=='admin') {
    include "modul/mod_campus/campus_v.php";
  }
}

//bagian kontak
elseif ($_GET['module']=='kontak'){
  if ($_SESSION['level']=='admin'){
    include "modul/mod_kontak/kontak.php";
  }
}

//============================ Begin Menu Pages Web ===============================\\


//============================ Begin Menu Support Web ===============================\\
// Bagian messages
elseif ($_GET['module']=='messages'){
  if ($_SESSION['level']=='admin'){
    include "modul/mod_messages/messages_v.php";
  }
}

// Bagian enquiry
elseif ($_GET['module']=='enquiry'){
  if ($_SESSION['level']=='admin'){
    include "modul/mod_enquiry/enquiry_v.php";
  }
}

//============================ Begin Menu Setting Web ===============================\\
// Bagian Sosmed
elseif ($_GET['module']=='sosmed'){
  if ($_SESSION['level']=='admin'){
    include "modul/mod_sosmed/sosmed_v.php";
  }
}

// Bagian TAGS Sosmed
elseif ($_GET['module']=='sosmedtags'){
  if ($_SESSION['level']=='admin'){
    include "modul/mod_tags_social_media/index.php";
  }
}

// Bagian SlideShow
elseif ($_GET['module']=='slideshow'){
  if ($_SESSION['level']=='admin'){
    include "modul/mod_slideshow/slideshow_v.php";
  }
}

// Bagian map
elseif ($_GET['module']=='map'){
  if ($_SESSION['level']=='admin'){
    include "modul/mod_map/map_v.php";
  }
}

//============================ Begin Menu Setting Seo ===============================\\
// Bagian Title
elseif ($_GET['module']=='title'){
  if ($_SESSION['level']=='admin'){
    include "modul/mod_title/title_v.php";
  }
}

// Bagian Keyword
elseif ($_GET['module']=='keyword'){
  if ($_SESSION['level']=='admin'){
    include "modul/mod_keyword/keyword_v.php";
  }
}

// Bagian Description
elseif ($_GET['module']=='description'){
  if ($_SESSION['level']=='admin'){
    include "modul/mod_description/description_v.php";
  }
}
//============================== End Menu Setting Seo ===============================\\


//=========================== Begin Menu Profile ====================================\\
// Bagian Profile - Setting Profile Admin
elseif ($_GET['module']=='profile'){
  if ($_SESSION['level']=='admin'){
    include "modul/mod_profile/profile_v.php";
  }
}

// Bagian Profile - Setting Login Admin
elseif ($_GET['module']=='login'){
  if ($_SESSION['level']=='admin'){
    include "modul/mod_profile/login_v.php";
  }
}

// Bagian School
elseif ($_GET['module']=='school'){
  if ($_SESSION['level']=='admin'){
    include "modul/mod_school/school_v.php";
  }
}

// Bagian School
elseif ($_GET['module']=='school_sub'){
  if ($_SESSION['level']=='admin'){
    include "modul/mod_school_sub/school_sub_v.php";
  }
}

// Bagian testimonies
elseif ($_GET['module']=='testimonies'){
  if ($_SESSION['level']=='admin'){
    include "modul/mod_testimonies/testimonies_v.php";
  }
}

// Bagian download
elseif ($_GET['module']=='download'){
  if ($_SESSION['level']=='admin'){
    include "modul/mod_download/download_v.php";
  }
}

// Bagian staff
elseif ($_GET['module']=='staff'){
  if ($_SESSION['level']=='admin'){
    include "modul/mod_staff/staff_v.php";
  }
}
// Bagian staff_gallery
elseif ($_GET['module']=='staff_gallery'){
  if ($_SESSION['level']=='admin'){
    include "modul/mod_staff_gallery/staff_gallery_v.php";
  }
}

// Bagian agenda
elseif ($_GET['module']=='agenda'){
  if ($_SESSION['level']=='admin'){
    include "modul/mod_agenda/agenda_v.php";
  }
}




//============================== End Menu Profile ====================================\\

// Apabila modul tidak ditemukan
else{
  echo "<p><b><center>MODUL BELUM ADA ATAU BELUM LENGKAP</center></b></p>";
}
?>
