<?php

function base_path($path = '') {
    return FCPATH . $path;
}

function alert($msg = "") {
    if(empty($msg)){
        $msg = session()->getFlashdata('msg');
    }

    if(!empty($msg)){
        echo "<script>Swal.fire({text: " . json_encode($msg) . "});</script>";
    }
}

function get_selected($field, $value){
    return ($field==$value) ? ' selected="selected"' : '';
}


function get_checked($field, $value){
    return ($field==$value) ? ' checked="checked"' : '';
}

function get_displayed($field, $value){
    return ($field==$value) ? ' block;' : 'none;';
}

function createPagination($current_page, $total_items, $items_per_page, $url_prefix, $pages_to_show = 5) {
    
    //아이템없으면 아에안해줌
    if ($total_items <= 0) {
        return '';
    }
    $total_pages = ceil($total_items / $items_per_page);
    // 전체 페이지 수가 1 이하인 경우, 페이징 네비게이션을 출력할 필요가 없으므로 빈 문자열을 반환
    if ($total_pages <= 1) {
        return '';
    }

    $current_page = max(1, (int)$current_page);
    $current_page = min($current_page, $total_pages);

    // 현재 페이지 그룹 계산
    $current_group = ceil($current_page / $pages_to_show);
    $start_page = ($current_group - 1) * $pages_to_show + 1;
    $end_page = min($start_page + $pages_to_show - 1, $total_pages);
    $last_group_start = (ceil($total_pages / $pages_to_show) - 1) * $pages_to_show + 1;

    // URL 설정
    $url_components = parse_url($url_prefix);
    $base_url = $url_components['scheme'] . '://' . $url_components['host'] . $url_components['path'];
    $pagination_html = '<nav aria-label="Page navigation"><ul class="pagination">';

    // 맨 처음 페이지 링크
    if ($current_page > $pages_to_show) {
        $first_page_query = http_build_query(array_merge($_GET, ['page' => 1]));
        $pagination_html .= '<li class="page-item"><a class="page-link" href="' . $base_url . '?' . $first_page_query . '"><i class="fa-light fa-chevrons-left"></i></a></li>';
    }

    // 이전 페이지 그룹 링크
    if ($start_page > 1) {
        $prev_group_page = $start_page - 1;
        $prev_group_query = http_build_query(array_merge($_GET, ['page' => $prev_group_page]));
        $pagination_html .= '<li class="page-item"><a class="page-link" href="' . $base_url . '?' . $prev_group_query . '"><i class="fa-regular fa-angle-left"></i></a></li>';
    }

    // 페이지 번호 링크
    for ($i = $start_page; $i <= $end_page; $i++) {
        $page_query = http_build_query(array_merge($_GET, ['page' => $i]));
        if ($i == $current_page) {
            $pagination_html .= '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
        } else {
            $pagination_html .= '<li class="page-item"><a class="page-link" href="' . $base_url . '?' . $page_query . '">' . $i . '</a></li>';
        }
    }

    // 다음 페이지 그룹 링크
    if ($end_page < $total_pages) {
        $next_group_page = $end_page + 1;
        $next_group_query = http_build_query(array_merge($_GET, ['page' => $next_group_page]));
        $pagination_html .= '<li class="page-item"><a class="page-link" href="' . $base_url . '?' . $next_group_query . '"><i class="fa-regular fa-angle-right"></i></a></li>';
    }

    // 맨 마지막 페이지 링크
    if ($end_page < $total_pages) {
        $last_page_query = http_build_query(array_merge($_GET, ['page' => $total_pages]));
        $pagination_html .= '<li class="page-item"><a class="page-link" href="' . $base_url . '?' . $last_page_query . '"><i class="fa-light fa-chevrons-right"></i></a></li>';
    }

    $pagination_html .= '</ul></nav>';

    return $pagination_html;
}



function getCurrentUrl() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'];
    $requestUri = $_SERVER['REQUEST_URI'];
    return $protocol . $domainName . $requestUri;
}

// 파일 업로드
function saveFile($filePath, $fileParam) {

    if (!isset($_FILES[$fileParam])) {
        throw new Exception("에러가 발생하였습니다. [0]");
    }

    $file = $_FILES[$fileParam];

    // 기본 에러 및 업로드 여부확인
    if ($file['error'] !== UPLOAD_ERR_OK) {
        if($file['error'] == UPLOAD_ERR_NO_FILE){
            throw new Exception(UPLOAD_ERR_NO_FILE);
        } else {
            throw new Exception("시스템 에러가 발생하였습니다. ". $file['error']);
        }
    }

    // 파일 크기 제한 확인
    $maxFileSize = 5 * 1024 * 1024; // 5 MB
    if ($file['size'] > $maxFileSize) {
        throw new Exception("파일 크기가 너무 큽니다. 최대 허용 크기는 5MB입니다.");
    }


    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $disallowedExtensions = ['exe', 'swf', 'bat', 'sh'];
    if (in_array($extension, $disallowedExtensions)) {
        throw new Exception("등록이 불가능한 파일입니다.");
    }

    // 파일명 생성
    $randomString = time() . rand();
    $hashedFilename = md5($randomString) . "." . $extension;
    $destination = $filePath . '/' . $hashedFilename;

    if (!file_exists($filePath)) {
        if (!mkdir($filePath, 0755, true)) {
            throw new Exception("퍼미션 에러입니다. [2]");
        }
    }

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        throw new Exception("저장에 실패하였습니다. [3]");
    }

    return $hashedFilename;
}




/**
 * 주어진 파라미터를 기반으로 유일하거나 랜덤한 문자열을 생성합니다.
 *
 * @param bool $numeric_only  true면 숫자만 포함된 문자열을 생성합니다. 기본값은 false입니다.
 * @param bool $is_unique     true면 유일한 문자열을 생성합니다. 기본값은 true입니다.
 * @param int  $length        생성할 문자열의 길이. 기본값은 8입니다.
 *
 * @return string             생성된 문자열을 반환합니다.
 */
function get_uniqid($numeric_only = false, $is_unique = true, $length = 8) {
    if ($length < 8) {
        $length = 8;
    }

    // 유효한 문자를 설정
    $characters = $numeric_only ? '123456789' : '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    // 랜덤 문자열 생성 함수
    $generate_random_string = function($length, $characters) {
        $characters_length = strlen($characters);
        $random_string = '';
        for ($i = 0; $i < $length; $i++) {
            $random_string .= $characters[rand(0, $characters_length - 1)];
        }
        return $random_string;
    };

    if ($is_unique) {
        sql_query("LOCK TABLE `uniqid_list` WRITE");
        while (1) {
            $key = $generate_random_string($length, $characters);

            $result = sql_query("INSERT INTO `uniqid_list` SET uq_id = '$key'", false);
            if ($result) break;

            usleep(10000); // 100분의 1초를 쉰다
        }
        sql_query("UNLOCK TABLES");
    } else {
        $key = $generate_random_string($length, $characters);
    }

    return $key;
}

/**
 * 문자열이 빈 값인지 또는 null인지 확인합니다.
 *
 * @param mixed $str 확인할 값
 * @return array ["success" => bool, "value" => string]
 */
function isStr($str) {
    if (empty($str)) {
        return ["success" => false, "value" => ""];
    } else {
        return ["success" => true, "value" => (string)$str];
    }
}

/**
 * 값이 빈 값인지 또는 숫자인지 확인합니다.
 *
 * @param mixed $str 확인할 값
 * @return array ["success" => bool, "value" => mixed]
 */
function isNum($str) {
    $str = str_replace(",","",$str);

    if (empty($str)) {
        return ["success" => false, "value" => ""];
    } elseif (is_numeric($str)) {
        return ["success" => true, "value" => $str + 0]; // 숫자형으로 반환
    } else {
        return ["success" => false, "value" => ""];
    }
}

/*
====================================================================
1. 문자박스 로그인
http://biz2.smsbox.co.kr/
ID : letskt080
PW : 3001jun

2. 마이페이지 - 회신번호관리 - 회신번호등록
관리계정
1. sms만 사용		: letskt0802 (165서버)
2. mms 함께 사용	: seongu (184서버)

3. DB정보
letskt0802 계정 : http://211.51.221.165/_phpMyadmin/
---------------------------------------------------------------------
*/
function goSms($reserv_phone, $msg, $send_phone="0518910088")
{
    return;
    //lets0802
    $conn_db = mysqli_connect("211.51.221.165", "emma", "wjsghk!@#", "emma");
    $mart_id = "b2p";			//계정명

    $number_receive_people = 0;
    $tran_phone1 = $reserv_phone;			// 수신번호
    $tran_callback1 = $send_phone;			// 발신번호
    $msg1 = $msg;							// 문자내용
    $send_date = date("YmdHis");

    $sql = "select count(tran_pr) cnt from emma.em_all_log
            where tran_date like '".G5_TIME_YMD."%' and tran_phone = '{$reserv_phone}' ";

    $result = mysqli_query($conn_db,$sql);
    $result = mysqli_fetch_array($result);
    //6회부터 오류창 표시
    if ($result['cnt'] > 20){
        //die(json_encode(array( 'msg' => "하루 인증횟수(20회)를 초과하였습니다.")));
        //exit();
    }
    if(!$tran_callback1){
        //die(json_encode(array( 'msg' => "전화번호가 잘못되었습니다. 다시 입력해주세요.")));
        exit();
    }

    $tran_msg1 = iconv("UTF-8", "EUC-KR", $msg1);

    $sms_query = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1')";
    $result = mysqli_query($conn_db, $sms_query);
    if(!$result) {
        //echo mysql_error();
        return false;
    }

    //전체기록남기기
    $all_query = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1',curdate())";
    $result2 = mysqli_query($conn_db, $all_query);

    $query = "Insert into tbl_sms(f_idno,f_from_phone,f_to_phone,f_comment,f_wdate) values('$mart_id','$tran_callback1','$tran_phone1','$tran_msg1','$send_date')";
    mysqli_query($conn_db,$query);

}

?>