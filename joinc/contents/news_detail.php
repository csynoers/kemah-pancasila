<?php 
    $id = $_GET ['id'];
    $blog = $database->select($fields = "*", $table = "blog", $where_clause = "LEFT JOIN media_partners ON media_partners.media_partner_id=blog.media_partner_id WHERE id_blog= ".$id, $fetch ="");
    $cb = $blog['view'] + 1;
    $d_view = array(
        'view' => "$cb" 
    );
    $database->update($table="blog", $array=$d_view, $fields_key="id_blog", $id_b = $id);
    $blog_kategori = $database->select($fields="*", $table="blog_kategori", $where_clause="WHERE id_blog_kategori='$blog[id_blog_kategori]'", $fetch="");
 ?>
<!-- banner -->
    <div class="banner_w3lspvt-2XXX">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home" class="font-weight-bold">Home</a></li>
            <li class="breadcrumb-item"><a href="berita" class="font-weight-bold">Berita</a></li>
            <li class="breadcrumb-item" aria-current="page"><?php echo $blog['judul'];?></li>
        </ol>
    </div>
<!-- //banner -->
<!-- about -->
    <div class="about-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="col-lg-12 welcome-right text-center mt-lg-0 mt-5">
                        <img src="joimg/blog/<?php echo $blog['image'];?>" alt="<?php echo $blog['judul']; ?>" class="img-fluid" />
                    </div>
                    <div class="col-lg-12 about-right-faq pr-0">
                        <h6 class="mt-2">Posted by <?= "<a href='media-berita-{$blog['media_partner_id']}'> {$blog['media_partner_title']}</a>" ?> Kemah Pancasila on <?php echo $tgl->english($blog['date']); ?>, <?php echo $blog['view']; ?> Views</h6>
                        <h3 class="mt-2 mb-3"><?php echo $blog['judul']; ?></h3>
                            <?php
                              echo $blog['deskripsi'];
                            ?>
                    </div>                
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="">
                            <h6 class="title-tag-content tag-berita"><strong>Related Post</strong></h6>
                            <br>
                            <?php 
                                $related = $database->select($fields="*", $table="blog", $where_clause="WHERE id_blog_kategori = '$blog[id_blog_kategori]' AND id_blog != '$id' ORDER BY id_blog DESC LIMIT 4", $fetch="all");
                                foreach ($related as $key => $rel) {
                                    echo '
                                        <a href="detail-berita-'.$rel['seo'].'-'.$rel['id_blog'].'">
                                            <div class="media">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <img class="card-img-blog " src="joimg/blog/'.$rel['image'].'" alt="" style="width: 100%;height: auto;min-height:100px;object-fit: cover;">
                                                    </div>
                                                    <div class="col-sm-8 text-left mt-2">
                                                        <div class="judul">
                                                            <strong>'.$rel['judul'].'</strong>
                                                        </div>

                                                        <p class="description">
                                                            '.substr(strip_tags($rel['deskripsi']), 0, 150).'
                                                        </p>
                                                        <p class="mb-0 text-right catatan-time"> '.$tgl->indo($rel['date']).'
                                                            , <i>'.$rel['view'].'x Views</i></p>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <hr style="border-bottom: solid #80808029 1px;width: 100%;">
                                                    </div>

                                                </div>
                                            </div>
                                        </a>
                                        ';
                                }
                            ?>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
<!-- //about -->

<section class="partners py-5" id="penyelenggara">
    <div class="container py-xl-5 py-lg-3">
        <h3 class="tittle text-center font-weight-bold">Media Partners</h3>
        <p class="sub-tittle text-center mt-3 mb-sm-5 mb-4">Partners Kemah Pancasila.</p>
        <div class="row grid-part text-center pt-4" >
            <div class="owl-carousel" id="slider2">					
            <?php 
                foreach ($database->select($fields="*", $table="media_partners", $where_clause="ORDER BY media_partner_id DESC", $fetch="all") as $key => $cl) {
                    echo '
                        <div class="parts-w3ls p-5">															
                            <a href="media-berita-'.$cl['media_partner_id'].'"><img src="joimg/blog/thumbnail/'.$cl['media_partner_image'].'" alt="'.$cl['media_partner_title'].'"></a>
                            <h4>'.$cl['media_partner_title'].'</h4>
                        </div>
                    ';
                }
            ?>
            </div>
            
        </div>
    </div>
</section>