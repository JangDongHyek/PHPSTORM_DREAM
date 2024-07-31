<?php

function get_email_list(){
    return $email_list = [
        'naver.com',
        'daum.net',
        'gmail.com',
        'hanmail.net',
        'nate.com',
        'yahoo.com',
        'outlook.com',
        'hotmail.com',
        'icloud.com',
        'kakao.com'
    ];
}

function get_gmarket_charge_list(){
    return array(
        "전체" => 9,
        "내비게이션/블랙박스" => 9,
        "모터바이크" => 8,
        "모터바이크용품" => 9,
        "모터바이크의류" => 8,
        "세차용품" => 13,
        "자동차공기청정용품" => 13,
        "자동차관리용품" => 13,
        "자동차램프" => 13,
        "자동차매트/시트/쿠션" => 13,
        "자동차모바일용품" => 11,
        "자동차배터리" => 13,
        "자동차부품/튜닝용품" => 13,
        "자동차수납용품" => 13,
        "자동차안전/편의용품" => 13,
        "자동차오일/첨가제" => 13,
        "자동차전기/장치" => 13,
        "자동차카메라/감지기" => 13,
        "자동차키용품" => 13,
        "자동차필터/소모품" => 13,
        "자동차DIY용품" => 13,
        "카오디오/카AV" => 9,
        "카익스테리어용품" => 13,
        "카인테리어용품" => 13,
        "타이어/휠" => 11,
        "하이패스/GPS" => 9
    );
}

function get_delivery_company_list($code = ""){
    $where = " where 1=1";
    if(!empty($code)){
        $where .= " and `code` = '$code'";
    }
    $sql = "SELECT * FROM `delivery_company_list` $where";
    $re = sql_query($sql);
    
    $list = $row = sql_fetch_array($re);
    return $list;
}

function getQuickServiceJiyuck(){
    $quickRegions = [
        "0100" => "서울",
        "0200" => "경기",
        "0300" => "광주",
        "0400" => "대구",
        "0500" => "대전",
        "0600" => "부산",
        "0700" => "울산",
        "0800" => "인천"
    ];

    $quickGyeonggi = [
        "0200" => "경기(전체)",
        "0201" => "고양",
        "0202" => "고촌",
        "0203" => "곤지암",
        "0204" => "과천",
        "0205" => "광명",
        "0206" => "광주",
        "0207" => "교문리",
        "0208" => "구리",
        "0209" => "구성",
        "0210" => "군포",
        "0211" => "김포",
        "0212" => "부천",
        "0213" => "분당",
        "0214" => "성남",
        "0215" => "수원",
        "0216" => "수지",
        "0217" => "시흥",
        "0218" => "안산",
        "0219" => "안양",
        "0220" => "용인",
        "0221" => "의왕",
        "0222" => "의정부",
        "0223" => "이천",
        "0224" => "일산",
        "0225" => "지축",
        "0226" => "파주",
        "0227" => "하남"
    ];

    return ['quickRegions'=>$quickRegions, 'quickGyeonggi'=>$quickGyeonggi];
}

function get_esm_category($code = ""){
    $where = " where `name` != 'test' ";
    if(!empty($code)){
        $code = substr($code, 2);
        $where .= " and `code` = '$code'";
    }

    $sql = "select * from `esm_category` $where  order by `name`";
    $re = sql_query($sql);
    $list = sql_fetch_array($re);

    return $list;
}

function get_dispatch_policies_str($code){
    $sql = "select * from `dispatch_policies_list` where `dispatchPolicyNo` = '{$code}' or `dispatchPolicyNo` = '{$code}'";
    $row = sql_fetch($sql);

    $text = "";
    if($row['dispatchPolicyName'] == "당일발송"){
        $text = "{$row['dispatchPolicyName']} {$row['dispatchCloseTime']}시까지 발송";
    } else if($row['dispatchPolicyName'] == "순차발송"){
        $text = "{$row['dispatchPolicyName']} {$row['readyDurationDay']}일후 발송";
    } else {
        $text = "{$row['dispatchPolicyName']}";
    }

    return $text;
}

function get_bank_list($search = ""){
    $where = " where 1=1 ";
    if(!empty($search)){
        $where .= " and (`code` = '$search' or `name` = '$search')";
    }

    $sql = "select * from `bank_list` $where";
    $re = sql_query($sql);

    $list = sql_fetch_array($re);
    return $list;
}

?>