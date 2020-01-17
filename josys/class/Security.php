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
    	$cryptKey 	= 'qJB0rGtIn5UB1xG03efyCp';
    	$qEncoded 	= base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $value, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    	return( $qEncoded );
    }

    //Function Dekripsi Password
    function dekrip( $value ) {
    	$cryptKey	= 'qJB0rGtIn5UB1xG03efyCp';
    	$qDecoded 	= rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $value ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    	return( $qDecoded );
    }
}
