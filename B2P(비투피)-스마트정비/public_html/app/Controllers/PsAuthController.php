<?php namespace App\Controllers;

class PsAuthController extends BaseController{

    //본인인증
    public function psAuth(){
        $auth = get_cookie("isAuth");
        delete_cookie('isAuth');
        if($auth != "T"){
            return redirect()->to("/");
        }

        $sessions = session();
        $sessions->set("auth", "T");

        $sitecode = NICE_SITECODE;
        $sitepasswd = NICE_SITEPASSWD;
        $cb_encode_path = CB_ENCODE_PATH;
        $authtype = "M";      		// 없으면 기본 선택화면, M(휴대폰), X(인증서공통), U(공동인증서), F(금융인증서), S(PASS인증서), C(신용카드)
        $popgubun 	= "N";		//Y : 취소버튼 있음 / N : 취소버튼 없음
        $customize 	= "";		//없으면 기본 웹페이지 / Mobile : 모바일페이지 (default값은 빈값, 환경에 맞는 화면 제공)
        $reqseq = $sitecode.'_'.time();

        // CheckPlus(본인인증) 처리 후, 결과 데이타를 리턴 받기위해 다음예제와 같이 http부터 입력합니다.
        // 리턴url은 인증 전 인증페이지를 호출하기 전 url과 동일해야 합니다. ex) 인증 전 url : http://www.~ 리턴 url : http://www.~

        $returnurl = ""; // 성공시 이동될 URL
        if($this->data['auth_type'] == "sign"){
            $returnurl = base_url("/auth/psAuthSuccess");
        }

        $errorurl = base_url("/auth/psAuthFail");		// 실패시 이동될 URL

        // 입력될 plain 데이타를 만든다.
        $plaindata = "7:REQ_SEQ" . strlen($reqseq) . ":" . $reqseq .
            "8:SITECODE" . strlen($sitecode) . ":" . $sitecode .
            "9:AUTH_TYPE" . strlen($authtype) . ":". $authtype .
            "7:RTN_URL" . strlen($returnurl) . ":" . $returnurl .
            "7:ERR_URL" . strlen($errorurl) . ":" . $errorurl .
            "9:CUSTOMIZE" . strlen($customize) . ":" . $customize;

        $enc_data = `$cb_encode_path ENC $sitecode $sitepasswd $plaindata`;

        $returnMsg = "";

        if( $enc_data == -1 )
        {
            $returnMsg = "암/복호화 시스템 오류입니다.";
            $enc_data = "";
        }
        else if( $enc_data== -2 )
        {
            $returnMsg = "암호화 처리 오류입니다.";
            $enc_data = "";
        }
        else if( $enc_data== -3 )
        {
            $returnMsg = "암호화 데이터 오류 입니다.";
            $enc_data = "";
        }
        else if( $enc_data== -9 )
        {
            $returnMsg = "입력값 오류 입니다.";
            $enc_data = "";
        }

        $this->data['pid'] = 'psAuth';
        $this->data['enc_data'] = $enc_data;
        return view('auth/psAuth',$this->data);
    }

    // 본인인증 성공시
    public function psAuthSuccess() {
        $session = session();
        $auth = $session->get("auth");
        $session->remove('auth');
        if ($auth != "T") {
            $session->setFlashdata('msg', '올바르게 이용해주세요.');
            //return redirect()->to("/");
        }

        $sitecode = NICE_SITECODE;
        $sitepasswd = NICE_SITEPASSWD;
        $cb_encode_path = CB_ENCODE_PATH;

        $enc_data_success = $_REQUEST["EncodeData"]; // 암호화된 결과 데이터

        /**********************************************************************************/
        // 이 부분에 로그 파일 경로를 수정해주세요.
        $LogPath = APPPATH . 'ThirdParty/CPClient/logs';
        $PageCall = date("Y-m-d [H:i:s]", time());
        $logfile = fopen($LogPath . "/CPClient_success.log", "a+");

        // 파일 핸들이 유효한지 확인
        if ($logfile === false) {
            throw new \RuntimeException('Unable to open log file for writing: ' . $LogPath . "/CPClient_success.log");
        }

        fwrite($logfile, "************************************************\r\n");
        fwrite($logfile, "PageCall time : " . $PageCall . "\r\n");

        if ($enc_data_success != "") {
            $plaindata_success = `$cb_encode_path DEC $sitecode $sitepasswd $enc_data_success`; // 암호화된 결과 데이터의 복호화



            $returnMsg = '';
            if ($plaindata_success == -1) {
                $returnMsg = "암/복호화 시스템 오류";
            } elseif ($plaindata_success == -4) {
                $returnMsg = "복호화 처리 오류";
            } elseif ($plaindata_success == -5) {
                $returnMsg = "HASH값 불일치 - 복호화 데이터는 리턴됨";
            } elseif ($plaindata_success == -6) {
                $returnMsg = "복호화 데이터 오류";
            } elseif ($plaindata_success == -9) {
                $returnMsg = "입력값 오류";
            } elseif ($plaindata_success == -12) {
                $returnMsg = "사이트 비밀번호 오류";
            } else {
                // 복호화가 정상적일 경우 데이터를 파싱합니다.
                $requestnumber = $this->GetValue($plaindata_success, "REQ_SEQ");
                $responsenumber = $this->GetValue($plaindata_success, "RES_SEQ");
                $authtype = $this->GetValue($plaindata_success, "AUTH_TYPE");
                $name = $this->GetValue($plaindata_success, "UTF8_NAME"); // charset utf8 사용시 주석 해제 후 사용
                $name = urldecode($name);
                $birthdate = $this->GetValue($plaindata_success, "BIRTHDATE");
                $gender = $this->GetValue($plaindata_success, "GENDER");
                $nationalinfo = $this->GetValue($plaindata_success, "NATIONALINFO"); // 내/외국인 정보
                $di = $this->GetValue($plaindata_success, "DI");
                $ci = $this->GetValue($plaindata_success, "CI");
                $hp = $this->GetValue($plaindata_success , "MOBILE_NO");
                $hp = preg_replace('/(\d{3})(\d{4})(\d{4})/', '$1-$2-$3', $hp);

                $sql = "select * from `member_list` where `mb_di` = '$di'";
                $row = sql_fetch($sql);
                if(!empty($row)){
                    $session->setFlashdata('msg', '이미 가입한 회원입니다.');
                    return redirect()->to("/");
                }
                $session->set("auth_name",$name);
                $session->set("auth_birthdate",$birthdate);
                $session->set("auth_di",$di);
                $session->set("auth_ci",$ci);
                $session->set("auth_hp",$hp);

                fwrite($logfile, "requestnumber : " . $requestnumber . "\r\n");
                fwrite($logfile, "responsenumber : " . $responsenumber . "\r\n");
                fwrite($logfile, "authtype : " . $authtype . "\r\n");
                fwrite($logfile, "name : " . $name . "\r\n");
                fwrite($logfile, "hp : " . $hp . "\r\n");
                fwrite($logfile, "birthdate : " . $birthdate . "\r\n");
                fwrite($logfile, "gender : " . $gender . "\r\n");
                fwrite($logfile, "nationalinfo : " . $nationalinfo . "\r\n");
                fwrite($logfile, "dupinfo : " . $di . "\r\n");
                fwrite($logfile, "conninfo : " . $ci . "\r\n");


                return redirect()->to("signup/regiAgr");
            }

            if ($returnMsg) {
                fwrite($logfile, "returnMsg : " . $returnMsg . "\r\n");
                fwrite($logfile, "************************************************");
                fclose($logfile);
                $session->setFlashdata('msg', $returnMsg. ' 처음부터 다시 시도해주세요.');
                return redirect()->to("/");
            }
        }

        fwrite($logfile, "************************************************");
        fclose($logfile);
        /**********************************************************************************/

        $session->setFlashdata('msg', '올바르게 이용해주세요.');
        return redirect()->to("/");
    }

    // 본인인증 실패시
    public function psAuthFail(){

    }

    // 계좌 인증
    public function chkBankAccount() {
        $result = ['code'=>400, 'msg'=>''];

        $niceUid = BANK_SITECODE; // NICE에서 발급받은 사이트코드
        $svcPwd  = BANK_SITEPASSWD; // NICE에서 발급받은 사이트 패스워드
        $strCharset = "UTF-8"; // 인증서버의 한글 인코딩 (EUC-KR, UTF-8)

        // 입력 페이지에서 전달된 입력값 취득
        $service = 1; // 서비스구분 (1: 소유주 확인, 2: 예금주명 확인, 3: 계좌 유효성 확인)
        $svcGbn = 5; // 업무구분 (5: 소유주 확인, 2: 예금주명 확인, 4: 계좌 유효성 확인)
        $strGbn = 2; // 계좌구분 (1:개인계좌, 2:법인계좌)
        $strBankCode = $_POST["bank_code"]; // 은행코드
        $strAccountNo = $_POST["bank_num"]; // 계좌번호

        // 예금주명 초기화 및 취득
        $strNm = $_POST["bank_owner"];
        $strNm = urlencode($strNm);
        if(empty($strNm)){
            $result['msg'] = "예금주명을 입력해주세요.";
            $result['err_id'] = "bank_owner";
            return $this->response->setJSON($result);
        }

        if(empty($strBankCode)){
            $result['msg'] = "은행을 선택해주세요.";
            $result['err_id'] = "bank_code";
            return $this->response->setJSON($result);
        }

        if(empty($strAccountNo)){
            $result['msg'] = "계좌번호를 입력해주세요.";
            $result['err_id'] = "bank_num";
            return $this->response->setJSON($result);
        }

        // 생년월일 초기화 및 취득 (개인-생년월일 6자리, 법인-사업자번호 10자리)
        $session = session();
        $strResId = $session->get('company_no');

        //$strBankCode = "004";
        //$strAccountNo = "98945543000";
        //$strNm = "박완열";
        //$strResId = "891114";

        // 주문번호 설정 (중복값 설정 불가, 소스 수정 불필요)
        $strOrderNo = date("Ymd") . get_uniqid(false,  false);

        // 조회사유 설정 (10:회원가입 20:기존회원인증 30:성인인증 40:비회원확인 90:기타)
        $inq_rsn = "10";

        // NICE 계좌인증 URL 설정
        $target = "https://secure.nuguya.com/nuguya/service/realname/sprealnameactconfirm.do";
        if (strtoupper($strCharset) == "UTF-8") {
            $target = "https://secure.nuguya.com/nuguya2/service/realname/sprealnameactconfirm.do";
        }

        // 계좌인증 파라미터 설정
        $postValues = "niceUid={$niceUid}&svcPwd={$svcPwd}&service={$service}&svcGbn={$svcGbn}&strGbn={$strGbn}&strBankCode={$strBankCode}&strAccountNo={$strAccountNo}&strNm={$strNm}&strResId={$strResId}&inq_rsn={$inq_rsn}&strOrderNo={$strOrderNo}";

        // cURL 초기화
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $target);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postValues);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
            'Content-Length: ' . strlen($postValues)
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // SSL 인증서 무시

        $api_result = curl_exec($ch);

        if ($result === false) {
            $error = curl_error($ch);
            curl_close($ch);
            $result['msg'] = "서버오류입니다.";
            return $this->response->setJSON($result);
        } else {
            curl_close($ch);
            $responseLines = explode("\r\n", $api_result);
            // 응답 결과 파싱
            foreach ($responseLines as $line) {
                if (strpos($line, '|') !== false) {
                    $bcResult = $line;
                    break;
                }
            }
        }

        if(isset($bcResult)) {
            // 결과값 분할
            $bcResults = explode("|", $bcResult);

            // 결과값 추출
            $resultOrderNo = $bcResults[0]; // 주문번호
            $resultCode = $bcResults[1]; // 결과코드
            $resultMsg = $bcResults[2]; // 결과메세지

            $errorMessages = [
                "0000" => "정상처리",
                "DB01" => "해당 데이터가 존재하지 않음",
                "DB02" => "실명조회 DB 에러",
                "D100" => "ID에 할당된 사업자번호 오류",
                "D200" => "주민번호 오류",
                "D300" => "사업자번호 오류",
                "D400" => "계좌구분 오류",
                "D500" => "서비스 구분 오류",
                "D600" => "LG데이콤 Key 오류",
                "D700" => "거래일자 오류",
                "D800" => "거래시간 오류",
                "D900" => "조회은행코드 오류",
                "D101" => "조회 생년월일 오류",
                "D102" => "조회 사업자번호 오류",
                "D103" => "조회 계좌번호 오류",
                "D104" => "Flag 오류",
                "D105" => "구분 오류",
                "TIME" => "응답 지연",
                "DSYS" => "시스템 장애",
                "OVER" => "동시 접속자 수 초과",
                "D888" => "당행 서비스가 불가능함",
                "D999" => "서비스 시간 아님",
                "B004" => "예금주명 불일치",
                "B005" => "미등록 코드",
                "B101" => "타행 or 은행 시스템 오류",
                "B102" => "계좌 오류",
                "B103" => "생년월일 or 사업자번호 불일치",
                "B104" => "예금주명 불일치",
                "B199" => "은행 기타 오류",
                "C001" => "통신 상태 확인 필요",
                "C002" => "데이터 쓰기 실패",
                "C003" => "데이터 읽기 실패",
                "S606" => "계좌 소유주명 오류",
                "E999" => "내부 오류"
            ];

            if($resultCode == "0000"){
                $result['code'] = 200;
                $result['msg'] = $errorMessages[$resultCode];
            } else {
                $result['msg'] = "에러 : " . ($errorMessages[$resultCode] ?? "알 수 없는 오류");
                $result['err_id'] = "result";
            }
        } else {
            $result['msg'] = "응답을 파싱하는데 실패했습니다.";
            $result['err_id'] = "result";
        }

        return $this->response->setJSON($result);
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
}