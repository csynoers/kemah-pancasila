<?php
    function exploreIG($tag){
        $ch = curl_init();
        $headers = array(
        'Accept: application/json',
        'Content-Type: application/json',
    
        );
        curl_setopt($ch, CURLOPT_URL, "https://www.instagram.com/explore/tags/{$tag}/?__a=1");
        // curl_setopt($ch, CURLOPT_URL, "graph.facebook.com/ig_hashtag_search?user_id=17991822535251281&q=coke");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        
        //$body = '{}';
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
        //curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        // Timeout in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    
        $authToken = curl_exec($ch);
    
        // return json_decode($authToken);
        return json_decode($authToken)->graphql->hashtag->edge_hashtag_to_media->edges;
    }
    // echo '<pre>';
    // print_r(exploreIG());
    // echo '</pre>';

    $data = [];

    foreach ($database->select('*','hastags',"WHERE 1 AND category='ig' ",'all') as $key => $value) {
        foreach (exploreIG($value['tag']) as $keyTag => $valueTag) {
            $data['rows'][] = $valueTag;
        }
    }

    # paging
    require 'josys/class/Pagination_htaccess.php';
    $pagination = new Paging_get_all();
    $batas      = 30;
    $posisi     = $pagination->cariPosisi($batas);

?>
    <style>
        .grid:after {
            display: block;
            content: '';
            clear: both;
        }

        .grid-col {
            float: left;
            width: 49%;
            margin-right: 2%;
        }

        .grid-col--4 { margin-right: 0; }

        /* hide two middle */
        .grid-col--2, .grid-col--3 { display: none; }

        @media ( min-width: 768px ) {
            .grid-col { width: 32%; }
            .grid-col--2 { display: block; }
        }

        @media ( min-width: 1200px ) {
            .grid-col { width: 23.5%; }
            .grid-col--2, .grid-col--3 { display: block; }
        }

        .grid-item {
            background: #09D;
        }
    </style>

    <!-- banner -->
    <div class="banner_w3lspvt-2XXX">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home" class="font-weight-bold">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Sosial Media</li>
        </ol>
    </div>
    <!-- //banner -->

    <div class="container">
        <!-- Colcade HTML init -->
        <div class="grid" data-colcade="columns: .grid-col, items: .grid-item">
            <div class="grid-col grid-col--1"></div>
            <div class="grid-col grid-col--2"></div>
            <div class="grid-col grid-col--3"></div>
            <div class="grid-col grid-col--4"></div>
            <?php
            foreach (array_splice($data['rows'],$posisi,$batas) as $key => $value) {
                $value->urlMod = "https://www.instagram.com/p/{$value->node->shortcode}"; 
                echo "
                    <div class='grid-item grid-item--{$key} mb-4'>
                        <div class='card'>
                            <img class='card-img-top' src='{$value->node->thumbnail_resources[2]->src}' alt='Card image cap'>
                            <div class='card-body'>
                                <!--<h5 class='card-title'>Card title</h5>-->
                                <p class='card-text'><a href='{$value->urlMod}' class='card-link'>{$value->node->edge_media_to_caption->edges[0]->node->text}</a></p>
                                <!--<a href='#' class='btn btn-primary'>Go somewhere</a>-->
                            </div>
                        </div>                        
                    </div>
                ";
            }
            ?>
        </div>
        <?php 
            $jmldata    = count($data['rows']);
            if ($jmldata > $batas) {
                echo "
                <div class='cleafix'></div>
                <div class='text-center'>
                    <ul class='pagination page-item'>";
                        $jmlhalaman  = $pagination->jumlahHalaman($jmldata, $batas);
                        $linkHalaman = $pagination->navHalaman($_GET['halaman'], $jmlhalaman);
                        echo str_replace('<li', '<li class="page-link"', $linkHalaman);
                    echo "</ul>
                </div>
                ";
            }
        ?>
    </div>
    <script src="https://unpkg.com/colcade@0/colcade.js"></script>
    <script>
        var colc = new Colcade( '.grid', {
            columns: '.grid-col',
            items: '.grid-item'
        });
    </script>