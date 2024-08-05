<?php
$smarteditor2_hash_name = "broadcast";
if (!defined('FT_NONCE_UNIQUE_KEY'))
    define( 'FT_NONCE_UNIQUE_KEY' , sha1($smarteditor2_hash_name) );

if (!defined('FT_NONCE_DURATION'))
    define( 'FT_NONCE_DURATION' , 2160000 ); // 300 makes link or form good for 5 minutes from time of generation,  300은 5분간 유효, 2160000은 10시간동안 유효

if (!defined('FT_NONCE_KEY'))
    define( 'FT_NONCE_KEY' , '_nonce' );

// This method creates a key / value pair for a url string
if(!function_exists('ft_nonce_create_query_string')){
    function ft_nonce_create_query_string( $action = '' , $user = '' ){
        return FT_NONCE_KEY."=".ft_nonce_create( $action , $user );
    }
}

// This method creates an nonce. It should be called by one of the previous two functions.
if(!function_exists('ft_nonce_create')){
    function ft_nonce_create( $action = '' , $user='' ){
        return substr( ft_nonce_generate_hash( $action . $user ), -12, 10);
    }
}

// This method validates an nonce
if(!function_exists('ft_nonce_is_valid')){
    function ft_nonce_is_valid( $nonce , $action = '' , $user='' ){
        // Nonce generated 0-12 hours ago
        if ( substr(ft_nonce_generate_hash( $action . $user ), -12, 10) == $nonce ){
            return true;
        }
        return false;
    }
}

// This method generates the nonce timestamp
if(!function_exists('ft_nonce_generate_hash')){
    function ft_nonce_generate_hash( $action='' , $user='' ){
        $i = ceil( time() / ( FT_NONCE_DURATION / 2 ) );
        return md5( $i . $action . $user . $action );
    }
}

?>