<?
include_once('./_common.php');

$sDate = ($_GET["sDate"])? $_GET["sDate"] : date("Y-m-d", mktime(0, 0, 0, (int)date('m') , 1, (int)date('Y')));
$eDate = ($_GET["eDate"])? $_GET["eDate"] : date("Y-m-d", mktime(0, 0, 0, (int)date('m')+1 , 0, (int)date('Y')));
$eDateAfter = date("Y-m-d", strtotime("+1 days", strtotime($eDate)));


$orderTable = "g5_ptmall_order";
$cartTable = "g5_ptmall_cart";
$fileNameStr = "마일리지쇼핑몰";
$whereStrJoin = " and {$orderTable}.od_status = '신청' and {$orderTable}.od_date >= '{$sDate}' and {$orderTable}.od_date < '{$eDateAfter}' ";
$whereStr = " od_status='신청' and od_date >= '{$sDate}' and od_date < '{$eDateAfter}' ";

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


$fileName = $fileNameStr."_세금계산서 발행".date("Ymd");
$fileName = iconv("UTF-8", "EUC-KR", $fileName);

header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = ".$fileName.".xls" );
header( "Content-Description: PHP4 Generated Data" );

print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=utf-8\">");


$nowdate = date("Ymd");

?>
    <style>
        .tbl {color: #000; font-size: 11pt;}
        .title {font-size: 14pt; font-weight: bold; text-align: left; border: 0;}
        .head {background: #e4624a; color: #FFF; text-align: center; width: 140px;word-break: keep-all}
        .txt {width: 200px; text-align: left;}
        .pt {width: 100px; text-align: right;}
    </style>

    <table border="1" class="tbl">
        <tr>
            <td class="head">전자(세금)계산서 종류(01:일반, 02:영세율)</td>
            <td class="head">작성일자(8자리, YYYYMMDD 형식)</td>
            <td class="head">공급받는자 등록번호("-" 없이 입력)</td>
            <td class="head">공급받는자통시 업장 번호</td>
            <td class="head">공급받는자 상호</td>
            <td class="head">공급받는자 성명</td>
            <td class="head">공급받는자 사업장주소</td>
            <td class="head">공급받는자 업태</td>
            <td class="head">공급받는자 종목</td>
            <td class="head">공급받는자 이메일1</td>
            <td class="head">공급받는자 이메일2</td>
            <td class="head">공급가액</td>
            <td class="head">세액</td>
            <td class="head">비고</td>
            <td class="head">일지1(2자리, 작성년월 제외)</td>
            <td class="head">품목1</td>
            <td class="head">규격1</td>
            <td class="head">수량1</td>
            <td class="head">단가1</td>
            <td class="head">공급가액</td>
            <td class="head">세액</td>
        </tr>

        <?php
        for($i = 0 ; $row = sql_fetch_array($list_qry) ; $i++){
            $mb = get_member($row['mb_id']);
        ?>
        <tr>
            <td class=""></td>
            <td class=""><?=$nowdate?></td>
            <td class=""><?=$mb['mb_3']?></td>
            <td class=""></td>
            <td class=""><?=$mb['mb_2']?></td>
            <td class=""><?=$row['mb_name']?></td>
            <td class=""><?=$row['od_zip'].' '.$row['od_addr1'].' '.$row['od_addr2']?></td>
            <td class=""><?=$mb['mb_5']?></td>
            <td class=""><?=$mb['mb_6']?></td>
            <td class=""><?=$mb['mb_email']?></td>
            <td class=""></td>
            <td class=""><?=number_format($row['od_hap'])?></td>
            <td class=""><?=number_format($row['od_hap']*0.1)?></td>
            <td class=""></td>
            <td class=""></td>
            <td class=""></td>
            <td class=""></td>
            <td class=""></td>
            <td class=""></td>
            <td class=""><?=number_format($row['od_hap'])?></td>
            <td class=""><?=number_format($row['od_hap']*0.1)?></td>
        </tr>

        <?php } ?>

    </table>

<?
function utf2euc($str) { return iconv("UTF-8","cp949//IGNORE", $str); }

?>