<?php 
    $id = $_GET ['id'];
    $program = $database->select($fields = "*", $table = "program", $where_clause = "WHERE id_program= ".$id, $fetch ="");
    $cb = $program['view'] + 1;
    $d_view = array(
        'view' => "$cb" 
    );
    $database->update($table="program", $array=$d_view, $fields_key="id_program", $id_b = $id);

    $program_kategori = $database->select($fields="*", $table="program_kategori", $where_clause="WHERE id_program_kategori='$program[id_program_kategori]'", $fetch="");
 ?>
<!-- banner -->
    <div class="banner_w3lspvt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home" class="font-weight-bold">Home</a></li>
            <li class="breadcrumb-item"><a href="program" class="font-weight-bold">Program</a></li>
            <li class="breadcrumb-item" aria-current="page"><?php echo $program['judul'];?></li>
        </ol>
    </div>
<!-- //banner -->
<!-- about -->
    <div class="about-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="col-lg-12 welcome-right text-center mt-lg-0 mt-5">
                        <img src="joimg/program/<?php echo $program['image'];?>" alt="<?php echo $program['judul']; ?>" class="img-fluid" />
                    </div>
                    <div class="col-lg-12 about-right-faq pr-0">
                        <h6 class="mt-2">Posted by Kemah Pancasila on <?php echo $tgl->indo($program['date']); ?>, <?php echo $program['view']; ?> Views</h6>
                        <h3 class="mt-2 mb-3"><?php echo $program['judul']; ?></h3>
                            <?php
                              echo $program['deskripsi'];
                            ?>
                    </div>                
                </div>
                <div class="col-lg-3">
                    <div class="row">
                        <div class="">
                            <h6 class="title-tag-content tag-program"><strong>Related Post</strong></h6>
                            <br>
                            <?php 
                                $related = $database->select($fields="*", $table="program", $where_clause="WHERE id_program_kategori = '$program[id_program_kategori]' AND id_program != '$id' ORDER BY id_program DESC LIMIT 4", $fetch="all");
                                
                                foreach ($related as $key => $rel) {
                                    echo '
                                        <a href="detail-program-'.$rel['seo'].'-'.$rel['id_program'].'">
                                            <div class="media">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <img class="card-img-program " src="joimg/program/'.$rel['image'].'" alt="" style="width: 100%;height: auto;min-height:100px;object-fit: cover;">
                                                    </div>
                                                    <div class="col-sm-8 text-left mt-2">
                                                        <div class="judul">
                                                            <strong>'.$rel['judul'].'</strong>
                                                        </div>

                                                        <p class="description">
                                                            '.strip_tags(substr($rel['deskripsi'], 0, 150)).'
                                                        </p>
                                                        <p class="mb-0 text-right catatan-time"> '.$tgl->english($rel['date']).'
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