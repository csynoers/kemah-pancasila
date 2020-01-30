<?php 
    // $id = $_GET ['id'];
    // $program = $database->select($fields = "*", $table = "program", $where_clause = "WHERE id_program= ".$id, $fetch ="");
    // $cb = $program['view'] + 1;
    // $d_view = array(
    //     'view' => "$cb" 
    // );
    // $database->update($table="program", $array=$d_view, $fields_key="id_program", $id_b = $id);

    $row = $database->select($fields="*", $table="testimonies", $where_clause="WHERE id_testimonies='{$_GET['id']}'", $fetch="");
 ?>
<!-- banner -->
    <div class="banner_w3lspvt-2XXX">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home" class="font-weight-bold">Home</a></li>
            <li class="breadcrumb-item"><a href="program" class="font-weight-bold">Testimoni</a></li>
            <li class="breadcrumb-item" aria-current="page"><?= $row['nama'];?></li>
        </ol>
    </div>
<!-- //banner -->
<!-- about -->
    <div class="about-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="col-lg-12 welcome-right text-center mt-lg-0 mt-5">
                        <img src="joimg/testimonies/<?=$row['image']; ?>" alt="<?= $row['nama']; ?>" class="img-fluid" />
                    </div>
                    <div class="col-lg-12 about-right-faq pr-0">
                        <h6 class="mt-2">Posted by Kemah Pancasila on <?php echo $tgl->indo($row['dateTime']); ?>, </h6>
                        <h3 class="mt-2 mb-3"><?= $row['nama']; ?></h3>
                            <?= (empty($row['say'])? "Deksripsi tentang testimoni {$row['nama']} masih dalam proses pengisian" : $row['say'] ) ?>
                    </div>                
                </div>
                <div class="col-lg-3">
                    <div class="row">
                        <div class="">
                            <h6 class="title-tag-content tag-program"><strong>Related</strong></h6>
                            <br>
                            <?php 
                                $related = $database->select($fields="*", $table="testimonies", $where_clause="WHERE id_testimonies != '{$_GET['id']}' ORDER BY id_testimonies DESC LIMIT 4", $fetch="all");
                                
                                foreach ($related as $key => $rel) {
                                    echo '
                                        <a href="detail-testimoni-'.$rel['id_testimonies'].'-'.$rel['seo'].'">
                                            <div class="media">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <img class="card-img-program " src="joimg/testimonies/'.$rel['image'].'" alt="" style="width: 100%;height: auto;min-height:100px;object-fit: cover;">
                                                    </div>
                                                    <div class="col-sm-8 text-left mt-2">
                                                        <div class="judul">
                                                            <strong>'.$rel['nama'].'</strong>
                                                        </div>

                                                        <p class="description">
                                                            '.(empty($rel['say'])? "Deksripsi tentang testimoni {$rel['nama']} masih dalam proses pengisian" : strip_tags(substr($rel['say'], 0, 150)) ).'
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