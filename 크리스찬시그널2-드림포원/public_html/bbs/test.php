<?php
include_once('./_common.php');
/**********************************************************************************/
//이부분에 로그파일 경로를 수정해주세요.
$LogPath = G5_PATH."/log";
/**********************************************************************************/

$PageCall = date("Y-m-d [H:i:s]",time());
$logfile = fopen( $LogPath . "/innopay_receive.log", "a+" );
fwrite( $logfile,"************************************************\r\n");
fwrite( $logfile,"PageCall time : ".$PageCall."\r\n");
fwrite( $logfile,"************************************************");
fclose( $logfile );

var_dump($PageCall);