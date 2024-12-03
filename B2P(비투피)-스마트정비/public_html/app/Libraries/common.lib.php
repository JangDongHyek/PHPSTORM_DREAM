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

function get_dateformat($date,$format = 'Y-m-d'){

    if($date && $date != '0000-00-00' && $date != '0001-01-01' && $date != '0001-01-01 00:00:00' && $date != '0000-00-00 00:00:00' && $date != '0001-01-01T00:00:00' && $date != '1900-01-01'){
        return date($format, strtotime( $date ) );
    }else{
        return ' ';
    }
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

function createPagination2($current_page, $total_items, $items_per_page, $url_prefix, $pages_to_show = 5) {

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

    // 'page' 키를 제외한 $_GET 배열 생성
    $query_params = array_diff_key($_GET, array_flip(['page']));
    $query_params = array_diff_key($query_params, array_flip(['page3']));

    // 맨 처음 페이지 링크
    if ($current_page > $pages_to_show) {
        $first_page_query = http_build_query(array_merge($query_params, ['page2' => 1]));
        $pagination_html .= '<li class="page-item"><a class="page-link" href="' . $base_url . '?' . $first_page_query . '"><i class="fa-light fa-chevrons-left"></i></a></li>';
    }

    // 이전 페이지 그룹 링크
    if ($start_page > 1) {
        $prev_group_page = $start_page - 1;
        $prev_group_query = http_build_query(array_merge($query_params, ['page2' => $prev_group_page]));
        $pagination_html .= '<li class="page-item"><a class="page-link" href="' . $base_url . '?' . $prev_group_query . '"><i class="fa-regular fa-angle-left"></i></a></li>';
    }

    // 페이지 번호 링크
    for ($i = $start_page; $i <= $end_page; $i++) {

        $page_query = http_build_query(array_merge($query_params, ['page2' => $i]));
        if ($i == $current_page) {
            $pagination_html .= '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
        } else {
            $pagination_html .= '<li class="page-item"><a class="page-link" href="' . $base_url . '?' . $page_query . '">' . $i . '</a></li>';
        }
    }

    // 다음 페이지 그룹 링크
    if ($end_page < $total_pages) {
        $next_group_page = $end_page + 1;
        $next_group_query = http_build_query(array_merge($query_params, ['page2' => $next_group_page]));
        $pagination_html .= '<li class="page-item"><a class="page-link" href="' . $base_url . '?' . $next_group_query . '"><i class="fa-regular fa-angle-right"></i></a></li>';
    }

    // 맨 마지막 페이지 링크
    if ($end_page < $total_pages) {
        $last_page_query = http_build_query(array_merge($query_params, ['page2' => $total_pages]));
        $pagination_html .= '<li class="page-item"><a class="page-link" href="' . $base_url . '?' . $last_page_query . '"><i class="fa-light fa-chevrons-right"></i></a></li>';
    }

    $pagination_html .= '</ul></nav>';

    return $pagination_html;
}

function createPagination3($current_page, $total_items, $items_per_page, $url_prefix, $pages_to_show = 5) {

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

    // 'page' 키를 제외한 $_GET 배열 생성
    $query_params = array_diff_key($_GET, array_flip(['page']));
    $query_params = array_diff_key($query_params, array_flip(['page2']));

    // 맨 처음 페이지 링크
    if ($current_page > $pages_to_show) {
        $first_page_query = http_build_query(array_merge($query_params, ['page3' => 1]));
        $pagination_html .= '<li class="page-item"><a class="page-link" href="' . $base_url . '?' . $first_page_query . '"><i class="fa-light fa-chevrons-left"></i></a></li>';
    }

    // 이전 페이지 그룹 링크
    if ($start_page > 1) {
        $prev_group_page = $start_page - 1;
        $prev_group_query = http_build_query(array_merge($query_params, ['page3' => $prev_group_page]));
        $pagination_html .= '<li class="page-item"><a class="page-link" href="' . $base_url . '?' . $prev_group_query . '"><i class="fa-regular fa-angle-left"></i></a></li>';
    }

    // 페이지 번호 링크
    for ($i = $start_page; $i <= $end_page; $i++) {

        $page_query = http_build_query(array_merge($query_params, ['page3' => $i]));
        if ($i == $current_page) {
            $pagination_html .= '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
        } else {
            $pagination_html .= '<li class="page-item"><a class="page-link" href="' . $base_url . '?' . $page_query . '">' . $i . '</a></li>';
        }
    }

    // 다음 페이지 그룹 링크
    if ($end_page < $total_pages) {
        $next_group_page = $end_page + 1;
        $next_group_query = http_build_query(array_merge($query_params, ['page3' => $next_group_page]));
        $pagination_html .= '<li class="page-item"><a class="page-link" href="' . $base_url . '?' . $next_group_query . '"><i class="fa-regular fa-angle-right"></i></a></li>';
    }

    // 맨 마지막 페이지 링크
    if ($end_page < $total_pages) {
        $last_page_query = http_build_query(array_merge($query_params, ['page3' => $total_pages]));
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

/**
 * 바로빌 문자발송
 */
function goSms($reserv_phone, $Contents, $Subject="")
{

    $reserv_phone = trim(str_replace("-", "", $reserv_phone));

    $url = "https://ws.baroservice.com/SMS.asmx?wsdl";
    $BaroService_SMS = new SoapClient($url, array(
        'trace' => 'true',
        'encoding' => 'UTF-8'
    ));

    $CERTKEY = '98D43872-6E8F-4BD1-BA03-E0216746D644';
    $CorpNum = '7338802620';
    $SenderID = 'pumpkin';
    $FromNumber = '1522-6605';
    $ToName = '';
    $ToNumber = $reserv_phone;
    $SendDT = '';
    $RefKey = '';

    $SendKey = $BaroService_SMS->SendLMSMessage([
        'CERTKEY' => $CERTKEY,
        'CorpNum' => $CorpNum,
        'SenderID' => $SenderID,
        'FromNumber' => $FromNumber,
        'ToName' => $ToName,
        'ToNumber' => $ToNumber,
        'Subject' => $Subject,
        'Contents' => $Contents,
        'SendDT' => $SendDT,
        'RefKey' => $RefKey,
    ])->SendLMSMessageResult;

/*    $sendState = $BaroService_SMS->GetSMSSendState([
        'CERTKEY' => $CERTKEY,
        'CorpNum' => $CorpNum,
        'SendKey' => $SendKey,
    ])->GetSMSSendStateResult;

    $sms_result = 1;
    if ($sendState != 0 && $sendState != 0) { // 실패
        $sms_result = 0;
    }

    $Subject = sql_real_escape_string($Subject);
    $Contents = sql_real_escape_string($Contents);
    $SendKey = sql_real_escape_string($SendKey);

    $sql = "insert into `sms_log` set `receive_number` = '$reserv_phone', `subject` = '$Subject', `contents` = '$Contents', `sms_result` = '$sms_result', `sms_no` = '$SendKey'";
    sql_query($sql);*/

    return $SendKey;

}

// 정산데이터 가공 정산 데이터가 없을경우 originalOrder 함수로 이동
function processOrderOld($order) {

    //데이터 재선언
    // 빈값 및 소수점 절사를 위한 데이터 재 선언
    $order['SellerCashbackMoney'] = $order['SellerCashbackMoney'] ? (int)$order['SellerCashbackMoney'] : 0;
    $order['SellerDiscountTotalPrice'] = $order['SellerDiscountTotalPrice'] ? (int)$order['SellerDiscountTotalPrice'] : 0;
    $order['OrderAmount'] = $order['OrderAmount'] ? (int)$order['OrderAmount'] : 0;
    $order['SettlementPrice'] = $order['SettlementPrice'] ? (int)$order['SettlementPrice'] : 0;
    $order['DirectDiscountPrice'] = $order['DirectDiscountPrice'] ? (int)$order['DirectDiscountPrice'] : 0;
    $order['SellerFundingDiscountPrice'] = $order['SellerFundingDiscountPrice'] ? (int)$order['SellerFundingDiscountPrice'] : 0;
    $order['DeductTaxPrice'] = $order['DeductTaxPrice'] ? (int)$order['DeductTaxPrice'] : 0;
    $order['BuyerPayAmt'] = $order['BuyerPayAmt'] ? (int)$order['BuyerPayAmt'] : 0;
    $order['ServiceFee'] = $order['ServiceFee'] ? (int)$order['ServiceFee'] : 0;
    $order['b2p_kcp_price'] = $order['b2p_kcp_price'] ? (int)$order['b2p_kcp_price'] : 0;
    $order['b2p_cp_fee_price'] = $order['b2p_cp_fee_price'] ? (int)$order['b2p_cp_fee_price'] : 0;
    $order['DeductTaxPrice'] = abs($order['DeductTaxPrice']);
    $order['TotCommission'] = abs($order['TotCommission']);



    //주문금액
    $OrderAmount = (int)$order['SellOrderPrice'] + (int)$order['OptionPrice'];
    //b2p 수수료
    $b2p_cost = $order['b2p_cost'];
    // 카테고리 수수료
    $category_fee_cost = $order['TotCommission'] + $b2p_cost;
    //b2p 카드 수수료 퍼센트
    $b2p_kcp_fee = $order['b2p_kcp_fee'] ? : 0;
    //b2p 셀러별 카드 페이백 퍼센트
    $b2p_cp_fee = $order['b2p_cp_fee'] ? : 0;

    //판매자 할인 / 공제금
    $SellerDiscountPrice = $order['SiteType'] == 1 ? $order['SellerDiscountTotalPrice'] : $order['SellerDiscountPrice'];
    $totalDiscount = 0;
    $totalDiscount += $SellerDiscountPrice;


    // 쿠폰할인 옥션은 쿠폰할인의 값이 판매자할인에 들어옴
    if($order['SiteType'] == 1) {
    }else {
        $category_fee_cost -= $order['SellerCashbackMoney'];;
        $category_fee_cost += $order['DeductTaxPrice'];

        $totalDiscount += $order['SellerCashbackMoney'];
        $totalDiscount += $order['SellerFundingDiscountPrice'];

        $totalDiscount += $order['DeductTaxPrice'];
    }



    // 배송비 및 배송비 수수료 관련
    $dl_DelFeeAmt = $order['ShippingFee'];
    $dl_DelFeeCommission = $dl_DelFeeAmt * 0.033;
    $b2p_shipping_fee = $dl_DelFeeAmt * 0;
    $dl_DelTotal = floor($dl_DelFeeAmt - $dl_DelFeeCommission - $b2p_shipping_fee);

    // b2p배송비수수료 옥션이면 반올림 g마켓이면 올림
    if($order['SiteType'] == 1) {
        $b2p_shipping_fee = round($b2p_shipping_fee);
        $dl_DelFeeCommission = round($dl_DelFeeCommission);
    }else {
        $b2p_shipping_fee = ceil($b2p_shipping_fee);
        $dl_DelFeeCommission = ceil($dl_DelFeeCommission);
    }

    //부가세
    $surTax = round($order['BuyerPayAmt'] / 11);// B2P 부가세 = 고객 결제금 / 11
    $b2p_surTax = round($calcPrice / 11);// 셀러 부가세 = 정산예정금액 / 11
    $b2p_surTax = ceil($b2p_surTax);
    $refund = $surTax - $b2p_surTax;




    $totalCommission = $category_fee_cost + $totalDiscount + $dl_DelFeeCommission + $b2p_shipping_fee;

    $calcPrice = $OrderAmount;
    $calcPrice -= $category_fee_cost;
    $calcPrice -= $totalDiscount;
    // 옥션이 아니라면 정산금액에 배송비 포함
    if($order['SiteType'] == 2) {
        $calcPrice += $dl_DelTotal;
    }

    //kcp 카드 수수료 , 카드 캐시백
    $b2p_kcp_price = floor($calcPrice * ($b2p_kcp_fee / 100));
    $b2p_cp_fee_price = floor($calcPrice * ($b2p_cp_fee / 100));

    $calcPrice -= ($b2p_kcp_price - $b2p_cp_fee_price);

    $b2p = array(
        "OrderAmount" => $OrderAmount,                  // 주문금액
        "category_fee_cost" => $category_fee_cost,      // 카테고리 수수료
        "totalDiscount" => $totalDiscount,              // 판매자 할인금액
        "SellerDiscountPrice" => $SellerDiscountPrice,  // 쿠폰할인
        "calcPrice" => $calcPrice,                      // 정산 금액
        "dl_DelFeeAmt" => $dl_DelFeeAmt,                // 배송금액
        "dl_DelFeeCommission" => $dl_DelFeeCommission,  // 배송비 수수료
        "b2p_shipping_fee" => $b2p_shipping_fee,        // b2p 배송비 수수료
        "surTax" => $surTax,                            // 부가세
        "b2p_surTax" => $b2p_surTax,                    // b2p 부가세
        "refund" => $refund,                            // 총부가세
        "totalCommission" => $totalCommission,          // 카테고리,판매자 할인총금액,배송비수수료
        "new_b2p_kcp_price" => $b2p_kcp_price,          // 새로 바뀐 카드수수료
        "new_b2p_cp_fee_price" => $b2p_cp_fee_price,    // 새로 바뀌 카드 페이백
    );

    $order['b2p'] = $b2p;

    return $order;
}

// 정산데이터 가공 정산 데이터가 없을경우 originalOrder 함수로 이동
function processOrder($order) {
    if(!isset($order['ContrNo'])) {
        $order = originalOrder($order);
        return $order;
    }

    //데이터 재선언
    // 빈값 및 소수점 절사를 위한 데이터 재 선언
    $order['SellerCashbackMoney'] = $order['SellerCashbackMoney'] ? (int)$order['SellerCashbackMoney'] : 0;
    $order['SellerDiscountTotalPrice'] = $order['SellerDiscountTotalPrice'] ? (int)$order['SellerDiscountTotalPrice'] : 0;
    $order['OrderAmount'] = $order['OrderAmount'] ? (int)$order['OrderAmount'] : 0;
    $order['SettlementPrice'] = $order['SettlementPrice'] ? (int)$order['SettlementPrice'] : 0;
    $order['DirectDiscountPrice'] = $order['DirectDiscountPrice'] ? (int)$order['DirectDiscountPrice'] : 0;
    $order['SellerFundingDiscountPrice'] = $order['SellerFundingDiscountPrice'] ? (int)$order['SellerFundingDiscountPrice'] : 0;
    $order['DeductTaxPrice'] = $order['DeductTaxPrice'] ? (int)$order['DeductTaxPrice'] : 0;
    $order['BuyerPayAmt'] = $order['BuyerPayAmt'] ? (int)$order['BuyerPayAmt'] : 0;
    $order['ServiceFee'] = $order['ServiceFee'] ? (int)$order['ServiceFee'] : 0;
    $order['b2p_kcp_price'] = $order['b2p_kcp_price'] ? (int)$order['b2p_kcp_price'] : 0;
    $order['b2p_cp_fee_price'] = $order['b2p_cp_fee_price'] ? (int)$order['b2p_cp_fee_price'] : 0;
    $order['OrderUnitPrice'] = $order['OrderUnitPrice'] ? (int)$order['OrderUnitPrice'] : 0;
    $order['OrderQty'] = $order['OrderQty'] ? (int)$order['OrderQty'] : 0;
    $order['OptSelPrice'] = $order['OptSelPrice'] ? (int)$order['OptSelPrice'] : 0;
    $order['OptAddPrice'] = $order['OptAddPrice'] ? (int)$order['OptAddPrice'] : 0;
    $order['DeductTaxPrice'] = abs($order['DeductTaxPrice']);
    $order['TotCommission'] = abs($order['TotCommission']);

    $B2P_Goods = 0;
    $B2P_GoodsCost = 0; //B2P 판매자 정산요청가
    $B2P_Option = 0;
    $B2P_OptionCost = 0; //B2P 옵션상품 정산요청가
    $B2P_SettlementPrice = 0; //B2P 판매자 최종정산금
    $B2P_TotCommission = 0; //B2P 기본 서비스 이용료
    $B2P_ServiceFee = 0; //B2P 서비스이용료

    $SellerDiscountPrice = $order['SiteType'] == 1 ? abs($order['SellerDiscountTotalPrice']) : abs($order['SellerDiscountPrice']); // 쿠폰할인
    $totalDiscount = $SellerDiscountPrice; // 판매자 할인금액
    $b2p_kcp_fee = $order['b2p_kcp_fee'] ? : 0; //b2p 카드 수수료 퍼센트
    $b2p_cp_fee = $order['b2p_cp_fee'] ? : 0; //b2p 셀러별 카드 페이백 퍼센트

    //1 옥션 2지마켓
    $category_fee_cost = abs($order['TotCommission']) + abs($order['b2p_cost']);
    if($order['SiteType'] == 2) {
        $category_fee_cost -= abs($order['SellerCashbackMoney']);
        $category_fee_cost -= abs($order['DeductTaxPrice']);

        $totalDiscount += $order['DeductTaxPrice'];
    }

    $B2P_Goods = ($order['OrderUnitPrice']*1 * abs($order['OrderQty'])); //판매자 정산요청가
    $B2P_GoodsCost = round($B2P_Goods - $category_fee_cost); //B2P 판매자 정산요청가 || 공급원가

    $B2P_Option = ($order['OptSelPrice']*1 + $order['OptAddPrice']*1); //옵션상품 정산요청가

    $B2P_GoodsCost_fee = $order['b2p_cost']; //B2P 판매자 정산요청가 수수료율 || 비투피 상품 수수료
    $B2P_OptionCost_fee = ($B2P_Option * ( $order['category_fee']/100 )); //B2P 옵션상품 정산요청가 수수료율 || 비투피 옵션 수수료

    $OrderAmount = $B2P_Goods + $B2P_Option; // 주문금액

    // *****************
    if($order['SiteType'] == 1) {
        $B2P_OptionCost = ($B2P_Option - $category_fee_cost); //B2P 옵션상품 정산요청가
        $B2P_TotCommission = $category_fee_cost + abs($order['OutsidePrice']) + abs($order['SellerPcsFee']); //B2P 기본 서비스 이용료
        $B2P_SettlementPrice = $B2P_Goods + $B2P_Option - abs(round($B2P_TotCommission)) - abs($order['OutsidePrice']); //B2P 판매자 최종정산금
    }else {
        $B2P_OptionCost = round($B2P_Option - $category_fee_cost); //B2P 옵션상품 정산요청가
        $B2P_TotCommission = $category_fee_cost  + abs($order['SellerPcsFee']) ; //B2P 기본 서비스 이용료
        $B2P_SettlementPrice = $B2P_Goods + $B2P_Option - abs($B2P_TotCommission)
            - abs($order['SellerDiscountPrice1']) - abs($order['SellerCashbackMoney']) - abs($order['SellerFundingDiscountPrice']); //B2P 판매자 최종정산금
    }

    $B2P_ServiceFee = $B2P_GoodsCost_fee + $B2P_OptionCost_fee - abs($order['FeeDiscountPrice']) + abs($order['DeductTaxPrice']); //B2P 서비스이용료
    // *****************


    // 배송비 및 배송비 수수료 관련
    $dl_DelFeeAmt = $order['ShippingFee'];
    $dl_DelFeeCommission = $dl_DelFeeAmt * 0.033;
    $b2p_shipping_fee = $dl_DelFeeAmt * 0;
    $dl_DelTotal = floor($dl_DelFeeAmt - $dl_DelFeeCommission - $b2p_shipping_fee);

    // b2p배송비수수료 옥션이면 반올림 g마켓이면 올림
    if($order['SiteType'] == 1) {
        $b2p_shipping_fee = round($b2p_shipping_fee);
        $dl_DelFeeCommission = round($dl_DelFeeCommission);
    }else {
        $b2p_shipping_fee = ceil($b2p_shipping_fee);
        $dl_DelFeeCommission = ceil($dl_DelFeeCommission);
    }

    $totalCommission = $category_fee_cost + $totalDiscount + $dl_DelFeeCommission + $b2p_shipping_fee;


    // 옥션이 아니라면 정산금액에 배송비 포함
    if($order['SiteType'] == 2) {
        $B2P_SettlementPrice += $dl_DelTotal;
    }

    //kcp 카드 수수료 , 카드 캐시백
    $b2p_kcp_price = floor($B2P_SettlementPrice * ($b2p_kcp_fee / 100));
    $b2p_cp_fee_price = floor($B2P_SettlementPrice * ($b2p_cp_fee / 100));

    $B2P_SettlementPrice -= ($b2p_kcp_price - $b2p_cp_fee_price);

    $b2p = array(
        "OrderAmount" => $OrderAmount,                      // 판매자 정산요청가 || 주문금액
        "category_fee_cost" => $category_fee_cost,      // 카테고리 수수료
        "totalDiscount" => $totalDiscount,              // 판매자 할인금액
        "SellerDiscountPrice" => $SellerDiscountPrice,  // 쿠폰할인
        "B2P_SettlementPrice" => $B2P_SettlementPrice,                      // 정산 금액
        "B2P_TotCommission" => $B2P_TotCommission,                      // B2P 기본 서비스 이용료
        "dl_DelFeeAmt" => $dl_DelFeeAmt,                // 배송금액
        "dl_DelFeeCommission" => $dl_DelFeeCommission,  // 배송비 수수료
        "b2p_shipping_fee" => $b2p_shipping_fee,        // b2p 배송비 수수료
        "totalCommission" => $totalCommission,          // 카테고리,판매자 할인총금액,배송비수수료
        "new_b2p_kcp_price" => $b2p_kcp_price,          // 새로 바뀐 카드수수료
        "new_b2p_cp_fee_price" => $b2p_cp_fee_price,    // 새로 바뀌 카드 페이백
    );

    $order['b2p'] = $b2p;

    return $order;
}

//정산데이터가없는 주문데이터 b2p식으로 가공후 반환
function originalOrder($order) {
    $category_fee_cost = 0;
    $totalDiscount = 0;
    $OrderAmount = $order['OrderAmount'];
    $b2p_cost = $order['b2p_cost'];
    $B2P_SettlementPrice = $order['SettlementPrice'];
    $SellerDiscountPrice = abs($order['SellerDiscountPrice']);
    $b2p_kcp_fee = $order['b2p_kcp_fee'] ? : 0;
    $b2p_cp_fee = $order['b2p_cp_fee'] ? : 0;

    //주문금액 옥션일땐 더해줌 지마켓은 아직 확인안됌 12-03
    if($order['SiteType'] == 1) $OrderAmount += $order['DirectDiscountPrice'];

    //기본이용료
    if($order['SiteType'] == 1) $category_fee_cost = $order['BasicServiceFee'];
    else $category_fee_cost = $order['ServiceFee'];
    $category_fee_cost += $b2p_cost;

    //판매자할인금액
    //$totalDiscount += $SellerDiscountPrice;
    //$totalDiscount += abs($order['SellerCashbackMoney']);
    //if($order['SiteType'] == 1) $totalDiscount += abs($order['DirectDiscountPrice']);
    //else $totalDiscount += abs($order['SellerFundingDiscountPrice']);
    $totalDiscount += $order['OutsidePrice'];

    //배송비
    $dl_DelFeeAmt = $order['ShippingFee'];
    $dl_DelFeeCommission = $dl_DelFeeAmt * 0.033;
    $b2p_shipping_fee = $dl_DelFeeAmt * 0;
    $dl_DelTotal = floor($dl_DelFeeAmt - $dl_DelFeeCommission - $b2p_shipping_fee);

    //최종정산금액
    $B2P_SettlementPrice -= $b2p_cost;

    //kcp 카드 수수료 , 카드 캐시백
    $b2p_kcp_price = floor($B2P_SettlementPrice * ($b2p_kcp_fee / 100));
    $b2p_cp_fee_price = floor($B2P_SettlementPrice * ($b2p_cp_fee / 100));

    $B2P_SettlementPrice -= ($b2p_kcp_price - $b2p_cp_fee_price);

    $b2p = array(
        "OrderAmount" => $OrderAmount,                      // 판매자 정산요청가 || 주문금액
        "category_fee_cost" => $category_fee_cost,      // 카테고리 수수료
        "totalDiscount" => $totalDiscount,              // 판매자 할인금액
        "SellerDiscountPrice" => $SellerDiscountPrice,  // 쿠폰할인
        "B2P_SettlementPrice" => $B2P_SettlementPrice,                      // 정산 금액
        "B2P_TotCommission" => $category_fee_cost,                     // B2P 기본 서비스 이용료
        "dl_DelFeeAmt" => $dl_DelFeeAmt,                // 배송금액
        "dl_DelFeeCommission" => $dl_DelFeeCommission,  // 배송비 수수료
        "b2p_shipping_fee" => $b2p_shipping_fee,        // b2p 배송비 수수료
        "new_b2p_kcp_price" => $b2p_kcp_price,          // 새로 바뀐 카드수수료
        "new_b2p_cp_fee_price" => $b2p_cp_fee_price,    // 새로 바뀌 카드 페이백
    );

    $order['b2p'] = $b2p;

    return $order;
}

?>