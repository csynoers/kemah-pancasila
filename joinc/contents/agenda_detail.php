<?php 
    $id = $_GET ['id'];
    $agenda = $database->select($fields = "*", $table = "agenda", $where_clause = "WHERE id_agenda= ".$id, $fetch ="");
    $cb = $agenda['view'] + 1;
    $d_view = array(
        'view' => "$cb" 
    );
    $database->update($table="agenda", $array=$d_view, $fields_key="id_agenda", $id_b = $id);
    //$agenda_kategori = $database->select($fields="*", $table="agenda_kategori", $where_clause="WHERE id_agenda_kategori='$agenda[id_agenda_kategori]'", $fetch="");
 ?>
<!-- banner -->
    <div class="banner_w3lspvt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home" class="font-weight-bold">Home</a></li>
            <li class="breadcrumb-item"><a href="agenda" class="font-weight-bold">Agenda</a></li>
            <li class="breadcrumb-item" aria-current="page"><?php echo $agenda['judul'];?></li>
        </ol>
    </div>
<!-- //banner -->
<!-- about -->
    <div class="about-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="col-lg-12 welcome-right text-center mt-lg-0 mt-5">
                        <img src="joimg/agenda/<?php echo $agenda['image'];?>" alt="<?php echo $agenda['judul']; ?>" class="img-fluid" />
                    </div>
                    <div class="col-lg-12 about-right-faq pr-0">
                        <h6 class="mt-2"><?php echo $tgl->indo($agenda['date']); ?>, <?php echo $agenda['view']; ?> Views</h6>
                        <h3 class="mt-2 mb-3"><?php echo $agenda['judul']; ?></h3>
                            <?php
                              echo $agenda['deskripsi'];
                            ?>
                    </div>                
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="">
                            <h6 class="title-tag-content tag-berita"><strong>Related</strong></h6>
                            <br>
                            <?php 
                                $related = $database->select($fields="*", $table="agenda", $where_clause="WHERE id_agenda_kategori = '$agenda[id_agenda_kategori]' AND id_agenda != '$id' ORDER BY id_agenda DESC LIMIT 4", $fetch="all");
                                foreach ($related as $key => $rel) {
                                    $day = strtotime($rel['date']);
                                    $daynow = strtotime(date('Y-m-d'));
                                    $dif = $day-$daynow;
                                    $dleft = floor($dif/(60*60*24));
                                    if ($dleft < 0) {
                                        $strleft = "<span style='color:red'>(".str_replace('-', '', $dleft)." Hari yang Lalu)</span>";
                                    }
                                    elseif($dleft == 0){
                                        $strleft = "<span style='color:blue'>(Hari Ini)</span>";
                                    }
                                    else{
                                        $strleft = "<span style='color:green'>(".$dleft." Hari Lagi)</span>";
                                    }
                                    echo '
                                        <a href="detail-agenda-'.$rel['seo'].'-'.$rel['id_agenda'].'">
                                            <div class="media">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <img class="card-img-agenda " src="joimg/agenda/'.$rel['image'].'" alt="" style="width: 100%;height: auto;min-height:100px;object-fit: cover;">
                                                    </div>
                                                    <div class="col-sm-8 text-left mt-2">
                                                        <div class="judul">
                                                            <strong>'.$rel['judul'].'</strong>
                                                        </div>

                                                        <p class="description">
                                                            '.substr(strip_tags($rel['deskripsi']), 0, 150).'
                                                        </p>
                                                        <p class="mb-0 text-right catatan-time"> <b>'.$strleft.'</b>
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