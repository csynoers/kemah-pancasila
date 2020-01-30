<!-- banner -->
    <div class="banner_w3lspvt-2XXX">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home" class="font-weight-bold">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Testimoni</li>
        </ol>
    </div>
<!-- //banner -->
<!-- trainer -->
    <section class="team bg-li" id="team">
        <div class="container py-lg-3">
            <div class="row ab-info second">
                <?php 
                    require 'josys/class/Pagination_htaccess.php';
                    $pagination = new Paging_get_all();
                    $batas      = 15;
                    $posisi     = $pagination->cariPosisi($batas);
                    $cek = $database->count_rows("testimonies","ORDER BY id_testimonies DESC");
                    if ($cek>0) { 
                        $testimonies = $database->select($fields="*", $table="testimonies", $where_clause="ORDER BY id_testimonies DESC LIMIT $posisi, $batas", $fetch="all");
                        foreach ($testimonies as $key => $c) {
                            $c['say'] = ( empty($c['say']) ? "Testimonio tentang {$c['nama']} masih dalam proses pengisian" : strip_tags(substr($c['say'], 0, 150)) );
                            $c['url'] = "detail-testimoni-{$c['id_testimonies']}-{$c['seo']}";
                            echo '
                                <div class="col-lg-4 col-sm-6 ab-content text-center mt-4">
                                    <div class="ab-content-inner">
                                        <img src="joimg/testimonies/'.$c['image'].'" alt="'.$c['nama'].'" class="img-fluid">
                                        <div class="ab-info-con">
                                            <h4 class="text-team-w3">'.$c['nama'].'</h4>
                                            <p><i>"'.$c['say'].'"</i></p>
                                            <a href="'.$c["url"].'" class="button-w3ls btn mt-sm-5 mt-4"><i class="fa fa-book"></i> Read more</a>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                    }
                 ?>
            </div>
            <?php 
                $jmldata    = $database->count_rows($table="testimonies", $where_clause="ORDER BY id_testimonies DESC");
                if ($jmldata > $batas) {
                    echo "
                    <div class='cleafix mt-4'></div>
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
<!-- //trainer -->