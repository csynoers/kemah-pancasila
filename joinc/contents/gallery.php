<!-- banner -->
    <div class="banner_w3lspvt-2XXX">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home" class="font-weight-bold">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Galeri</li>
        </ol>
    </div>
<!-- //banner -->
<section class="banner-bottom-w3layouts bg-li" id="services">
    <div class="container py-lg-3">
        <div class="row pt-lg-4">
            <div class="col-lg-12">
                <ul class="pagination page-item" id="filter-kategori">
                <?php 
                    $grup = $database->select($fields = "*", $table = "gallery_kategori", $where_clause = "", $fetch = "all");
                    $count_gallery = $database->count_rows($tables="gallery", $where_clause="");
                        echo'<li class="page-link"><a href="#" data-filter="*" class="active">All <span>'.$count_gallery.'</span> </a></li>';
                    foreach ($grup as $key => $v_grup) {
                        $count_g = $database->count_rows($tables="gallery", $where_clause="WHERE id_kategori = ".$v_grup['id_kategori']);
                        echo '
                            <li class="page-link"><a href="#" data-filter=".kategori'.$v_grup['id_kategori'].'" class="">'.$v_grup['judul'].' <span>'.$count_g.'</span></a></li>';
                    }
                 ?>                                
                </ul>
                <div class="">
                    <div class="row grid">
                    <?php 
                        if ($count_gallery < 1) {
                            echo '
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <b>Ups Sorry!</b> <br>
                                    <b>No Image been found here</b>.
                                </div>
                            ';
                        } 
                        else{ 
                            $gallery = $database->select($fields="*", $tables="gallery", $where_clause="ORDER BY id_gallery DESC", $fetch="all");
                            
                            foreach ($gallery as $key => $valueg) {
                                echo '
                                <div class="col-lg-3 about-in text-center grid-item kategori'.$valueg['id_kategori'].'">
                                    <a href="joimg/gallery/'.$valueg['image'].'" data-fancybox="gallery" data-caption="'.$valueg['nama'].'">
                                        <div class="card pd-half">
                                            <div class="card-body pd-0">
                                                    <img class="card-img-top " src="joimg/gallery/'.$valueg['image'].'" alt="'.$valueg['nama'].'">
                                                <h5 class="card-title mt-4 mb-3">'.$valueg['nama'].'</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                ';
                            }                       
                        }
                     ?>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</section>   