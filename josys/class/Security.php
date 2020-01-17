<?php
/*==============================================================================
*	CLASS SECURITY UNTUK PROSES clean_input, anti_injection , enkrip, dekrip
*							2016 (c) By NFY Nautilus
*                           LAST UPDATE 2016/02/29
*==============================================================================*/
class Security{
    //Function clean character
    function clean_input($value) {
    	$character = array ('{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','-','_','/','\\',',','.','#',':',';','\'','"','[',']');
    	$clean     = strtolower(str_replace($character,"",$value));
    	return $clean;
    }

    //Function Anti SQL inject
    function anti_injection($value, $clean='') { //$clean='FALSE'
    	$filter = stripslashes(strip_tags(htmlspecialchars($value,ENT_QUOTES)));
        if($clean == 'FALSE') {
    	    $clean  = $filter;
        }else{
            $clean  = $this->clean_input($filter);
        }
        return $clean;
    }

    //Function Enkripsi Password
    function enkrip( $value ) {
        $key= 'qJB0rGtIn5UB1xG03efyCp';
        //$key previously generated safely, ie: openssl_random_pseudo_bytes
        $plaintext = $value;
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        //$hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        $ciphertext = base64_encode( $iv./*$hmac.*/$ciphertext_raw );
        return $ciphertext;
    }

    //Function Dekripsi Password
    function dekrip( $value ) {
        $key= 'qJB0rGtIn5UB1xG03efyCp';
        $c = base64_decode($value);
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        //$hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen/*+$sha2len*/);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        return $original_plaintext;
    }
}
