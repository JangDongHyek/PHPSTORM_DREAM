<?php
    include_once('./_common.php');
    include_once('./CPC_lib.php');
    //업체 KEY,PASS ↑↑↑↑↑↑↑↑↑↑↑↑↑↑

    //**************************************************************************************************************
    //NICE평가정보 Copyright(c) KOREA INFOMATION SERVICE INC. ALL RIGHTS RESERVED
    
    //서비스명 :  체크플러스 - 안심본인인증 서비스
    //페이지명 :  체크플러스 - 결과 페이지
    
    //**************************************************************************************************************

    $sitecode = SITECODE;			// NICE로부터 부여받은 사이트 코드
    $sitepasswd = SITEPASSWD;			// NICE로부터 부여받은 사이트 패스워드
    // Linux = /절대경로/ , Window = D:\\절대경로\\ , D:\절대경로\
    $cb_encode_path = CB_ENCODE_PATH;

    $enc_data = $_REQUEST["EncodeData"];		// 암호화된 결과 데이타

    /**********************************************************************************/
    //이부분에 로그파일 경로를 수정해주세요.
    $LogPath = "/home/construction2/public_html/CPClient";
    $PageCall = date("Y-m-d [H:i:s]",time());
    $logfile = fopen( $LogPath . "/CPClient_fail.log", "a+" );

    fwrite( $logfile,"************************************************\r\n");

    if ($enc_data != "") {

        $plaindata = `$cb_encode_path DEC $sitecode $sitepasswd $enc_data`;		// 암호화된 결과 데이터의 복호화
        echo "[plaindata] " . $plaindata . "<br>";

        if ($plaindata == -1){
            $returnMsg  = "암/복호화 시스템 오류";
        }else if ($plaindata == -4){
            $returnMsg  = "복호화 처리 오류";
        }else if ($plaindata == -5){
            $returnMsg  = "HASH값 불일치 - 복호화 데이터는 리턴됨";
        }else if ($plaindata == -6){
            $returnMsg  = "복호화 데이터 오류";
        }else if ($plaindata == -9){
            $returnMsg  = "입력값 오류";
        }else if ($plaindata == -12){
            $returnMsg  = "사이트 비밀번호 오류";
        }else{
            // 복호화가 정상적일 경우 데이터를 파싱합니다.
            $ciphertime = `$cb_encode_path CTS $sitecode $sitepasswd $enc_data`;	// 암호화된 결과 데이터 검증 (복호화한 시간획득)
            
            $requestnumber = GetValue($plaindata , "REQ_SEQ");
            $errcode = GetValue($plaindata , "ERR_CODE");
            $authtype = GetValue($plaindata , "AUTH_TYPE");

            fwrite( $logfile,"requestnumber   : ".$requestnumber."\r\n");
            fwrite( $logfile,"errcode          : ".$errcode."\r\n");
            fwrite( $logfile,"authtype     : ".$authtype."\r\n");

        }
    }
    fwrite( $logfile,"returnMsg : ".$returnMsg."\r\n");
    fwrite( $logfile,"************************************************");
    fclose( $logfile );

    if($returnMsg){

        alert('본인인증 실패\n'.$returnMsg,G5_BBS_URL."/logout.php");
    }else{
        alert('본인인증 실패\n 다시 시도해주세요.',G5_BBS_URL."/logout.php");
    }

    function GetValue($str , $name)
    {
        $pos1 = 0;  //length의 시작 위치
        $pos2 = 0;  //:의 위치

        while( $pos1 <= strlen($str) )
        {
            $pos2 = strpos( $str , ":" , $pos1);
            $len = substr($str , $pos1 , $pos2 - $pos1);
            $key = substr($str , $pos2 + 1 , $len);
            $pos1 = $pos2 + $len + 1;
            if( $key == $name )
            {
                $pos2 = strpos( $str , ":" , $pos1);
                $len = substr($str , $pos1 , $pos2 - $pos1);
                $value = substr($str , $pos2 + 1 , $len);
                return $value;
            }
            else
            {
                // 다르면 스킵한다.
                $pos2 = strpos( $str , ":" , $pos1);
                $len = substr($str , $pos1 , $pos2 - $pos1);
                $pos1 = $pos2 + $len + 1;
            }
        }
    }
?>


