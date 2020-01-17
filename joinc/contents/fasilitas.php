<!-- banner -->
    <div class="banner_w3lspvt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home" class="font-weight-bold">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Fasilitas</li>
        </ol>
    </div>
<!-- //banner -->
<!-- fasilitas -->
    <section class="banner-bottom-w3layouts bg-li" id="services">
        <div class="what bg-li" id="whyChooseUs">
            <div class="container py-xl-5 py-lg-3">              
                <div class="row about-bottom-w3l text-center">
                    <?php 
                        $amenities = $database->select($fields="*", $table="amenities", $where_clause="ORDER BY id_amenities DESC", $fetch="all");
                        foreach ($amenities as $key => $am) {
                            echo '
                            <div class="col-lg-3">
                                <div class="about-grid-main" style="padding:1em!important;">
                                    <img src="joimg/amenities/'.$am['image'].'" alt="'.$am['nama'].'" class="img-fluid">
                                    <h4 class="my-4">'.$am['nama'].'</h4>
                                    <p>'.strip_tags($am['description']).'</p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            ';
                        }
                    ?>                    
                </div>
            </div>
        </div>
    </section>
<!-- //fasilitas -->