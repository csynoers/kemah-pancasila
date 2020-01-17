<?php 
    $id = $_GET ['id'];
    $blog_kategori = $database->select($fields="*", $table="blog_kategori", $where_clause="WHERE id_blog_kategori='$id'", $fetch="");
 ?>
<section id="content">
    <div class="container-fluid mt-5 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>News</h3>
                </div>
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-1 ">
                            <li class="breadcrumb-item link"><a href="home">Home</a></li>
                            <li class="breadcrumb-item link"><a href="news">News</a></li>
                            <li class="breadcrumb-item active"><?php echo $blog_kategori['nama']; ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row box-card  " id="berita_load">
                <?php 
                    $blog = $database->select($fields="*", $table="blog", $where_clause="WHERE id_blog_kategori='$id' ORDER BY id_blog DESC ", $fetch="all");
                    
                    foreach ($blog as $key => $b) {
                        echo '
                            <div class="card p-2 mb-4 shadow-cs-blue">
                                <a href="detail-news-'.$b['seo'].'-'.$b['id_blog'].'"><img class="card-img-top " src="joimg/blog/'.$b['image'].'" alt="'.$b['judul'].'"></a>
                                <a href="detail-news-'.$b['seo'].'-'.$b['id_blog'].'">
                                    <div class="card-body p-1 pt-3">
                                        <h6 class="card-title"><b>'.$b['judul'].'</b></h6>
                                        <div class="row mt-1 mb-3 info-card text-primary">
                                            <div class="col-8"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> '.$tgl->english($b['date']).'
                                            </div>
                                            <div class="col-4"><i class="fa fa-eye mr-1" aria-hidden="true"></i> '.$b['view'].' View
                                            </div>
                                        </div>
                                        <p class="card-text">'.strip_tags(substr($b['deskripsi'], 0, 150)).'</p>

                                    </div>
                                </a>
                            </div>
                            ';
                    }
                ?>
            </div>
        </div>
    </div>
</section>