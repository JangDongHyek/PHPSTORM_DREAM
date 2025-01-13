<?
include_once('./_common.php');

$sDate = ($_GET["sDate"])? $_GET["sDate"] : date("Y-m-d", mktime(0, 0, 0, (int)date('m') , 1, (int)date('Y')));
$eDate = ($_GET["eDate"])? $_GET["eDate"] : date("Y-m-d", mktime(0, 0, 0, (int)date('m')+1 , 0, (int)date('Y')));
$eDateAfter = date("Y-m-d", strtotime("+1 days", strtotime($eDate)));

switch($co_id){
    case "myorder" :
        $orderTable = "g5_order";
        $cartTable = "g5_cart";
        $fileNameStr = "홍보물쇼핑몰";
        break;
    case "point_myorder" :
        $orderTable = "g5_point_order";
        $cartTable = "g5_point_cart";
        $fileNameStr = "물품쇼핑몰";
        break;
    case "ptmall_myorder" :
        $orderTable = "g5_ptmall_order";
        $cartTable = "g5_ptmall_cart";
        $fileNameStr = "포인트쇼핑몰";
        break;
}



if ($co_id == "ptmall_myorder") {
    $whereStrJoin = " and {$orderTable}.od_status = '신청' and {$orderTable}.od_date >= '{$sDate}' and {$orderTable}.od_date < '{$eDateAfter}' ";
    $whereStr = " od_status='신청' and od_date >= '{$sDate}' and od_date < '{$eDateAfter}' ";
} else {
    $whereStrJoin = " and {$orderTable}.od_date >= '{$sDate}' and {$orderTable}.od_date < '{$eDateAfter}' and ({$orderTable}.od_status = '신청' OR ({$orderTable}.od_status != '신청' AND ({$orderTable}.acct_bankcode != '' OR {$orderTable}.card_num != '')))";
    $whereStr = " (od_status='신청' OR (od_status != '신청' AND (acct_bankcode != '' OR card_num != ''))) and od_date >= '{$sDate}' and od_date < '{$eDateAfter}' ";
}

$list_orderBy = " {$orderTable}.od_date desc";

// 목록
$list_sql = " select * from {$orderTable} where {$whereStr} order by od_date desc";

if($sch_mb_2 != '' && $sch_wr_id != ''){
    $list_sql = " select {$orderTable}.* from g5_member, {$cartTable}, {$orderTable} where {$orderTable}.mb_id = g5_member.mb_id and {$orderTable}.od_idx = {$cartTable}.od_idx and g5_member.mb_id = {$cartTable}.mb_id and g5_member.mb_2 like '%{$sch_mb_2}%' and {$cartTable}.it_id = '{$sch_wr_id}' {$whereStrJoin} order by {$list_orderBy} ";

}else if($sch_mb_2 != ''){
    $list_sql = " select {$orderTable}.* from g5_member, {$orderTable} where {$orderTable}.mb_id = g5_member.mb_id and g5_member.mb_2 like '%{$sch_mb_2}%' {$whereStrJoin} order by {$list_orderBy} ";

}else if($sch_wr_id != ''){
    $list_sql = " select {$orderTable}.* from {$cartTable}, {$orderTable} where {$orderTable}.od_idx = {$cartTable}.od_idx and {$cartTable}.it_id = '{$sch_wr_id}' {$whereStrJoin} order by {$list_orderBy} ";
}

$list_qry = sql_query($list_sql);
$list_num = sql_num_rows($list_qry);


$fileName = $fileNameStr."_주문조회_".date("Ymd");
$fileName = iconv("UTF-8", "EUC-KR", $fileName);

header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = ".$fileName.".xls" );
header( "Content-Description: PHP4 Generated Data" );

print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=utf-8\">");


?>
    <style>
        .tbl {color: #000; font-size: 11pt;}
        .title {font-size: 14pt; font-weight: bold; text-align: left; border: 0;}
        .head {background: #e4624a; color: #FFF; text-align: center; width: 140px;}
        .txt {width: 200px; text-align: left;}
        .pt {width: 100px; text-align: right;}
    </style>

    <table border="0" class="tbl">
        <tr>
            <th class="title" colspan="2"><?=$fileNameStr?> 주문내역</th>
        </tr>
        <tr>
            <td>조회일</td>
            <td colspan="5"><?=$sDate?>~<?=$eDate?></td>
        </tr>
    </table>
    <table border="1" class="tbl">
        <tr>
            <td class="head">주문일</td>
            <td class="head">매장명</td>
            <td class="head">사업자등록번호</td>
            <td class="head">점주명</td>
            <td class="head">주문상품</td>
            <td class="head">결제금액</td>
            <td class="head">결제마일리지</td>
            <td class="head">결제상태</td>
        </tr>
        <?
        if($list_num > 0) {
            for($l=0; $l<$list_num; $l++){
                $list_row = sql_fetch_array($list_qry);

                $od_date = explode(' ',$list_row['od_date']);
                $od_method = '';

                switch($list_row['od_method']){
                    case "card" : $od_method = '신용카드'; break;
                    case "online" : $od_method = '온라인계좌이체'; break;
                    case "free" : $od_method = '무료'; break;
                    case "point" : $od_method = '포인트'; break;
                    case "VBank" : $od_method = '가상계좌'; break;
                }

                // 주문누락 확인
                if ($list_row['od_status'] != "신청") {
                    $list_row['pay_status'] = "결제누락";
                    if ($list_row['card_num'] != "") { $od_method = "신용카드"; }
                    if ($list_row['acct_bankcode'] != "") {
                        $od_method = "온라인계좌이체";
                        if ($list_row['vact_num'] != "")	$od_method = "가상계좌";
                    }
                }

                $get_member = get_member($list_row['mb_id']);
                ?>
                <tr>
                    <td align="center"><?=$od_date[0]?></td>
                    <td align="center"><?=$get_member['mb_2']?></td>
                    <td align="center"><?=$get_member['mb_3']?></td>
                    <td align="center"><?=$get_member['mb_name']?></td>
                    <td align="left">
                        <?php
                        $ct_sql = " select * from {$cartTable} where od_idx='{$list_row['od_idx']}' order by ct_idx asc ";
                        $ct_qry = sql_query($ct_sql);
                        $ct_num = sql_num_rows($ct_qry);
                        if($ct_num > 0){
                            for($k=0; $k<$ct_num; $k++){
                                $ct_row = sql_fetch_array($ct_qry);
                                echo $ct_row['it_name'].'<br style="mso-data-placement:same-cell;">';
                            }
                        }
                        if($list_row['moid'] != ''){
                            $moid_arr = explode('60chicken4_',$list_row['moid']);
                            echo $moid_arr[1];
                        }
                        ?>
                    </td>
                    <td align="right"><?=number_format($list_row['od_hap'])?></td>
                    <td align="right"><?=number_format($list_row['od_hap2'])?></td>
                    <td align="center"><?=$list_row['pay_status']?></td>

                </tr>
                <?
            } // for
        } else {
            ?>
            <tr>
                <td colspan="10" align="center">조회 내역이 없습니다.</td>
            </tr>
            <?
        } // end if
        ?>
    </table>

<?
function utf2euc($str) { return iconv("UTF-8","cp949//IGNORE", $str); }

?>