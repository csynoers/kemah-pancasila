<!--banner -->
    <div class="banner_w3lspvt position-relative">
        <div class="container">
            <div class="d-md-flex">
                <div class="w3ls_banner_txt pt-0">
                    <h3 class="w3ls_pvt-title">Selamat Datang di<br>Website <span>Kemah Pancasila</span></h3>
                    <p class="text-sty-banner">
                        <?php 
                          $history = $database->select($fields="static_content,gambar", $table="modul", $where_clause="WHERE id_modul = 5", $fetch='');
                          echo substr(strip_tags($history["static_content"]), 0, 275);
                        ?>...                            
                        </p>
                    <a href="about" class="btn button-style mt-md-5 mt-4">Read More</a>
                </div>
                <div class="banner-img">
                    <?php                     	
                    	echo '
		                    <img src="joimg/modul/'.$history["gambar"].'" alt="" class="img-fluid">
                    	';
                     ?>
                </div>
            </div>
        </div>
        <!-- animations effects -->
        <div class="icon-effects-w3l">
            <img src="images/shape1.png" alt="" class="img-fluid shape-wthree shape-w3-one">
            <img src="images/shape2.png" alt="" class="img-fluid shape-wthree shape-w3-two">
            <img src="images/shape3.png" alt="" class="img-fluid shape-wthree shape-w3-three">
            <img src="images/shape5.png" alt="" class="img-fluid shape-wthree shape-w3-four">
            <img src="images/shape4.png" alt="" class="img-fluid shape-wthree shape-w3-five">
            <img src="images/shape6.png" alt="" class="img-fluid shape-wthree shape-w3-six">
        </div>
        <!-- //animations effects -->
    </div>
<!-- //banner -->
<!-- what we do section -->
	<div class="what bg-li py-5" id="whyChooseUs">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="title text-center font-weight-bold">Fasilitas</h3>
			<p class="sub-tittle text-center mt-3 mb-sm-5 mb-4">Fasilitas Kemah Pancasila</p>				
			<div class="row about-bottom-w3l text-center mt-4">
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
<!-- //what we do section -->
	<!-- services -->
	<!-- <section class="banner-bottom-w3layouts bg-li py-5" id="services">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="tittle text-center font-weight-bold">Our Services</h3>
			<p class="sub-tittle text-center mt-3 mb-sm-5 mb-4">Saat ini kami melayanai pemesanan untuk pengiriman air bersih, sehat dan bekualitas ke beberapa wilayah di Indonesia.</p>
			<div class="row pt-lg-4">
				<div class="col-lg-4 about-in text-center">
					<div class="card">
						<div class="card-body">
							<div class="bg-clr-w3l">
								<span class="fa fa-user"></span>
							</div>
							<h5 class="card-title mt-4 mb-3">Yogyakarta</h5>
							<p class="card-text">Hubungi nomor dibawah ini untuk pemesanan di wilayah Yogyakarta & sekitarnya.</p>
							<a href="tel:085100883614" class="button-w3ls btn mt-sm-5 mt-4"><i class="fa fa-phone"></i> 085-100-883-614</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 about-in text-center">
					<div class="card active">
						<div class="card-body">
							<div class="bg-clr-w3l">
								<span class="fa fa-user"></span>
							</div>
							<h5 class="card-title mt-4 mb-3">Solo</h5>
							<p class="card-text">Hubungi nomor dibawah ini untuk pemesanan di wilayah Solo & sekitarnya.</p>
							<a href="tel:085100551751" class="button-w3ls btn mt-sm-5 mt-4"><i class="fa fa-phone"></i> 085-100-551-751</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 about-in text-center">
					<div class="card">
						<div class="card-body">
							<div class="bg-clr-w3l">
								<span class="fa fa-user"></span>
							</div>
							<h5 class="card-title mt-4 mb-3">Tegal & Purwokerto</h5>
							<p class="card-text">Hubungi nomor dibawah ini untuk pemesanan di wilayah sekitar Tegal & Purwokerto.</p>
							<a href="tel:085100329329" class="button-w3ls btn mt-sm-5 mt-4"><i class="fa fa-phone"></i> 085-100-329-329</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->
	<!-- //services -->
	<!-- partners -->
	<section class="partners py-5" id="penyelenggara">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="tittle text-center font-weight-bold">Penyelenggara</h3>
			<p class="sub-tittle text-center mt-3 mb-sm-5 mb-4">Penyelenggara Kemah Pancasila.</p>
			<div class="row grid-part text-center pt-4" >
				<div class="owl-carousel" id="slider2">					
				<?php 
                    $client = $database->select($fields="*", $table="client", $where_clause="ORDER BY id_client DESC", $fetch="all");
                    foreach ($client as $key => $cl) {
                        echo '
							<div class="parts-w3ls">															
								<a href="'.$cl['url'].'"><img src="joimg/client/'.$cl['image'].'" alt="'.$cl['nama'].'"></a>
								<h4>'.$cl['nama'].'</h4>
							</div>
                        ';
                    }
                ?>
				</div>
				
			</div>
		</div>
	</section>
	<!-- //partners