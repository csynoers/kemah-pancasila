<!-- banner -->
    <div class="banner_w3lspvt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home" class="font-weight-bold">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Program</li>
        </ol>
    </div>
<!-- //banner -->
<!-- program -->
    <section class="banner-bottom-w3layouts bg-li" id="services">
        <div class="container py-lg-3">
            <div class="row pt-lg-4">
                <?php 
                    require 'josys/class/Pagination_htaccess.php';
                    $pagination = new Paging_get_all();
                    $batas      = 9;
                    $posisi     = $pagination->cariPosisi($batas);
                    $cek = $database->count_rows("program","ORDER BY id_program DESC LIMIT $posisi, $batas");
                    if ($cek>0) {                        
                        $program = $database->select($fields="*", $table="program", $where_clause="ORDER BY id_program DESC LIMIT $posisi, $batas", $fetch="all");                        
                        foreach ($program as $key => $b) {
                            echo '                                
                                <div class="col-lg-4 about-in text-center">
                                    <div class="card pd-1">
                                        <div class="card-body">
                                            <div class="">
                                                <img class="card-img-top " src="joimg/program/'.$b['image'].'" alt="'.$b['judul'].'">
                                                <p class="m-1">
                                                    <b class="pull-left"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> '.$tgl->indo($b['date']).'
                                                    </b>
                                                    <b class=""><i class="fa fa-eye mr-1" aria-hidden="true"></i>'.$b['view'].' View</b>
                                                </p>                                            
                                            </div>
                                            <h5 class="card-title mt-4 mb-3">'.$b['judul'].'</h5>
                                            <p class="card-text">'.strip_tags(substr($b['deskripsi'], 0, 150)).'..</p>
                                            
                                            <a href="detail-program-'.$b['seo'].'-'.$b['id_program'].'" class="button-w3ls btn mt-sm-5 mt-4"><i class="fa fa-book"></i> Read more</a>
                                        </div>
                                    </div>
                                </div>';
                        }
                    }
                ?>                
            </div>
            <?php 
                $jmldata    = $database->count_rows($table="program", $where_clause="ORDER BY id_program DESC");                
                if ($jmldata > $batas) {
                    echo "
                    <div class='cleafix'></div>
                    <div class='text-center'>
                            <ul class='pagination page-item'>";
                                $jmlhalaman  = $pagination->jumlahHalaman($jmldata, $batas);
                                $linkHalaman = $pagination->navHalaman($_GET['halaman'], $jmlhalaman);
                                echo str_replace('<li', '<li class="page-link"', $linkHalaman);
                    echo "</ul>
                        </div>";
                }
             ?>
        </div>
    </section>
<!-- //program -->