<?php
    include_once('./_common.php');


    //업체 KEY,PASS ↑↑↑↑↑↑↑↑↑↑↑↑↑↑

    //**************************************************************************************************************
    //NICE평가정보 Copyright(c) KOREA INFOMATION SERVICE INC. ALL RIGHTS RESERVED
    
    //서비스명 :  체크플러스 - 안심본인인증 서비스
    //페이지명 :  체크플러스 - 결과 페이지
    
    //인증 후 결과값이 null로 나오는 부분은 관리담당자에게 문의 바랍니다.
    //**************************************************************************************************************
    
    //session_start();
    $sitecode = SITECODE;			// NICE로부터 부여받은 사이트 코드
    $sitepasswd = SITEPASSWD;			// NICE로부터 부여받은 사이트 패스워드
    // Linux = /절대경로/ , Window = D:\\절대경로\\ , D:\절대경로\
    $cb_encode_path = CB_ENCODE_PATH;

    $enc_data_success = $_REQUEST["EncodeData"];		// 암호화된 결과 데이타

    /**********************************************************************************/
    //이부분에 로그파일 경로를 수정해주세요.
    $LogPath = "/home/construction2/public_html/CPClient";
    $PageCall = date("Y-m-d [H:i:s]",time());
    $logfile = fopen( $LogPath . "/CPClient_success.log", "a+" );
    fwrite( $logfile,"************************************************\r\n");
    fwrite( $logfile,"PageCall time : ".$PageCall."\r\n");

    if ($enc_data_success != "") {

        $plaindata_success = `$cb_encode_path DEC $sitecode $sitepasswd $enc_data_success`;		// 암호화된 결과 데이터의 복호화

        $returnMsg = '';
        if ($plaindata_success == -1){
            $returnMsg  = "암/복호화 시스템 오류";
        }else if ($plaindata_success == -4){
            $returnMsg  = "복호화 처리 오류";
        }else if ($plaindata_success == -5){
            $returnMsg  = "HASH값 불일치 - 복호화 데이터는 리턴됨";
        }else if ($plaindata_success == -6){
            $returnMsg  = "복호화 데이터 오류";
        }else if ($plaindata_success == -9){
            $returnMsg  = "입력값 오류";
        }else if ($plaindata_success == -12){
            $returnMsg  = "사이트 비밀번호 오류";
        }else{
            // 복호화가 정상적일 경우 데이터를 파싱합니다.
            $ciphertime = `$cb_encode_path CTS $sitecode $sitepasswd $enc_data_success`;	// 암호화된 결과 데이터 검증 (복호화한 시간획득)


            //$requestnumber = `$cb_encode_path SEQ $sitecode`;

            $requestnumber = GetValue($plaindata_success , "REQ_SEQ");
            $responsenumber = GetValue($plaindata_success , "RES_SEQ");

            $authtype = GetValue($plaindata_success , "AUTH_TYPE");
            $name = GetValue($plaindata_success , "NAME");
            $name = GetValue($plaindata_success , "UTF8_NAME"); //charset utf8 사용시 주석 해제 후 사용
            $name = urldecode($name);

            $birthdate = GetValue($plaindata_success , "BIRTHDATE");
            $gender = GetValue($plaindata_success , "GENDER");
            $nationalinfo = GetValue($plaindata_success , "NATIONALINFO");	//내/외국인정보(사용자 매뉴얼 참조)
            $dupinfo = GetValue($plaindata_success , "DI");
            $conninfo = GetValue($plaindata_success , "CI");
			$mobileno = GetValue($plaindata_success , "MOBILE_NO");
            $mobileco = GetValue($plaindata_success , "MOBILE_CO");


            fwrite( $logfile,"requestnumber      : ".$requestnumber."\r\n");
            fwrite( $logfile,"responsenumber      : ".$responsenumber."\r\n");
            fwrite( $logfile,"authtype        : ".$authtype."\r\n");
            fwrite( $logfile,"name      : ".$name."\r\n");
            fwrite( $logfile,"birthdate   : ".$birthdate."\r\n");
            fwrite( $logfile,"gender          : ".$gender."\r\n");
            fwrite( $logfile,"nationalinfo     : ".$nationalinfo."\r\n");
            fwrite( $logfile,"dupinfo      : ".$dupinfo."\r\n");
            fwrite( $logfile,"conninfo     : ".$conninfo."\r\n");
            fwrite( $logfile,"mobileno  : ".$mobileno."\r\n");
            fwrite( $logfile,"mobileco        : ".$mobileco."\r\n");

            //if(strcmp($_SESSION["REQ_SEQ"], $requestnumber) != 0)
            if(0)
            {
                fwrite( $logfile,"세션값이 다릅니다. 올바른 경로로 접근하시기 바랍니다.\r\n");
                fwrite( $logfile,"************************************************");
                fclose( $logfile );

                alert( "세션값이 다릅니다. 올바른 경로로 접근하시기 바랍니다.",G5_BBS_URL."/logout.php");
                $requestnumber = "";
                $responsenumber = "";
                $authtype = "";
                $name = "";
            	$birthdate = "";
            	$gender = "";
            	$nationalinfo = "";
            	$dupinfo = "";
            	$conninfo = "";
                $mobileno = "";
                $mobileco = "";
            }
        }

        if($returnMsg){
            fwrite( $logfile,"returnMsg : ".$returnMsg."\r\n");
            fwrite( $logfile,"************************************************");
            fclose( $logfile );

            alert($returnMsg,G5_BBS_URL."/logout.php");
        }

    }

    fwrite( $logfile,"************************************************");
    fclose( $logfile );
    /**********************************************************************************/

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

<script language='javascript'>

    $( document ).ready(function() {
        $('#fnPopup_txt').val('본인인증 완료');
    })

</script>


