<?php 
    $id = $_GET ['id'];
    $staff_gallery = $database->select($fields = "*", $table = "staff_gallery", $where_clause = "WHERE id_staff_gallery= ".$id, $fetch ="");
    //$staff_gallery_kategori = $database->select($fields="*", $table="staff_gallery_kategori", $where_clause="WHERE id_kategori='$staff_gallery[id_kategori]'", $fetch="");
 ?>
<!-- banner -->
    <div class="banner_w3lspvt-2XXX">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home" class="font-weight-bold">Home</a></li>
            <li class="breadcrumb-item"><a href="trainer" class="font-weight-bold">Trainer</a></li>
            <li class="breadcrumb-item" aria-current="page"><?php echo $staff_gallery['nama'];?></li>
        </ol>
    </div>
<!-- //banner -->
<!-- about -->
    <div class="about-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="col-lg-12 welcome-right text-center mt-lg-0 mt-5">
                        <img src="joimg/staff_gallery/<?php echo $staff_gallery['image'];?>" alt="<?php echo $staff_gallery['nama']; ?>" class="img-fluid" />
                    </div>
                    <div class="col-lg-12 about-right-faq pr-0">
                        <h3 class="mt-2 mb-3"><?php echo $staff_gallery['nama']; ?></h3>
                            <?php
                              echo $staff_gallery['deskripsi'];
                            ?>
                    </div>                
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="">
                            <h6 class="title-tag-content tag-berita"><strong>Other Trainer</strong></h6>
                            <br>
                            <?php 
                                $related = $database->select($fields="*", $table="staff_gallery", $where_clause="WHERE id_kategori = '$staff_gallery[id_kategori]' AND id_staff_gallery != '$id' ORDER BY id_staff_gallery DESC LIMIT 4", $fetch="all");
                                foreach ($related as $key => $rel) {
                                    echo '
                                        <a href="detail-trainer-'.$rel['seo'].'-'.$rel['id_staff_gallery'].'">
                                            <div class="media">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <img class="card-img-staff_gallery " src="joimg/staff_gallery/'.$rel['image'].'" alt="" style="width: 100%;height: auto;min-height:100px;object-fit: cover;">
                                                    </div>
                                                    <div class="col-sm-8 text-left mt-2">
                                                        <div class="nama">
                                                            <strong>'.$rel['nama'].'</strong>
                                                        </div>

                                                        <p class="description">
                                                            '.substr(strip_tags($rel['deskripsi']), 0, 150).'
                                                        </p>
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