<!-- banner -->
    <div class="banner_w3lspvt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home" class="font-weight-bold">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Trainer</li>
        </ol>
    </div>
<!-- //banner -->

<!-- trainer -->
    <section class="team bg-li" id="trainer">
        <div class="container py-lg-3">
            <div class="row ab-info second pt-lg-4">
                <?php 
                    $staff_gallery = $database->select($fields="staff_gallery.*, name", $table="staff_gallery", $where_clause="INNER JOIN staff ON (staff_gallery.id_kategori = staff.id_staff) WHERE staff_gallery.id_kategori = '1' ORDER BY name ASC", $fetch="all");
                    foreach ($staff_gallery as $key => $c) {
                        echo '
                            <div class="col-lg-4 col-sm-6 ab-content text-center mt-4">
                                <div class="ab-content-inner">
                                    <img src="joimg/staff_gallery/'.$c['image'].'" alt="'.$c['nama'].'" class="img-fluid">
                                    <div class="ab-info-con">
                                        <h4 class="text-team-w3">'.$c['nama'].'</h4>
                                        <p>'.substr(strip_tags($c['deskripsi']),0,150).'</p><br>
                                        <p><b>'.$c['name'].'</b></p>
                                    </div>
                                        <a href="detail-trainer-'.$c['seo'].'-'.$c['id_staff_gallery'].'" class="button-w3ls btn"><i class="fa fa-book"></i> Read more</a>
                                </div>
                            </div>
                        ';
                    }
                 ?>
            </div>
        </div>
    </section>
<!-- //trainer -->