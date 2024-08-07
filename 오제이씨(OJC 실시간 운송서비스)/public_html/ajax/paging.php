<?php

include_once('../common.php');

$result = $list = array();

$page = $_POST['page'];
$pagingCount = $_POST['pagingCount'];
$limit = ((int)$page - 1) * (int)$pagingCount;

switch($_POST['mode']){
    case 'getDispatchList':
        
        $id = $member['mb_type'] == CUSTOMER? 'company_mb_id' : 'delivery_mb_id';
        
        $sqlSearch = "";
        
        if($member['mb_type'] == CUSTOMER){
            /* 고객사인 경우 배송상태가 배차 이상일 경우만 */
            $sqlSearch = " status_code >= 2 AND ";
        }else{
            /* 배송기사 경우 배송상태가 배차 이상일 경우만 */
//            $sqlSearch = " status_code >= 2 AND ";
        }
        
        $sql = "
            SELECT
                *,
                date(complete_date) AS complete_date,
                date(reg_date) AS reg_date
            FROM
                dispatch_list
            WHERE
                {$id} = '{$member['mb_id']}' AND
                $sqlSearch
                is_use = '1'
            ORDER BY
                complete_date DESC, idx DESC
            LIMIT
                $limit, $pagingCount
        ";
                
        $res = sql_query($sql);

        for($i = 0; $row = sql_fetch_array($res); $i++){
            $row['reg_date'] = $row['status_code'] == 4? $row['complete_date'] : $row['reg_date'];
                
            $row['disStatusCodeName'] = DisStatusCode[$row['dis_status_code']]['name'];
            $row['productJson'] = json_decode($row['product_string'], true);
            $row['WadatWeekDay'] = getWeekday($row['productJson']['WADAT']);
            
            $row['regDateWeekDay'] = getWeekday($row['reg_date']);
            
            $row['productJson']['WADAT'] = getDateFormat($row['productJson']['WADAT']);                
            $row['reg_date'] = getDateFormat($row['reg_date']);
            $row['to_time'] = getTimeFormat($row['to_time']);
            $row['from_time'] = getTimeFormat($row['from_time']);
            
            $list[] = $row;
        }
    break;
}

$result['pagingInfo']['page'] = $page;
$result['pagingInfo']['pagingCount'] = $pagingCount;
$result['list'] = $list;

die(json_encode($result));
?>

