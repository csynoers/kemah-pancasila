<?php
function seo($value) {
    $space = array (' ');
    $spaceharacter = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');

    $value = str_replace($spaceharacter, '', $value); // Hilangkan karakter yang telah disebutkan di array $spaceharacter

    $value = strtolower(str_replace($space, '-', $value)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
    return $value;
}
