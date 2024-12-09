<?php
$sub_menu = "650600";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '가입경로 상세보기';
include_once(G5_PATH.'/head.sub.php');

$t = (string) $_GET['type'];
$start_like = $_GET['date'];
$key = (string) $_GET['key'];

$page_title = "가입경로 - ".MEMBER_JOIN_PATH[$key];
$sub_title = ($t == "2")? "월별가입" : "일별가입";
$sub_title .= "({$start_like})";

$sql_common  = " AND mb_datetime LIKE '{$start_like}%' ";

// 회원가입 조회
$sql = "SELECT mb_id, mb_name, mb_datetime, mb_join_path FROM g5_member 
        WHERE mb_join_path != '' {$sql_common} AND mb_join_path LIKE '%{$key}%' ORDER BY mb_no ASC";
$result = sql_query($sql);
$member_cnt = sql_num_rows($result);

?>

<div id="popup_wrap" class="match">
	<p><?=$page_title?></p>
    <div style="font-size: 14px; margin: 10px 0;"><?=$sub_title?></div>
    <div class="tbl_head02 tbl_wrap">
        <table>
        <colgroup>
            <col width="20%">
            <col width="25%">
            <col width="25%">
            <col width="*">
        </colgroup>
        <thead>
        <tr>
            <th>No.</th>
            <th>아이디</th>
            <th>이름</th>
            <th>가입일자</th>
        </tr>
        </thead>
        <tbody>
        <?for ($i = 0; $row = sql_fetch_array($result); $i++) {?>
        <tr style="text-align: center;">
            <td><?=$i+1?></td>
            <td><?=$row['mb_id']?></td>
            <td><?=$row['mb_name']?></td>
            <td><?=substr($row['mb_datetime'], 0, 16)?></td>
        </tr>
        <?}?>
        </tbody>
        </table>
    </div>
</div>


<?php
include_once(G5_PATH.'/tail.sub.php');
?>