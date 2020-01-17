<?php
/*==============================================================================
*				CLASS DATABASE UNTUK PROSES UPLOAD, THUMBNAIL, WATERMARK
*							2016 (c) By NFY Nautilus
*                           LAST UPDATE 2016/02/29
*==============================================================================*/
class Upload {

    public function berkas($fileName, $fileDirectory, $inputName="") {
        //direktori Header
        if(empty($inputName)){
            $inputName = "fupload";
        }
        $vdir_upload    = $fileDirectory;
        $vfile_upload   = $vdir_upload . $fileName;
        $tipe_file      = $_FILES["$inputName"]["type"];

        //unggah file
        move_uploaded_file($_FILES["$inputName"]["tmp_name"], $vfile_upload);
    }

    public function file($fileName, $fileDirectory, $inputName="") {
        //direktori Header
        if(empty($inputName)){
            $inputName = "fuploadkatalog";
        }
        $vdir_upload    = $fileDirectory;
        $vfile_upload   = $vdir_upload . $fileName;
        $tipe_file      = $_FILES["$inputName"]["type"];

        //unggah file
        move_uploaded_file($_FILES["$inputName"]["tmp_name"], $vfile_upload);
    }

    public function cover($fileName, $fileDirectory, $inputName="") {
        //direktori Header
        if(empty($inputName)){
            $inputName = "fuploadcover";
        }
        $vdir_upload    = $fileDirectory;
        $vfile_upload   = $vdir_upload . $fileName;
        $tipe_file      = $_FILES["$inputName"]["type"];

        //unggah file
        move_uploaded_file($_FILES["$inputName"]["tmp_name"], $vfile_upload);
    }

    public function thumbnail($imageName, $imageDirectory, $thumbDirectory, $thumbWidth) {
        $explode = explode(".", $imageName);
        $filetype = $explode[1];

        if ($filetype == 'jpg') {
            $srcImg = imagecreatefromjpeg("$imageDirectory/$imageName");
        } else
        if ($filetype == 'jpeg') {
            $srcImg = imagecreatefromjpeg("$imageDirectory/$imageName");
        } else
        if ($filetype == 'png') {
            $srcImg = imagecreatefrompng("$imageDirectory/$imageName");
        } else
        if ($filetype == 'gif') {
            $srcImg = imagecreatefromgif("$imageDirectory/$imageName");
        }

        $origWidth = imagesx($srcImg);
        $origHeight = imagesy($srcImg);

        $ratio = $origWidth / $thumbWidth;
        $thumbHeight = $origHeight / $ratio;

        $thumbImg = imagecreatetruecolor($thumbWidth, $thumbHeight);
        imagecopyresized($thumbImg, $srcImg, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $origWidth, $origHeight);

        if ($filetype == 'jpg') {
            imagejpeg($thumbImg, "$thumbDirectory/$imageName");
        } else
        if ($filetype == 'jpeg') {
            imagejpeg($thumbImg, "$thumbDirectory/$imageName");
        } else
        if ($filetype == 'png') {
            imagepng($thumbImg, "$thumbDirectory/$imageName");
        } else
        if ($filetype == 'gif') {
            imagegif($thumbImg, "$thumbDirectory/$imageName");
        }
    }

	//$image_path = "../../../images/watermark.png"; === imageDirectory

    public function watermark($oldImage, $newImage, $imageDirectory) {
    	global $image_path;
        $image_path = $imageDirectory;
    	list($owidth,$oheight) = getimagesize($oldImage);
    	$width = $owidth; //ukuran gambar setelah watermark
    	$height = $oheight; //ukuran gambar setelah watermark
    	$im = imagecreatetruecolor($width, $height);
    	$img_src = imagecreatefromjpeg($oldImage);
    	unlink($oldImage); //delete image lama sebelum membuat image baru dengan nama yang sama
    	imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
    	$watermark = imagecreatefrompng($image_path);
    	list($w_width, $w_height) = getimagesize($image_path);
    	#$pos_x = $width - $w_width;
    	#$pos_y = $height - $w_height;
        $pos_x = ($width - $w_width)/2;
    	$pos_y = ($height - $w_height)/2;

    	//$pos_x-10 supaya gambar watermark ke atas sepuluh pixel
    	imagecopy($im, $watermark, $pos_x, $pos_y, 0, 0, $w_width, $w_height);
    	imagejpeg($im, $newImage, 100);
    	imagedestroy($im);
    	return true;
    }
}
