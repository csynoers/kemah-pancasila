<?php
    switch ( $_GET['q'] ) {
        case 'foto':
            $data          = [];
            $data['title'] = $_GET['q'];
            require_once('gallery_foto.php');
            break;
        case 'video':
            $data          = [];
            $data['title'] = $_GET['q'];
            $data['rows'] = ['MVigfFnjzEE','MVigfFnjzEE','MVigfFnjzEE','MVigfFnjzEE'];
            require_once('gallery_video.php');
            break;
        
        default:
            echo json_encode([
                'status' => FALSE,
                'message'=> 'halaman tidak ditemukan'
            ]);
            break;
    }
?>