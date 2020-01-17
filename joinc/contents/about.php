<!-- banner -->
	<div class="banner_w3lspvt-2">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="home" class="font-weight-bold">Home</a></li>
			<li class="breadcrumb-item" aria-current="page">Kemah Pancasila</li>
		</ol>
	</div>
<!-- //banner -->
<!-- about -->
	<div class="about-inner">
		<div class="container pb-lg-3">
			<div class="row">
				<div class="col-lg-6 welcome-right text-center mt-lg-0 mt-5">
					<?php                     	
                      $history = $database->select($fields="static_content,gambar", $table="modul", $where_clause="WHERE id_modul = 5", $fetch='');
                    	echo '
		                    <img src="joimg/modul/'.$history["gambar"].'" alt="" class="img-fluid">
                    	';
                     ?>
				</div>
				<div class="col-lg-6 about-right-faq pr-0">
					<h6>Kemah Pancasila</h6>
					<h3 class="mt-2 mb-3">Selamat Datang di Website Kemah Pancasila</h3>
						<?php 
                          echo str_replace('<p>', '<p class="mt-3 text-sty-banner">', $history["static_content"]);
                        ?>
				</div>				
			</div>
		</div>
	</div>
	<!-- //about -->
	<!-- middle -->
	<section class="midd-w3" id="faq">
		<div class="container py-lg-3">
			<div class="row">
				<div class="col-lg-7 about-right-faq">
					<h6>Kemah Pancasila</h6>
					<h3 class="text-da">Visi dan Misi</h3>
					<?php 
                      $visi = $database->select($fields="static_content,gambar", $table="modul", $where_clause="WHERE id_modul = 4", $fetch='');
                      echo $visi["static_content"];
                    ?>
				</div>
				<div class="col-lg-5 left-wthree-img text-right">
					<?php                     	
                    	echo '
		                    <img src="joimg/modul/'.$visi["gambar"].'" alt="" class="img-fluid">
                    	';
                     ?>
				</div>
			</div>
		</div>
	</section>
	<!-- //middle -->
	<!-- team -->
	<section class="team bg-li py-5" id="team">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="tittle text-center font-weight-bold">Trainer</h3>
			<p class="sub-tittle text-center mt-3 mb-sm-5 mb-4">Berikut tim professional Kemah Pancasila</p>
			<div class="row ab-info second pt-lg-4">
				<?php 
					$staff_gallery = $database->select($fields="staff_gallery.*, name", $table="staff_gallery", $where_clause="INNER JOIN staff ON (staff_gallery.id_kategori = staff.id_staff) ORDER BY name ASC", $fetch="all");
                    foreach ($staff_gallery as $key => $c) {
                        echo '
                            <div class="col-lg-3 col-sm-6 ab-content text-center mt-4">
								<div class="ab-content-inner">
									<img src="joimg/staff_gallery/'.$c['image'].'" alt="'.$c['nama'].'" class="img-fluid">
									<div class="ab-info-con">
										<h4 class="text-team-w3">'.$c['nama'].'</h4>
										<p>'.$c['deskripsi'].'</p>
										<p><b>'.$c['name'].'</b></p>
									</div>
								</div>
							</div>
                        ';
                    }
				 ?>
			</div>
		</div>
	</section>
	<!-- //team -->