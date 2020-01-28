<!-- banner -->
    <div class="banner_w3lspvt-2XXX">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home" class="font-weight-bold">Galeri</a></li>
            <li class="breadcrumb-item" aria-current="page"><?= ucfirst($data['title']) ?></li>
        </ol>
    </div>
<!-- //banner -->
<section class="banner-bottom-w3layouts bg-li">
    <div class="container py-lg-3">
        <div class="row pt-lg-4">
            <?php
                $htmls = [];
                foreach ($data['rows'] as $key => $value) {
                    $htmls[] = '
                        <div class="col-lg-4"><iframe class="w-100" height="300px" src="https://www.youtube.com/embed/'.$value['url'].'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                    ';
                }
                $htmls = implode('',$htmls);
                echo $htmls;
            ?>
        </div>
    </div> 
</section>   