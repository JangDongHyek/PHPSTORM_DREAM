<?
/* 브로우저가 gzip 인코딩을 지원하는지 판정하는 함수 */
function CheckCanGzip(){
    global $_SERVER;
    if (headers_sent() || connection_aborted()){
        return 0;
    }
    if (strpos($_SERVER["HTTP_ACCEPT_ENCODING"], 'x-gzip') !== false) return "x-gzip";
    if (strpos($_SERVER["HTTP_ACCEPT_ENCODING"],'gzip') !== false) return "gzip";
    return 0;
}

/* $level = 압축 레벨, 0=압축 안함, 9=최대 */
function GzDocOut($level=9,$debug=0){
	global $phpEx;
    $ENCODING = CheckCanGzip();
//	$ENCODING = 'gzip';
    if ($ENCODING){
        $Contents = ob_get_contents();
        ob_end_clean();
        if ($debug){
            $s = "<p>Not compress length: ".strlen($Contents);
            $s .= "<br>Compressed length: ".strlen(gzcompress($Contents,$level));
            $Contents .= $s;
        }
        header("Content-Encoding: $ENCODING");
        print "\x1f\x8b\x08\x00\x00\x00\x00\x00";
        $Size = strlen($Contents);
        $Crc = crc32($Contents);
        $Contents = gzcompress($Contents,$level);
        $Contents = substr($Contents, 0, strlen($Contents) - 4);
        print $Contents;
        print pack('V',$Crc);
        print pack('V',$Size);
    }
}
?>