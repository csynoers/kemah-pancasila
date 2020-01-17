    <!-- footer -->
    <footer class="bg-li">
        <div class="container py-lg-3">
            <!-- <div class="subscribe mx-auto">
                <div class="icon-effect-w3">
                    <a id="wa_message" target="_blank"><span class="fa fa-whatsapp"></span></a>
                </div>
                <h2 class="tittle text-center font-weight-bold">Chat Via Whatsapp!</h2>
                <p class="sub-tittle text-center mt-3 mb-sm-5 mb-4">Hubungi kami melalui whatsapp untuk fast respon.</p>
            </div> -->
        </div>
    </footer>
    <!-- //footer -->

    <!-- stats -->
    <section class="bottom-count" id="stats">
        <div class="container py-lg-3">
            <div class="row">
                <div class="col-lg-4 left-img-w3ls">
                    <img src="images/about.png" alt="Statistik" class="img-fluid" />
                </div>
                <div class="col-lg-8 right-img-w3ls pl-lg-4 mt-lg-2 mt-4">
                    <div class="bott-w3ls mr-xl-5">
                        <h3 class="title-w3 text-bl mb-3 font-weight-bold">Statistik</h3>
                        <p>Statistik pengunjung website Kemah Pancasila sepanjang waktu</p>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-3 count-w3ls">
                            <h4><?php if(empty($hits[0])){echo "0";}else{echo $hits[0];}?></h4>
                            <p>Hits Hari Ini</p>
                        </div>
                        <div class="col-sm-3 count-w3ls mt-sm-0 mt-3">
                            <h4><?php if(empty($totalhits[0])){echo "0";}else{echo $totalhits[0].'+';}?></h4>
                            <p>Total Hits Saat Ini</p>
                        </div>
                        <div class="col-sm-3 count-w3ls">
                            <h4><?php if(empty($pengunjung)){echo "0";}else{echo $pengunjung;}?></h4>
                            <p>Pengunjung Hari Ini</p>
                        </div>
                        <div class="col-sm-3 count-w3ls mt-sm-0 mt-3">
                            <h4><?php if(empty($totalpengunjung[0])){echo "0";}else{echo $totalpengunjung[0].'+';}?></h4>
                            <p>Total Pengunjung</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //stats -->

    <!-- copyright bottom -->
    <div class="copy-bottom bg-li py-4 border-top">
        <div class="container-fluid">
            <div class="d-md-flex px-md-3 position-relative text-center">
                <!-- footer social icons -->
                <div class="social-icons-footer mb-md-0 mb-3">
                    <ul class="list-unstyled">
                        <?php 
                            $sosmed = $database->select($fields="*", $table="sosmed", $where_clause="ORDER BY id_sosmed DESC", $fetch="all");
                            foreach ($sosmed as $key => $s) {
                                echo 
                                    '<li>
                                        <a href="'.$s['link'].'" target="_blank">
                                            <span></span><img width="25px" src="joimg/sosmed/'.$s['gambar'].'">
                                        </a>
                                    </li>';
                            }
                        ?>
                    </ul>
                </div>
                <!-- //footer social icons -->
                <!-- copyright -->
                <div class="copy_right mx-md-auto mb-md-0 mb-3">
                    <p class="text-bl let">© 2019 Kemah Pancasila. All rights reserved | Developed by
                        <a href="http://jogjasite.com/" target="_blank">Jogjasite</a>
                    </p>
                </div>
                <!-- //copyright -->
                <!-- move top icon -->
                <a href="#home" class="move-top text-center" id="to-top">
                    <span class="text">Back to</span> <span class="fa fa-level-up" aria-hidden="true"></span>
                </a>
                <!-- //move top icon -->
            </div>
        </div>
    </div>
    <!-- //copyright bottom -->