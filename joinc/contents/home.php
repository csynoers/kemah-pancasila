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

<!-- start content artikel: (program,berita,agenda) -->
	<?php
		$artikel = [];
		#get rows program
		foreach ($database->select($fields="*", $table="program", $where_clause="ORDER BY id_program DESC LIMIT 1", $fetch="all") as $key => $value) {
			$value['deskripsi'] = strip_tags(substr($value['deskripsi'], 0, 150)).'..';
			$value['image']		= "./joimg/program/thumbnail/{$value['image']}";
			$value['url'] 		= "detail-program-{$value['seo']}-{$value['id_program']}";
			$artikel[] 			= $value;
		}  
		#get rows berita
		foreach ($database->select($fields="*", $table="blog", $where_clause="ORDER BY id_blog DESC LIMIT 1", $fetch="all") as $key => $value) {
			$value['deskripsi'] = strip_tags(substr($value['deskripsi'], 0, 150)).'..';
			$value['image']		= "./joimg/blog/thumbnail/{$value['image']}";
			$value['url'] 		= "detail-berita-{$value['seo']}-{$value['id_blog']}";
			$artikel[] = $value;
		}  
		#get rows agenda
		foreach ($database->select($fields="*", $table="agenda", $where_clause="ORDER BY id_agenda DESC LIMIT 1", $fetch="all") as $key => $value) {
			$value['deskripsi'] = strip_tags(substr($value['deskripsi'], 0, 150)).'..';
			$value['image']		= "./joimg/agenda/thumbnail/{$value['image']}";
			$value['url'] 		= "detail-agenda-{$value['seo']}-{$value['id_agenda']}";
			$artikel[] = $value;
		}
		$artikel = array_slice($artikel,0,3);
		
		#generate htmls artikel
		$artikelHtmls = [];
		foreach ($artikel as $key => $value) {
			$artikelHtmls[] = "
			<div class='col-lg-4'>
				<div class='about-grid-main' style='padding:1em!important;'>
					<img src='{$value['image']}' alt='{$value['judul']}' class='img-fluid'>
					<h4 class='my-4'>{$value['judul']}</h4>
					<p>{$value['deskripsi']}</p>
					<a href='{$value['url']}' class='button-w3ls btn mt-sm-5 mt-4'><i class='fa fa-book'></i> Read more</a>
				</div>
			</div>
			<div class='clearfix'></div>
			";
		}
		$artikelHtmls = implode('',$artikelHtmls);

		// echo '<pre>';
		// print_r($artikel);
		// echo '</pre>';
	?>
	<div class="what bg-li py-5" id="whyChooseUs">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="title text-center font-weight-bold">Info Terbaru</h3>
			<p class="sub-tittle text-center mt-3 mb-sm-5 mb-4">Program , Berita & Agenda</p>				
			<div class="row about-bottom-w3l text-center mt-4">
				<?= $artikelHtmls ?>			
			</div>
		</div>
	</div>
<!-- end content artikel: (program,berita,agenda) -->

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