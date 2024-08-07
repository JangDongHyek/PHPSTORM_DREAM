<?php

include_once('../common.php');

$result = array('result' => false, 'msg' => '');

switch($_POST['mode']){
        
    /* 고객사 회원가입/정보수정 */
    case 'customerSet':
        $settingType =  $_POST['settingType']; // insert, update        
        $mb_id = $_POST['mb_id']; // 아이디
        $mb_password = $_POST['mb_password']; // 비밀번호        
        $mb_company_name = $_POST['mb_company_name']; // 회사명
        $mb_company_tel = $_POST['mb_company_tel']; // 대표번호
        $mb_company_number = $_POST['mb_company_number']; // 사업자등록번호
        $mb_company_email = $_POST['mb_company_email']; // 이메일
        $mb_addr = $_POST['mb_addr']; // 기본주소
        $mb_addr_detail = $_POST['mb_addr_detail']; // 상세주소
        $mb_zip_code = $_POST['mb_zip_code']; // 우편번호
        $mb_lat = $_POST['mb_lat']; // 좌표 x
        $mb_lng = $_POST['mb_lng']; // 좌표 y
        $mb_name = $_POST['mb_name']; // 담당자 성함
        $mb_hp = $_POST['mb_hp']; // 담당자 전화번호
            
        $setSql = "
            mb_company_name = '{$mb_company_name}',
            mb_company_tel = '{$mb_company_tel}',
            mb_company_number = '{$mb_company_number}',
            mb_company_email = '{$mb_company_email}',
            mb_addr = '{$mb_addr}',
            mb_addr_detail = '{$mb_addr_detail}',
            mb_zip_code = '{$mb_zip_code}',
            mb_lat = '{$mb_lat}',
            mb_lng = '{$mb_lng}',
            mb_name = '{$mb_name}',
            mb_hp = '{$mb_hp}'
        ";
        
        // 회원가입시
        if($settingType == 'insert'){
            
            // 아이디 중복 체크
            $memberCnt = sql_fetch("SELECT COUNT(*) cnt FROM g5_member WHERE mb_id = '{$mb_id}';")['cnt'];
            if($memberCnt > 0){
                $result['msg'] = "이미 가입된 아이디입니다.\n다른 아이디로 진행해주세요.";
                die(json_encode($result));
            }
            
            //고객사 필드값
            $CUSTOMER = CUSTOMER;
            
            $sql = "
                INSERT INTO 
                    g5_member
                SET
                    mb_type = '{$CUSTOMER}',
                    mb_id = '{$mb_id}',
                    mb_password = '{$mb_password}',
                    $setSql
            ";
        }
        // 정보수정시
        else{            
            // 정보수정시 비밀번호 변경 할 때
            $setPasswordSql = empty($mb_password)? "" : "mb_password = '{$mb_password}',";
            
            $sql = "
                UPDATE
                    g5_member
                SET
                    $setPasswordSql
                    $setSql
                WHERE
                    mb_id = '{$mb_id}'
            ";
        }
        
        $result['result'] = sql_query($sql); 
        
        if(empty($result['result'])){
            $result['msg'] = "처리도중 문제가 발생하였습니다.\n관리자에게 문의해주세요.";
            die(json_encode($result));
        }
        
        setMemberSession($mb_id);        
        $result['result'] = true;
    break;
        
    /* 고객사 로그인 */
    case 'customerLogin':
        $mb_id = $_POST['mb_id']; // 아이디
        $mb_password = $_POST['mb_password']; // 비밀번호
        $auto_login = $_POST['auto_login']; // 자동로그인 여부
        $CUSTOMER = CUSTOMER; //고객사 필드값
        
        $sql = "
            SELECT
                *
            FROM
                g5_member
            WHERE
                mb_type = '{$CUSTOMER}' AND
                mb_id = '{$mb_id}' AND
                mb_password = '{$mb_password}';
        ";
        
        $mbInfo = sql_fetch($sql);                
        
        if(empty($mbInfo)){
            $result['msg'] = "일치하는 계정이 존재하지 않습니다.\n다시 한 번 확인해주세요.";
            die(json_encode($result));            
        }else if($mbInfo['is_use'] == '0'){
            $result['msg'] = "탈퇴 처리된 계정입니다.\n관리자에게 문의해주세요.";
            die(json_encode($result));
        }
        
        setMemberSession($mbInfo['mb_id'], $auto_login);
        $result['result'] = true;
    break;
        
    /* 배송기사 로그인 */
    case 'deliveryLogin':
        $mb_id = $_POST['mb_id']; // 아이디
        $mb_password = $_POST['mb_password']; // 비밀번호
        $auto_login = $_POST['auto_login']; // 자동로그인 여부
        $DELIVERY = DELIVERY; //배송기사 필드값 
                        
        $sql = "
            SELECT
                *
            FROM
                g5_member
            WHERE
                mb_type = '{$DELIVERY}' AND
                mb_id = '{$mb_id}' AND
                mb_password = '{$mb_password}';
        ";
        
        $mbInfo = sql_fetch($sql);
        
        if(empty($mbInfo)){
            $result['msg'] = "일치하는 계정이 존재하지 않습니다.\n다시 한 번 확인해주세요.";
            die(json_encode($result));
        }else if($mbInfo['is_use'] == '0'){
            $result['msg'] = "탈퇴 처리된 계정입니다.\n관리자에게 문의해주세요.";
            die(json_encode($result));
        }
        
        setMemberSession($mbInfo['mb_id'], $auto_login);
        $result['result'] = true;
    break;

}

die(json_encode($result));
?>