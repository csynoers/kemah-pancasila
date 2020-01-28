<?php
    function getVideoId($url) {
        return (
            explode('=',explode('?',$url)[1])[1]
        );
    }
    switch ( $_GET['q'] ) {
        case 'foto':
            $data          = [];
            $data['title'] = $_GET['q'];
            require_once('gallery_foto.php');
            break;
        case 'video':
            $data          = [];
            $data['title'] = $_GET['q'];
            // print_r($database->select($fields="*", $table="gallery_video", $where_clause="ORDER BY tt DESC", $fetch="all"));
            foreach ($database->select($fields="*", $table="gallery_video", $where_clause="ORDER BY tt DESC", $fetch="all") as $key => $value) {
                $value['url'] = getVideoId($value['url']);
                $data['rows'][] = $value;
            }
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