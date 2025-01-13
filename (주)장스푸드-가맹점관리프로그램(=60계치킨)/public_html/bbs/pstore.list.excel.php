<?
include_once('./_common.php');

$fileName = '지점별 마일리지관리';

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
    .head2 {background: #e4624a; color: #FFF; text-align: center; width: 300px;}
    .txt {width: 200px; text-align: left;}
    .pt {width: 100px; text-align: right;}
</style>

<table border="1" class="tbl">
    <tr>
        <td class="head">지점명</td>
        <td class="head">총 마일리지</td>
        <td class="head2">발급</td>
        <td class="head2">차감</td>
        <td class="head2">비고</td>
    </tr>
    <?
    $list_sql = "select * from g5_member where mb_level = 2 and mb_2 <> '' order by mb_2";
    //$list_sql="select * from g5_point where mb_id = '$mb_id' and po_rel_table <> '@login' {$sql_common} order by po_id desc";
    $list_qry = sql_query($list_sql);
    $list_num = sql_num_rows($list_qry);

     for($l=0; $row = sql_fetch_array($list_qry); $l++){
     ?>
            <tr>
                <td align="center"><?=$row['mb_2']?></td>
                <td align="center"><?=number_format(abs($row['mb_point']))?></td>
                <td align="center txt"></td>
                <td align="center txt"></td>
                <td align="center txt"></td>
            </tr>
    <?
    }

    if($list_num == 0){
    ?>
        <tr>
            <td colspan="7" align="center">마일리지 내역이 없습니다.</td>
        </tr>
    <?
    } // end if
    ?>
</table>